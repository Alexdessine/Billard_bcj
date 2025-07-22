<?php

namespace App\Admin\Controllers\blackball;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Calendrier_international;
use OpenAdmin\Admin\Layout\Content;


class AdminCalendrierInternational extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Calendrier_international';

    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description('Liste des liens vers le calendrier international')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Calendrier_international());

        $grid->header(function () {
            $url = admin_url('blackball/calendrier');
            return <<<HTML
                <a href="{$url}" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Blackball
                </a>
            HTML;
        });

        $grid->column('id', __('Id'));
        $grid->column('date_debut', __('Date debut'));
        $grid->column('date_fin', __('Date fin'));
        $grid->column('titre', __('Titre'));
        $grid->column('lieu', __('Lieu'));

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
        $show = new Show(Calendrier_international::findOrFail($id));

        $url = admin_url('blackball/calendrier');
        $show->setResource(admin_url('blackball/calendrier')); // Optionnel

        $show->panel()
            ->tools(function ($tools) use ($url) {
                $tools->prepend(<<<HTML
                    <div style="margin-bottom: 10px;">
                        <a href="{$url}" class="btn btn-primary" style="width: 250px; display: flex; justify-content: center;">
                            ↩️ Retour au calendrier Blackball
                        </a>
                    </div>
                HTML);
            });

        $show->field('id', __('Id'));
        $show->field('date_debut', __('Date debut'));
        $show->field('date_fin', __('Date fin'));
        $show->field('titre', __('Titre'));
        $show->field('lieu', __('Lieu'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Calendrier_international());

        $url = admin_url('blackball/calendrier');
        $form->html('               
            <a href="' . $url . '" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Blackball
                </a>
            '
        );

        $form->date('date_debut', __('Date debut'))->default(date('Y-m-d'))->required();
        $form->date('date_fin', __('Date fin'))->default(date('Y-m-d'))->required();
        $form->text('titre', __('Titre'))->required();
        $form->text('lieu', __('Lieu'))->required();

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
