<?php

namespace App\Admin\Controllers\carambole;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\ClassementCarambole;
use Illuminate\Support\Facades\Storage;

class AdminCaramboleClassement extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Classement carambole';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ClassementCarambole());

        $grid->column('title', __('Title'));
        $grid->column('file', __('File'));
        // $grid->column('discipline', __('Discipline'));

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
        $show = new Show(ClassementCarambole::findOrFail($id));

        $show->field('title', __('Title'));
        $show->field('file', __('File'))->as(function ($file){
            if ($file){
                $url = Storage::disk('public')->url($file);
                return "<iframe src='{$url}' width='100%' height='800px' style='border:none;'></iframe>";
            }
            return '';
        })->unescape();
        // $show->field('discipline', __('Discipline'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ClassementCarambole());

        $form->text('title', __('Titre du document'))->required();
        $form->file('file', __('Fichier'))->disk('public')->move('pdf/carambole/classement')->uniqueName()->required();
        $form->hidden('discipline')->default(2);

        $form->html('
                    <div>
                        <p style="font-size:12px; margin-bottom:15px;">
                            <span style="color:red;">*</span>
                            Champs obligatoires
                        </p>
                '
            );

        // Forcer discipline = 2 même en cas de triche
        $form->saving(function (Form $form) {
            $form->discipline = 2;
        });

        return $form;
    }
}
