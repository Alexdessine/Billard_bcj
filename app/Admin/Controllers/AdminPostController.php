<?php

namespace App\Admin\Controllers;

use \App\Models\Post;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use OpenAdmin\Admin\Controllers\AdminController;

class AdminPostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $disciplines = [
                1 => 'blackball',
                2 => 'carambole',
                3 => 'snooker',
                4 => 'americain',
        ];

        $grid = new Grid(new Post());

        $grid->filter(function ($filter) use ($disciplines) {
            $filter->expand();

            $filter->setCols(4, 6);

            $filter->column(1/2, function ($filter) {
                $filter->like('title', __('Titre'));
            });

            $filter->column(1/2, function ($filter) use ($disciplines) {
                $filter->equal('discipline', __('Discipline'))->select($disciplines);
            });
        });

        

        $colors = [
            1 => 'bg-danger',    // blackball → rouge
            2 => 'bg-warning',   // carambole → jaune
            3 => 'bg-success',   // snooker → vert
            4 => 'bg-info',      // américain → bleu
        ];

        $grid->column('title', __('Titre'))->display(function ($titre) {
            if ($this->favoris) {
                return '<span class="badge bg-primary">⭐ A la une</span> ' . $titre;
            }
            return $titre;
        });
        $grid->column('thumbnail', __('Thumbnail'))->display(function ($thumbnail) {
            // Vérifie si le thumbnail existe et est non vide
            if (empty($thumbnail)) {
                return ''; // Si aucun thumbnail n'est présent, rien n'est affiché
            }

            // Sinon, affiche l'image
            return '<img src="' . asset('storage/' . $thumbnail) . '" alt="Thumbnail" class="object-cover" style="width:48px; height:auto;">';
        });
        $grid->column('video', __('Video'));
        // Afficher les disciplines sous forme de tags
        $grid->column('discipline', __('Discipline'))
        ->display(function ($discipline) use ($disciplines, $colors) {
            $color = $colors[$discipline] ?? 'bg-secondary';
            $name = $disciplines[$discipline] ?? 'Club';
            return "<span class='badge {$color}'>{$name}</span>";
        });
        $grid->column('year', __('Année'))->sortable();
        $grid->column('Partager')->display(function () {
            $url = route("{$this->disciplineName()}.show", ['post' => $this]);
            $facebookShareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);

            return "<a href='{$facebookShareUrl}' target='_blank' class='btn btn-sm btn-primary'>
                Partager sur Facebook
            </a>";
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
        $show = new Show(Post::findOrFail($id));
       $disciplines = [
            1 => 'blackball',
            2 => 'carambole',
            3 => 'snooker',
            4 => 'americain',
        ];

        $show->field('title', __('Titre'));
        $show->field('content', __('Contenu'));
        $show->field('thumbnail', __('Image'))->unescape()->as(function ($thumbnail) {
            if (empty($thumbnail)) {
                return ''; // Ne rien afficher si le thumbnail est vide
            }
        
            return '<img src="' . asset('storage/' . $thumbnail) . '" alt="Thumbnail" class="object-cover" style="width:192px; height:auto;">';
        });
        $show->field('video', __('Video'));

        // Vérifie que la discipline existe bien dans le tableau avant de l'afficher
        $show->field('discipline', __('Discipline'))->as(function () use ($disciplines) {
            return $disciplines[$this->discipline] ?? __('Club'); 
        });

        $show->field('year', __('Année'));
        $show->field('created_at', __('Créer le'));
        $show->field('updated_at', __('Modifié le'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $disciplines = [
            1 => 'blackball',
            2 => 'carambole',
            3 => 'snooker',
            4 => 'americain',
        ];

        $years = range(date('Y'), 1970);
        $years = array_combine($years, $years);

        $form = new Form(new Post());
        // $form->html('
        //     <!-- Nouvelle notice pour la mise en forme -->
        //     <div class="alert alert-warning mt-4" role="alert" style="font-size:15px; line-height:1.8; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        //         <h4 style="font-weight:bold; margin-bottom:10px;">🛠️ Mise en forme du contenu</h4>
        //         <p>Vous pouvez utiliser les balises HTML suivantes pour enrichir le texte :</p>
        //         <ul style="padding-left:20px;">
        //             <li><code>&lt;strong&gt;Texte important&lt;/strong&gt;</code> → <strong>Texte important</strong></li>
        //             <li><code>&lt;em&gt;Texte en italique&lt;/em&gt;</code> → <em>Texte en italique</em></li>
        //             <li><code>&lt;u&gt;Texte souligné&lt;/u&gt;</code> → <u>Texte souligné</u></li>
        //             <li><code>&lt;br&gt;</code> → Retour à la ligne</li>
        //             <li><code>&lt;a href="url"&gt;Lien&lt;/a&gt;</code> → <a href="#">Lien</a></li>
        //         </ul>
        //         <p style="margin-top:10px;">💡 Vous pouvez combiner ces balises pour structurer votre contenu.</p>
        //     </div>
        // ');

        $form->text('title', __('Titre'));
        $form->ck5('content', __('Contenu'))->rows(700);
        $form->file('thumbnail', __('Image'))->disk('public')->move('files')->uniqueName()->removable();
        $form->url('video', __('Video'));
        $form->select('discipline', __('Discipline'))->options($disciplines);
        $form->select('year', __('Année'))->options($years)->default(function ($form) {
            return $form->model()->year ?? date('Y');
        });
        $form->switch('favoris',__('A la une'))->default(false);
        $form->datetimeRange('created_at', 'updated_at');

        // Traitement personnalisé avant sauvegarde
        $form->saving(function ($form) {
            $model = $form->model();
        
            $model->slug = \Str::slug($form->title);
            $model->excerpt = \Str::limit(strip_tags($form->content), 150);
        
            if (!empty($form->video)) {
                $model->thumbnail = null;
            }
        
            if (request()->hasFile('thumbnail')) {
                $file = request()->file('thumbnail');
                $filename = uniqid() . '.jpg'; // toujours jpg

                $manager = new ImageManager(new GdDriver());
                $image = $manager->read($file);

                if ($image->width() > 1280) {
                    $image = $image->scale(width: 1280);
                }

                // Générer le contenu JPEG compressé
                $thumb = $manager->read($file)->scale(width:175);
                $jpegData = $thumb->toJpeg(quality: 60)->toString();

                // Sauvegarder via Storage
                Storage::disk('public')->put('files/' . $filename, $jpegData);

                // Enregistrer le nom du fichier dans le modèle
                $model->thumbnail = $filename;
            }
        });
        return $form;
    }
}
