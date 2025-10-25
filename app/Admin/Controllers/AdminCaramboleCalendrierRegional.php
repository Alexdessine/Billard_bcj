<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\CaramboleCalendrierRegional;

class AdminCaramboleCalendrierRegional extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Calendrier régional - Discipline carambole';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CaramboleCalendrierRegional());



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
        $show = new Show(CaramboleCalendrierRegional::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CaramboleCalendrierRegional());



        return $form;
    }
}
