<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\DepartementalLink;

class AdminDepartementalLink extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'DepartementalLink';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DepartementalLink());

        $grid->column('id', __('Id'));
        $grid->column('calendrier_id', __('Calendrier id'));
        $grid->column('top_ligue', __('Top ligue'));
        $grid->column('mixte', __('Mixte'));
        $grid->column('feminin', __('Feminin'));
        $grid->column('U18', __('U18'));
        $grid->column('U15', __('U15'));
        $grid->column('U23', __('U23'));
        $grid->column('handi', __('Handi'));
        $grid->column('veteran', __('Veteran'));
        $grid->column('handi_fauteuil', __('Handi fauteuil'));

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
        $show = new Show(DepartementalLink::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('calendrier_id', __('Calendrier id'));
        $show->field('top_ligue', __('Top ligue'));
        $show->field('mixte', __('Mixte'));
        $show->field('feminin', __('Feminin'));
        $show->field('U18', __('U18'));
        $show->field('U15', __('U15'));
        $show->field('U23', __('U23'));
        $show->field('handi', __('Handi'));
        $show->field('veteran', __('Veteran'));
        $show->field('handi_fauteuil', __('Handi fauteuil'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new DepartementalLink());

        $form->number('calendrier_id', __('Calendrier id'));
        $form->text('top_ligue', __('Top ligue'));
        $form->text('mixte', __('Mixte'));
        $form->text('feminin', __('Feminin'));
        $form->text('U18', __('U18'));
        $form->text('U15', __('U15'));
        $form->text('U23', __('U23'));
        $form->text('handi', __('Handi'));
        $form->text('veteran', __('Veteran'));
        $form->text('handi_fauteuil', __('Handi fauteuil'));

        return $form;
    }
}
