<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\CaramboleCalendrier;
use OpenAdmin\Admin\Layout\Content;

class AdminCaramboleCalendrier extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Calendrier carambole';


    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description('Liste des liens vers le calendrier carambole')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CaramboleCalendrier());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('url', __('Url'));
        $grid->column('discipline', __('Discipline'));

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
        $show = new Show(CaramboleCalendrier::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('url', __('Url'));
        $show->field('discipline', __('Discipline'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CaramboleCalendrier());

        $form->text('title', __('Title'));
        $form->url('url', __('Url'));
        $form->number('discipline', __('Discipline'));

        return $form;
    }
}
