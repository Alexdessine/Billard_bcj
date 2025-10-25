<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\CuescoreEquipesRegionale;
use OpenAdmin\Admin\Layout\Content;

class AdminCuescoreEquipesRegionale extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CuescoreEquipesRegionale';

    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description('Liste des liens vers les classements des équipes régionales CueScore')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CuescoreEquipesRegionale());

        $grid->header(function () {
            $url = admin_url('blackball/classement');
            return <<<HTML
                <a href="{$url}" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au classement Blackball
                </a>
            HTML;
        });
        $grid->column('nom', __('Nom'));
        $grid->column('id', __('Id'));
        $grid->column('url', __('Url'));

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
        $show = new Show(CuescoreEquipesRegionale::findOrFail($id));

        $url = admin_url('blackball/classement');
        $show->setResource(admin_url('blackball/classement')); // Optionnel
    
        $show->panel()
            ->tools(function ($tools) use ($url) {
                $tools->prepend(<<<HTML
                    <div style="margin-bottom: 10px;">
                        <a href="{$url}" class="btn btn-primary" style="width: 250px; display: flex; justify-content: center;">
                            ↩️ Retour au classement Blackball
                        </a>
                    </div>
                HTML);
            });

        $show->field('nom', __('Nom'));
        $show->field('id', __('Id'));
        $show->field('url', __('Url'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CuescoreEquipesRegionale());

        $url = admin_url('blackball/classement');
        $form->html('               
            <a href="' . $url . '" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au classement Blackball
                </a>
            '
        );

        $form->text('nom', __('Nom'));
        $form->number('id', __('Identifiant Cuescore'));
        $form->url('url', __('Adresse lien Cuescore'));

        return $form;
    }
}
