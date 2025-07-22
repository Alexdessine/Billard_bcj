<?php

namespace App\Admin\Controllers\americain;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\AmericainCalendrier;
use Illuminate\Support\Facades\Storage;
use OpenAdmin\Admin\Layout\Content;

class AdminAmericainCalendrier extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Calendrier americain PDF';


    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description('Liste des liens vers le calendrier américain')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AmericainCalendrier());

        $grid->header(function () {
            $url = admin_url('americain/calendrier');
            return <<<HTML
                <a href="{$url}" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Américain
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
        $show = new Show(AmericainCalendrier::findOrFail($id));

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

        // $show->field('id', __('Id'));
        $show->field('title', __('Titre'));
        
        
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
        $form = new Form(new AmericainCalendrier());

        $url = admin_url('americain/calendrier');
        $form->html('               
            <a href="' . $url . '" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Américain
                </a>
            '
        );

        $form->text('title', __('Titre'))->required();
        
        // Gérer l'upload dans /storage/app/public/pdf/americain/calendrier
        $form->file('url', __('Fichier'))
            ->disk('public')
            ->move('pdf/americain/calendrier')
            ->uniqueName()
            ->rules('mimes:pdf')
            ->attribute(['accpet' => 'application/pdf'])
            ->help('Seuls les fichiers PDF sont autorisés.')
            ->required();

        // Disciplinle Americain forcée
        $form->hidden('discipline')->default(4);

        // Forcer discipline = 4 même en cas de triche
        $form->saving(function (Form $form) {
            $form->discipline = 4;
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
