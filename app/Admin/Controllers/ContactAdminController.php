<?php

namespace App\Admin\Controllers;

use \App\Models\Contact;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use OpenAdmin\Admin\Admin;
use OpenAdmin\Admin\Controllers\AdminController;

class ContactAdminController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Contact';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Contact());

        $grid->column('id', __('Id'));
        $grid->column('message', __('Message'));
        $grid->column('mail', __('Mail'));
        $grid->column('telephone', __('Telephone'));

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
        $show = new Show(Contact::findOrFail($id));

        $show->field('message', __('Message'));
        $show->field('mail', __('Mail'));
        $show->field('telephone', __('Telephone'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Contact());

        $form->ck5('message', __('Message'))->rows(700)->required();
        $form->email('mail', __('Mail'))->required();
        $form->text('telephone', 'Téléphone')
            ->rules(['required', 'regex:/^0[1-9]( ?\d{2}){4}$/'])
            ->help('Format attendu : 06 12 34 56 78');
        Admin::script(<<<'JS'
            document.addEventListener('DOMContentLoaded', function () {
                const telInput = document.querySelector('input[name="telephone"]');
                if (telInput) {
                    telInput.setAttribute('placeholder', '06 12 34 56 78');
                    telInput.addEventListener('input', function (e) {
                        let numbers = e.target.value.replace(/\D/g, '');
                        let result = '';
                        for (let i = 0; i < numbers.length && i < 10; i += 2) {
                            result += numbers.substr(i, 2) + ' ';
                        }
                        e.target.value = result.trim();
                    });
                }
            });
            JS);
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
