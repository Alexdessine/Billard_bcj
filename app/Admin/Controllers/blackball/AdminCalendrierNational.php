<?php

namespace App\Admin\Controllers\blackball;

use Carbon\Carbon;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\NationalLink;
use \App\Models\Calendrier_national;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Layout\Content;

class AdminCalendrierNational extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Calendrier national';

        public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description('Liste des liens vers le calendrier national')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Calendrier_national());

        $grid->header(function () {
            $url = admin_url('blackball/calendrier');
            return <<<HTML
                <a href="{$url}" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Blackball
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
        $show = new Show(Calendrier_national::findOrFail($id));

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

        $show->field('date_debut', __('Date debut'));
        $show->field('date_fin', __('Date fin'));
        $show->field('date_limite', __('Date limite d\'inscription'))->display(function ($value) {
            $now = Carbon::now();
            $dateLimit = Carbon::parse($value);

            if ($now->greaterThan($dateLimit)) {
                return '<span style="color: red; text-decoration: line-through;">' . e($dateLimit->format('Y-m-d')) . '</span>';
            } else {
                return e($dateLimit->format('Y-m-d'));
            }
        })->unescape();
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
        $form = new Form(new Calendrier_national());

        $url = admin_url('blackball/calendrier');
        $form->html('               
            <a href="' . $url . '" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au calendrier Blackball
                </a>
            '
        );

        $form->date('date_debut', __('Date debut'))->default(date('Y-m-d'))->required();
        $form->date('date_fin', __('Date fin'))->default(date('Y-m-d'))->required();
        $form->date('date_limite', __('Date Limite d\'inscription'))->default(date('Y-m-d'));
        $form->text('titre', __('Titre'))->required();
        $form->text('lieu', __('Lieu'))->required();
        $form->text('club', __('Club'))->required();

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
