<?php

namespace App\Admin\Controllers\americain;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\AmericainCalendrierRegional;

class AdminAmericainCalendrierRegional extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Calendrier régional - Discipline américain';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AmericainCalendrierRegional());

        $grid->header(function () {
            $url = admin_url('americain/calendrier');
            return <<<HTML
                <a href="{$url}" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Américain
                </a>
            HTML;
        });

        $grid->column('id', __('Id'));
        $grid->column('date_debut', __('Date debut'));
        $grid->column('date_fin', __('Date fin'));
        $grid->column('titre', __('Titre'));
        $grid->column('lieu', __('Lieu'));
        $grid->column('club', __('Club'));
        $grid->column('actions', __('Liens'))->display(function () {
            $linkExists = \App\Models\AmericainRegionalLink::where('calendrier_id', $this->id)->exists();

            if ($linkExists) {
                return '<a href="/admin/americain/liens_cuescore/regional-links?calendrier_id=' . $this->id . '" class="btn btn-sm btn-primary">Voir les liens Cuescore</a>';
            } else {
                return '<a href="/admin/americain/liens_cuescore/regional-links/create?calendrier_id=' . $this->id . '" class="btn btn-sm btn-warning">Ajouter les liens Cuescore</a>';
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
        $show = new Show(AmericainCalendrierRegional::findOrFail($id));

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

        $show->field('id', __('Id'));
        $show->field('date_debut', __('Date debut'));
        $show->field('date_fin', __('Date fin'));
        $show->field('titre', __('Titre'));
        $show->field('lieu', __('Lieu'));
        $show->field('club', __('Club'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AmericainCalendrierRegional());

        $url = admin_url('americain/calendrier');
        $form->html('               
            <a href="' . $url . '" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Américain
                </a>
            '
        );

        $form->date('date_debut', __('Date debut'))->default(date('Y-m-d'))->required();
        $form->date('date_fin', __('Date fin'))->default(date('Y-m-d'))->required();
        $form->text('titre', __('Titre'))->required();
        $form->text('lieu', __('Lieu'))->required();
        $form->text('club', __('Club'));


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
