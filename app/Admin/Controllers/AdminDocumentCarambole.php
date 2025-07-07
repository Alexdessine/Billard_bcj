<?php

namespace App\Admin\Controllers;

use \App\Models\Document;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use Illuminate\Support\Facades\Storage;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Layout\Content;

class AdminDocumentCarambole extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Document Carambole';

    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description('Liste des documents officiels carambole')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Document());

        // Filtrer pour ne voir que les documents Carambole
        $grid->model()->where('discipline', 2);

        $grid->column('title', __('Titre'));
        $grid->column('file', __('Fichier'));

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
        $show = new Show(Document::findOrFail($id));

        $show->field('title', __('Titre'));
        $show->field('file', __('Fichier'))->as(function ($file) {
            if ($file) {
                $url = Storage::disk('public')->url($file);
                return "<iframe src='{$url}' width='100%' height='800px' style='border:none;'></iframe>";
            }
            return '';
        })->unescape();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Document());

        $form->text('title', __('Titre'));

        // Gérer l'upload dans /storage/app/public/pdf/carambole
        $form->file('file', __('Fichier'))->disk('public')->move('pdf/carambole')->uniqueName();
        
        // Discipline Carambole forcée
        $form->hidden('discipline')->default(2);

        // Forcer discipline = 2 même en cas de triche
        $form->saving(function (Form $form) {
            $form->discipline = 2;
        });

        return $form;
    }
}
