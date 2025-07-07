<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use OpenAdmin\Admin\Layout\Content;

class AdminDocumentBlackball extends AdminController
{
    protected $title = 'Document Blackball';

    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description('Liste de la documentation blackball')
            ->body($this->grid());
    }

    protected function grid()
    {
        $grid = new Grid(new Document());

        // Filtrer pour ne voir que les documents Blackball
        $grid->model()->where('discipline', 1);

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

        // Gérer l'upload dans /storage/app/public/pdf/blackball
        $form->file('file', __('File'))->disk('public')->move('pdf/blackball')->uniqueName();

        // Discipline Blackball forcée
        $form->hidden('discipline')->default(1);

        // Forcer discipline = 1 même en cas de triche
        $form->saving(function (Form $form) {
            $form->discipline = 1;
        });

        return $form;
    }
}
