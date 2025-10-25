<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Partenaire;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use OpenAdmin\Admin\Controllers\AdminController;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class AdminPartenairesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Partenaire';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Partenaire());

        $grid->column('titre', __('Titre'));
        $grid->column('img', __('Image'))->display(function ($thumbnail) {
            // Vérifie si le thumbnail existe et est non vide
            if (empty($thumbnail)) {
                return ''; // Si aucun thumbnail n'est présent, rien n'est affiché
            }

            // Sinon, affiche l'image
            return '<img src="' . asset('storage/' . $thumbnail) . '" alt="Thumbnail" class="object-cover" style="width:48px; height:auto;">';
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Partenaire::findOrFail($id));

        $show->field('titre', __('Titre'));
        $show->field('img', __('Image'))->unescape()->as(function ($thumbnail) {
            if (empty($thumbnail)) {
                return ''; // Ne rien afficher si le thumbnail est vide
            }
        
            return '<img src="' . asset('storage/' . $thumbnail) . '" alt="Thumbnail" class="object-cover" style="width:192px; height:auto;">';
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Partenaire());

        $form->text('titre', __('Titre'))->required();
        $form->file('img', __('Image'))->removable();
        $form->ignore(['img']);

        $form->saving(function ($form) {
            /** @var \Illuminate\Http\UploadedFile|null $file */
            $file = request()->file('img');
            if (!$file) return;

            $manager = new ImageManager(new GdDriver());
            $image   = $manager->read($file);

            // Limite la taille de l’original si très large
            if ($image->width() > 1600) {
                $image = $image->scale(width: 1600);
            }

            // Miniature : on relit le fichier (au lieu d’un clone)
            $thumb = $manager->read($file)->scale(width: 175);

            $dir      = 'partenaires';
            $basename = (string) Str::uuid();

            $originalData = (string) $image->toWebp(quality: 82);
            $thumbData    = (string) $thumb->toWebp(quality: 82);

            $originalPath = "{$dir}/{$basename}.webp";
            $thumbPath    = "{$dir}/{$basename}@175.webp";

            Storage::disk('public')->put($originalPath, $originalData);
            Storage::disk('public')->put($thumbPath, $thumbData);

            // Nettoyage ancien fichier si update
            if ($form->model()->exists && $form->model()->getOriginal('img')) {
                $old = $form->model()->getOriginal('img'); // ex: partenaires/xxx.webp
                $oldThumb = preg_replace('/(\.\w+)$/', '@175.webp', $old);
                Storage::disk('public')->delete([$old, $oldThumb]);
            }

            $form->model()->img = $originalPath;
            // $form->model()->thumb = $thumbPath; // si tu as une colonne dédiée
        });

        return $form;
    }
}
