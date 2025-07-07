<?php

namespace App\Admin\Controllers;

use \App\Models\Menu;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use Illuminate\Support\Facades\Cache;
use OpenAdmin\Admin\Controllers\AdminController;


class MenuController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Menu';

    

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Menu());
        $colors = [
            0 => 'bg-danger',    // inactif → rouge
            1 => 'bg-success',   // actif → vert
        ];

        $grid->column('nom', __('Nom'));
        $grid->column('image', __('Image'))->display(function ($thumbnail) {
            // Vérifie si le thumbnail existe et est non vide
            if (empty($thumbnail)) {
                return ''; // Si aucun thumbnail n'est présent, rien n'est affiché
            }

            // Sinon, affiche l'image
            return '<img src="' . asset('uploads/' . $thumbnail) . '" alt="Thumbnail" class="object-cover" style="width:48px; height:auto;">';
        });
        $grid->column('actif', __('Statut'))->display(function ($value) use ($colors) {
            $color = $colors[$value] ?? 'bg-secondary';
            $name = $value == 1 ? 'Actif' : 'Inactif';
        
            return "<span class='badge {$color}' style='padding:6px 12px; font-size:13px;'>{$name}</span>";
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
        $show = new Show(Menu::findOrFail($id));
        $colors = [
            0 => 'bg-danger',    // inactif → rouge
            1 => 'bg-success',   // actif → vert
        ];

        $show->field('nom', __('Nom'));
        $show->field('image', __('Image'))->unescape()->as(function ($thumbnail) {
            if (empty($thumbnail)) {
                return ''; // Ne rien afficher si le thumbnail est vide
            }
        
            return '<img src="' . asset('uploads/' . $thumbnail) . '" alt="Thumbnail" class="object-cover" style="width:192px; height:auto;">';
        });
        $show->field('actif', __('Actif'))->unescape()->as(function ($value) use ($colors) {
            $color = $colors[$value] ?? 'bg-secondary';
            $name = $value == 1 ? 'Actif' : 'Inactif';

            return "<span class='badge {$color}' style='padding:6px 12px; font-size:13px;'>{$name}</span>";
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
        $form = new Form(new Menu());

        $form->text('nom', __('Nom'));
        $form->file('image', __('Image'))->move('menu')->uniqueName()->removable();
        $form->switch('actif', __('Actif'))->default(1);

        return $form;
    }

    public function toggle($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->actif = !$menu->actif;
        $menu->save();

        // Vider le cache après la mise à jour
        // Cache::forget('menus_actifs');

        return response()->json(['success' => true, 'actif' => $menu->actif]);
    }
}
