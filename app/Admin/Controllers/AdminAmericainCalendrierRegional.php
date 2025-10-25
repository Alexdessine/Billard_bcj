<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\AmericainCalendrierRegional;

class AdminAmericainCalendrierRegional extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Calendrier régional - Discipline américain';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AmericainCalendrierRegional());

        $grid->header(function () {
            $url = admin_url('americain/calendrier');
            return <<<HTML
                <a href="{$url}" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Américain
                </a>
            HTML;
        });

        $grid->column('id', __('Id'));
        $grid->column('date_debut', __('Date debut'));
        $grid->column('date_fin', __('Date fin'));
        $grid->column('date_limite', __('Date limite'));
        $grid->column('titre', __('Titre'));
        $grid->column('lieu', __('Lieu'));
        $grid->column('club', __('Club'));
        $grid->column('url', __('Url'));

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
        $show = new Show(AmericainCalendrierRegional::findOrFail($id));

        $url = admin_url('americain/calendrier');
        $show->setResource(admin_url('americain/calendrier')); // Optionnel

        $show->panel()
            ->tools(function ($tools) use ($url) {
                $tools->prepend(<<<HTML
                    <div style="margin-bottom: 10px;">
                        <a href="{$url}" class="btn btn-primary" style="width: 250px; display: flex; justify-content: center;">
                            ↩️ Retour au calendrier Américain
                        </a>
                    </div>
                HTML);
            });

        $show->field('id', __('Id'));
        $show->field('date_debut', __('Date debut'));
        $show->field('date_fin', __('Date fin'));
        $show->field('date_limite', __('Date limite'));
        $show->field('titre', __('Titre'));
        $show->field('lieu', __('Lieu'));
        $show->field('club', __('Club'));
        $show->field('url', __('Url'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AmericainCalendrierRegional());

        $url = admin_url('americain/calendrier');
        $form->html('               
            <a href="' . $url . '" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Américain
                </a>
            '
        );

        $form->date('date_debut', __('Date debut'))->default(date('Y-m-d'));
        $form->date('date_fin', __('Date fin'))->default(date('Y-m-d'));
        $form->date('date_limite', __('Date limite'))->default(date('Y-m-d'));
        $form->text('titre', __('Titre'));
        $form->text('lieu', __('Lieu'));
        $form->text('club', __('Club'));
        $form->url('url', __('Url'));

        return $form;
    }
}
