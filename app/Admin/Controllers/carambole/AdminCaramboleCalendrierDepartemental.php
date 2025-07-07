<?php

namespace App\Admin\Controllers\carambole;

use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use OpenAdmin\Admin\Layout\Content;
use OpenAdmin\Admin\Controllers\AdminController;
use \App\Models\CaramboleCalendrierDepartemental;

class AdminCaramboleCalendrierDepartemental extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Calendrier départemental - Discipline carambole';

    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description('Liste des liens vers le calendrier départemental')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CaramboleCalendrierDepartemental());


        $grid->header(function () {
            $url = admin_url('carambole/calendrier');
            return <<<HTML
                <a href="{$url}" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Carambole
                </a>
            HTML;
        });

        // $grid->column('id', __('id'));
        $grid->column('date_debut', __('Date debut'));
        $grid->column('date_fin', __('Date fin'));
        $grid->column('titre', __('Tournoi'));
        $grid->column('lieu', __('Lieu'));
        $grid->column('club', __('Club'));
        // $grid->column('url', __('Lien SportEasy'));
        $grid->column('actions', __('Liens'))->display(function () {
            $linkExists = \App\Models\NationalLink::where('calendrier_id', $this->id)->exists();

            if ($linkExists) {
                return '<a href="/admin/national-links?calendrier_id=' . $this->id . '" class="btn btn-sm btn-primary">Voir les liens Cuescore</a>';
            } else {
                return '<a href="/admin/national-links/create?calendrier_id=' . $this->id . '" class="btn btn-sm btn-warning">Ajouter les liens Cuescore</a>';
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
        $show = new Show(CaramboleCalendrierDepartemental::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CaramboleCalendrierDepartemental());



        return $form;
    }
}
