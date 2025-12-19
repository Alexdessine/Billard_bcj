<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\CuescoreRegional;
use OpenAdmin\Admin\Layout\Content;

class AdminCuescoreRegional extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lien Cuescore Classement Regional';

    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description('Liste des liens vers les classements régionaux CueScore')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CuescoreRegional());

        $grid->header(function () {
            $url = admin_url('blackball/classement');
            return <<<HTML
                <a href="{$url}" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au classement Blackball
                </a>
            HTML;
        });
        

        $grid->column('Top ligue', __('Top ligue'));
        $grid->column('mixte', __('Mixte'));
        $grid->column('feminin', __('Feminin'));
        $grid->column('handi-fauteuil', __('Handi fauteuil'));
        $grid->column('handi-debout', __('Handi debout'));
        $grid->column('benjamin (U15)', __('Benjamin (U15)'));
        $grid->column('junior', __('Junior (U18)'));
        $grid->column('espoirs (U23)', __('Espoirs (U23)'));
        $grid->column('veteran', __('Veteran'));

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
        $show = new Show(CuescoreRegional::findOrFail($id));

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


        $show->field('Top ligue', __('Top ligue'));
        $show->field('mixte', __('Mixte'));
        $show->field('feminin', __('Feminin'));
        $show->field('handi-fauteuil', __('Handi fauteuil'));
        $show->field('handi-debout', __('Handi debout'));
        $show->field('benjamin (U15)', __('Benjamin (U15)'));
        $show->field('junior', __('Junior'));
        $show->field('espoirs (U23)', __('Espoirs (U23)'));
        $show->field('veteran', __('Veteran'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
{
    $form = new Form(new CuescoreRegional());

    $url = admin_url('blackball/classement');
    $form->html('
        <a href="' . $url . '" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
            ↩️ Retour au classement Blackball
        </a>
    ');

    // Déclaration des champs
    $form->number('top_ligue', 'Top ligue');
    $form->number('mixte', 'Mixte');
    $form->number('feminin', 'Feminin');
    $form->number('handi_fauteuil', 'Handi fauteuil');
    $form->number('handi_debout', 'Handi debout');
    $form->number('benjamin_u15', 'Benjamin (U15)');
    $form->number('junior', 'Junior (U18)');
    $form->number('espoirs_u23', 'Espoirs (U23)');
    $form->number('veteran', 'Veteran');

    // ✅ Pré-remplissage explicite en édition
    // Quand on est en "edit", le modèle a un id.
    if ($form->model() && $form->model()->getKey()) {
        $m = $form->model();

        $form->fill([
            'top_ligue'      => $m->top_ligue,
            'mixte'          => $m->mixte,
            'feminin'        => $m->feminin,
            'handi_fauteuil' => $m->handi_fauteuil,
            'handi_debout'   => $m->handi_debout,
            'benjamin_u15'   => $m->benjamin_u15,
            'junior'         => $m->junior,
            'espoirs_u23'    => $m->espoirs_u23,
            'veteran'        => $m->veteran,
        ]);
    }

    // Notice (inchangée)
    $form->html('
        <div class="alert alert-info text-center mt-4" role="alert" style="font-size:16px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); position:relative;">
            <div style="
                position: absolute;
                top: -15px;
                left: 20px;
                background-color: #3490dc;
                color: white;
                padding: 5px 15px;
                font-size: 14px;
                font-weight: bold;
                border-radius: 20px;
                box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            ">
                NOTICE
            </div>

            <h3 style="font-weight:bold; font-size: 24px; text-align:center; margin-top:20px; margin-bottom:20px;">
                ℹ️ Notice Explicative ℹ️
            </h3>
            <p style="font-size:18px; margin-bottom:15px;">
                🔎 Pour trouver les ID et actualiser les classements, suivez ce lien :
                <a href="https://cuescore.com/centre-valdeloire/rankings" target="_blank" style="font-weight:bold; text-decoration:underline; color:#007bff;">
                    Classement Regional
                </a>
            </p>
            <div style="text-align:center; margin-bottom:20px;">
                <p style="margin-bottom:10px;">Vous verrez une page comme celle-ci ⬇️</p>
                <img src="/img/notice/accueil_classement_cuescore.png" alt="Page classement CueScore" style="width:35%; height:auto; border-radius:6px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);"/>
            </div>
            <div style="line-height:1.8;">
                1 - Sélectionner l\'année qui vous intéresse (Ex : <strong>2025</strong>)<br>
                2 - Sélectionner un classement (Ex : <strong>Handi-fauteuil 24-25</strong>)<br>
                3 - Cliquez sur le bouton <strong>"AFFICHER LE CLASSEMENT COMPLET"</strong><br>
                4 - Vous obtiendrez l\'url suivante dans la barre d\'adresse :<br>
                <div style="text-align:center; margin: 15px 0;">
                    <img src="/img/notice/url_handi.png" alt="URL classement complet" style="width:35%; height:auto; border-radius:6px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);"/>
                </div>
                5 - Récupérez le numéro contenu après le dernier "/" (Ex : <strong>48149146</strong>)<br>
                6 - Renseignez cet identifiant dans le champ correspondant (Ex : <strong>Handi fauteuil -> 48149146</strong>)<br>
                7 - Répétez l\'opération pour chaque classement que vous souhaitez mettre à jour.<br>
            </div>
        </div>
    ');

    return $form;
}
}
