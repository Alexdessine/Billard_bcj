<?php

namespace App\Admin\Controllers;

use \App\Models\Index;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Admin\Extensions\Ckeditor\Ckeditor;
use OpenAdmin\Admin\Controllers\AdminController;

class AdminIndex extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Index';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Index());

        $grid->column('id', __('Id'));
        $grid->column('content', __('Content'))->display(function ($content) {
            return "<div style='max-width: 300px;'>$content</div>";
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Index::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('content', __('Content'))->as(function ($content) {
            return $content;
        });
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Index());
    //     $form->html('
    //     <!-- Nouvelle notice pour la mise en forme -->
    //     <div class="alert alert-warning mt-4" role="alert" style="font-size:15px; line-height:1.8; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    //         <h4 style="font-weight:bold; margin-bottom:10px;">🛠️ Mise en forme du contenu</h4>
    //         <p>Vous pouvez utiliser les balises HTML suivantes pour enrichir le texte :</p>
    //         <ul style="padding-left:20px;">
    //             <li><code>&lt;strong&gt;Texte important&lt;/strong&gt;</code> → <strong>Texte important</strong></li>
    //             <li><code>&lt;em&gt;Texte en italique&lt;/em&gt;</code> → <em>Texte en italique</em></li>
    //             <li><code>&lt;u&gt;Texte souligné&lt;/u&gt;</code> → <u>Texte souligné</u></li>
    //             <li><code>&lt;br&gt;</code> → Retour à la ligne</li>
    //             <li><code>&lt;a href="url"&gt;Lien&lt;/a&gt;</code> → <a href="#">Lien</a></li>
    //         </ul>
    //         <p style="margin-top:10px;">💡 Vous pouvez combiner ces balises pour structurer votre contenu.</p>
    //     </div>
    // ');

        $form->ck5('content', __('Contenu'))->rows(700);

        // dd($form);
        return $form;
    }
}
