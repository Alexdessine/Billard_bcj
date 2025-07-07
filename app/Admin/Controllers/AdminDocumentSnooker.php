<?php

namespace App\Admin\Controllers;

use \App\Models\Document;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use Illuminate\Support\Facades\Storage;
use OpenAdmin\Admin\Controllers\AdminController;

class AdminDocumentSnooker extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Document';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Document());

        // Filtrer pour ne voir que les documents Blackball
        $grid->model()->where('discipline', 3);

        $grid->column('title', __('Titre'));
        $grid->column('file', __('Fichier'));

        return $grid;
    }
protected function detail($id)
{
    $show = new Show(Document::findOrFail($id));

    $show->field('title', __('Title'));

    $show->field('file', __('File'))->as(function ($file) {
        if ($file) {
            $url = Storage::disk('public')->url($file);
            return "<iframe src='{$url}' width='100%' height='800px' style='border:none;'></iframe>";
        }
        return '';
    })->unescape(); // ⚡ pour autoriser le HTML

    return $show;
}

    protected function form()
    {
        $form = new Form(new Document());

        $form->text('title', __('Titre'));

        // Gérer l'upload dans /storage/app/public/pdf/snooker
        $form->file('file', __('File'))->disk('public')->move('pdf/snooker')->uniqueName();

        // Discipline Snooker forcée
        $form->hidden('discipline')->default(3);

        // Forcer discipline = 3 même en cas de triche
        $form->saving(function (Form $form) {
            $form->discipline = 3;
        });

        return $form;
    }
}