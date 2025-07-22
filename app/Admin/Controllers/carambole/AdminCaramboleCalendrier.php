<?php

namespace App\Admin\Controllers\carambole;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\CaramboleCalendrier;
use Illuminate\Support\Facades\Storage;
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

        $grid->header(function () {
            $url = admin_url('carambole/calendrier');
            return <<<HTML
                <a href="{$url}" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Carambole
                </a>
            HTML;
        });

        // $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('url', __('Fichier'));

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

        $url = admin_url('carambole/calendrier');
        $show->setResource(admin_url('carambole/calendrier')); // Optionnel

        $show->panel()
            ->tools(function ($tools) use ($url) {
                $tools->prepend(<<<HTML
                    <div style="margin-bottom: 10px;">
                        <a href="{$url}" class="btn btn-primary" style="width: 250px; display: flex; justify-content: center;">
                            ↩️ Retour au calendrier Carambole
                        </a>
                    </div>
                HTML);
            });

        $show->field('title', __('Title'));
        $show->field('url', __('Fichier'))->as(function ($file) {
            if ($file) {
                $url = Storage::disk('public')->url($file);
                return "<iframe src='{$url}' width='100%' height='800px' style='border:none;'></iframe>";
            }
            return '';
        })->unescape(); // ⚡ pour autoriser le HTML

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

        $url = admin_url('carambole/calendrier');
        $form->html('               
            <a href="' . $url . '" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Carambole
                </a>
            '
        );

        $form->text('title', __('Titre'))->required();

        // Gérer l'upload dans /storage/app/public/pdf/carambole/calendrier
        $form->file('url')
            ->disk('public')
            ->move('pdf/carambole/calendrier')
            ->uniqueName()
            ->rules('mimes:pdf')
            ->attribute(['accept' => 'application/pdf'])
            ->help('Seuls les fichiers PDF sont autorisés.')
            ->required();

        // Discipline Carambole forcée
        $form->hidden('discipline')->default(2);

        // Forcer discipline = 2 même en cas de triche
        $form->saving(function (Form $form) {
            $form->discipline = 2;
        });

        $form->html('
                    <div>
                        <p style="font-size:12px; margin-bottom:15px;">
                            <span style="color:red;">*</span>
                            Champs obligatoires
                        </p>
                '
            );

        return $form;
    }
}
