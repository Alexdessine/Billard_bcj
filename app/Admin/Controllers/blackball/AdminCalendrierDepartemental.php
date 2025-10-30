<?php

namespace App\Admin\Controllers\blackball;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Calendrier_departemental;
use App\Models\DepartementalLink;

class AdminCalendrierDepartemental extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Calendrier départemental';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Calendrier_departemental());

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
        $grid->column('date_limite', __('Date limite'));
        $grid->column('titre', __('Titre'));
        $grid->column('lieu', __('Lieu'));
        $grid->column('club', __('Club'));
        $grid->column('url', __('Url'));
        $grid->column('actions', __('Liens'))->display(function () {
            $linkExists = DepartementalLink::where('calendrier_id', $this->id)->exists();

            if ($linkExists) {
                return '<a href="/admin/departemental-links?calendrier_id=' . $this->id . '" class="btn btn-sm btn-primary">Voir les liens Cuescore</a>';
            } else {
                return '<a href="/admin/departemental-links/create?calendrier_id=' . $this->id . '" class="btn btn-sm btn-warning">Ajouter les liens Cuescore</a>';
            }
        });

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
        $show = new Show(Calendrier_departemental::findOrFail($id));

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
        $show->field('date_limite', __('Date limite'));
        $show->field('titre', __('Titre'));
        $show->field('lieu', __('Lieu'));
        $show->field('club', __('Club'));
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
        $form = new Form(new Calendrier_departemental());

        $url = admin_url('blackball/calendrier');
        $form->html('               
            <a href="' . $url . '" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Blackball
                </a>
            '
        );

        $form->date('date_debut', __('Date debut'))->default(date('Y-m-d'))->required();
        $form->date('date_fin', __('Date fin'))->default(date('Y-m-d'))->required();
        $form->date('date_limite', __('Date limite'))->default(date('Y-m-d'));
        $form->text('titre', __('Titre'))->required();
        $form->text('lieu', __('Lieu'))->required();
        $form->text('club', __('Club'))->required();
        $form->url('url', __('Url'));

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
