<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\SnookerClassement;

class AdminSnookerClassement extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Classement snooker';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SnookerClassement());

        $grid->column('id', __('Id'));
        $grid->column('mixte', __('Mixte'));
        $grid->column('url', __('Lien'));

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
        $show = new Show(SnookerClassement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('mixte', __('Mixte'));
        $show->field('url', __('Lien'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SnookerClassement());

        $form->number('mixte', __('Mixte'));
        $form->url('url', __('Lien'));
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
                            2 - Choisissez le classement snooker concerné (ex: <strong>Snooker - 2024/2025 - TN - Mixte</strong>).<br>
                            3 - Cliquez sur le bouton <strong>"AFFICHER LE CLASSEMENT COMPLET"</strong>.<br>
                            4 - Vous obtiendrez l\'URL suivante dans la barre d\'adresse :</br>
                        <div style="text-align:center; margin: 15px 0;">
                            <img src="/img/notice/url_bbm_national.png" alt="URL classement complet" style="width:35%; height:auto; border-radius:6px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);"/>
                        </div>
                            5 - Récupérez le numéro après le dernier "/" (ex: <strong>48281566</strong>).<br>
                            6 - Indiquez cet identifiant dans le champ correspondant (ex: <strong>Mixte -> 48281566</strong>).<br>
                            7 - Récupérer et indiquez l\'url du classement complet avant le dernier "/" (ex: <strong>https://cuescore.com/ranking/Snooker+-+2024%252F2025+-+TN+-+Mixte/</strong>).<br>
                            8 - Répétez l\'opération pour chaque classement que vous souhaitez mettre à jour.<br>
                    </div>
                </div>
            '
    );

        return $form;
    }
}
