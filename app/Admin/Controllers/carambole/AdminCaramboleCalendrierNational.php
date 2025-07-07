<?php

namespace App\Admin\Controllers\carambole;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\CaramboleCalendrierNational;

class AdminCaramboleCalendrierNational extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Calendrier national - Discipline carambole';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CaramboleCalendrierNational());


        $grid->column('date_debut', __('Date debut'));
        $grid->column('date_fin', __('Date fin'));
        $grid->column('titre', __('Titre'));
        $grid->column('lieu', __('Lieu'));
        $grid->column('club', __('Club'));

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
        $show = new Show(CaramboleCalendrierNational::findOrFail($id));

        $show->field('date_debut', __('Date debut'));
        $show->field('date_fin', __('Date fin'));
        $show->field('titre', __('Titre'));
        $show->field('lieu', __('Lieu'));
        $show->field('club', __('Club'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CaramboleCalendrierNational());

        $form->date('date_debut', __('Date debut'))->default(date('Y-m-d'));
        $form->date('date_fin', __('Date fin'))->default(date('Y-m-d'));
        $form->text('titre', __('Titre'));
        $form->text('lieu', __('Lieu'));
        $form->text('club', __('Club'));

        return $form;
    }
}
