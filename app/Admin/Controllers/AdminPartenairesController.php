<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Partenaire;

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
            return '<img src="' . asset('uploads/' . $thumbnail) . '" alt="Thumbnail" class="object-cover" style="width:48px; height:auto;">';
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
        
            return '<img src="' . asset('uploads/' . $thumbnail) . '" alt="Thumbnail" class="object-cover" style="width:192px; height:auto;">';
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

        $form->text('titre', __('Titre'));
        $form->file('img', __('Image'))->move('partenaires')->uniqueName()->removable();

        return $form;
    }
}
