<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\CuescoreNational;
use OpenAdmin\Admin\Layout\Content;

class AdminCuescoreNational extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lien Cuescore Classement National';


    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description('Liste des liens vers les classements nationaux CueScore')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CuescoreNational());

        $grid->header(function () {
            $url = admin_url('blackball/classement');
            return <<<HTML
                <a href="{$url}" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au classement Blackball
                </a>
            HTML;
        });


        $grid->column('Blackball Master', __('Blackball Master'));
        $grid->column('mixte', __('Mixte'));
        $grid->column('mixte tableau A', __('Mixte tableau A'));
        $grid->column('mixte tableau B', __('Mixte tableau B'));
        $grid->column('feminin', __('Feminin'));
        $grid->column('juniors (U18)', __('Juniors (U18)'));
        $grid->column('espoirs (U23)', __('Espoirs (U23)'));
        $grid->column('veterans', __('Veterans'));
        $grid->column('handi fauteuil', __('Handi fauteuil'));

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
        $show = new Show(CuescoreNational::findOrFail($id));

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

        $show->field('Blackball Master', __('Blackball Master'));
        $show->field('mixte', __('Mixte'));
        $show->field('mixte tableau A', __('Mixte taleau A'));
        $show->field('mixte tableau B', __('Mixte taleau B'));
        $show->field('feminin', __('Feminin'));
        $show->field('juniors (U18)', __('Juniors (U18)'));
        $show->field('espoirs (U23)', __('Espoirs (U23)'));
        $show->field('veterans', __('Veterans'));
        $show->field('handi fauteuil', __('Handi fauteuil'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CuescoreNational());

        $url = admin_url('blackball/classement');
        $form->html('               
            <a href="' . $url . '" class="btn btn-primary" style="margin: auto; margin-bottom: 10px; justify-content:center; display:flex; width:250px;">
                ↩️ Retour au classement Blackball
                </a>
            '
        );
        $form->number('Blackball Master', __('Blackball Master'));
        $form->number('mixte', __('Mixte'));
        $form->number('mixte tableau A', __('Mixte tableau A'));
        $form->number('mixte tableau B', __('Mixte tableau B'));
        $form->number('feminin', __('Feminin'));
        $form->number('juniors (U18)', __('Juniors (U18)'));
        $form->number('espoirs (U23)', __('Espoirs (U23)'));
        $form->number('veterans', __('Veterans'));
        $form->number('handi fauteuil', __('Handi fauteuil'));

        $form->html('
                <div class="alert alert-info text-center mt-4" role="alert" style="font-size:16px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1)">
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
        
                    <h3 style="font-weight:bold; font-size: 24px; text-align:center; margin-top:10px; margin-bottom:20px;">
                        ℹ️ Notice Explicative ℹ️
                    </h3>
                    <p style="font-size:18px; margin-bottom:15px;">
                        🔎 Pour trouver les ID et actualiser les classements, suivez ce lien :
                        <a href="https://cuescore.com/ffb/rankings?season=2024" target="_blank" style="font-weight:bold; text-decoration:underline; color:#007bff;">
                            Classement National
                        </a>
                    </p>
                    <div style="text-align:center; margin-bottom:20px;">
                        <p style="margin-bottom:10px;">Vous verrez une page comme celle-ci ⬇️</p>
                        <img src="/img/notice/accueil_classement_national_cuescore.png" alt="Page classement CueScore" style="width:35%; height:auto; border-radius:6px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);"/>
                    </div>
                    <div style="line-height:1.8;">
                            1 - Sélectionnez l\'année qui vous intéresse (ex: <strong>2024/2025</strong>).<br>
                            2 - Choisissez un classement (ex: <strong>BLACKBALL - TN - CLASSEMENT BBM - 2024 - 2025</strong>).<br>
                            3 - Cliquez sur le bouton <strong>"AFFICHER LE CLASSEMENT COMPLET"</strong>.<br>
                            4 - Vous obtiendrez l\'URL suivante dans la barre d\'adresse :</br>
                        <div style="text-align:center; margin: 15px 0;">
                            <img src="/img/notice/url_bbm_national.png" alt="URL classement complet" style="width:35%; height:auto; border-radius:6px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);"/>
                        </div>
                            5 - Récupérez le numéro après le dernier "/" (ex: <strong>45838045</strong>).<br>
                            6 - Indiquez cet identifiant dans le champ correspondant (ex: <strong>Blackball Master -> 45838045</strong>).<br>
                            7 - Répétez l\'opération pour chaque classement que vous souhaitez mettre à jour.<br>
                    </div>
                </div>
            '
        );

        $form->saved(function (Form $form) {
            admin_toastr('Classement mis à jour avec succès !', 'success');

            return redirect('admin/blackball/classement');
        });

        return $form;
    }
}
