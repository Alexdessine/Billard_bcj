<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\SiteSetting;
use App\Models\Menu;
use OpenAdmin\Admin\Admin;
use OpenAdmin\Admin\Layout\Content;

class SiteSettingDashboardController extends AdminController
{
    protected $title = 'Paramètres du site';

    public function index(Content $content)
    {
        $settings = SiteSetting::first();
        $menus = Menu::all();

        Admin::script(<<<'JS'
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.api-field').forEach(input => {
                    const toggleBtn = document.createElement('button');
                    toggleBtn.textContent = 'Afficher';
                    toggleBtn.type = 'button';
                    toggleBtn.style.marginLeft = '10px';
                    input.type = 'password';
                    input.parentElement.appendChild(toggleBtn);

                    toggleBtn.addEventListener('click', () => {
                        input.type = input.type === 'password' ? 'text' : 'password';
                        toggleBtn.textContent = input.type === 'password' ? 'Afficher' : 'Masquer';
                    });
                });
            });
        JS);

        return $content
            ->title('Paramètres du site')
            ->description('Bienvenue dans l\'administration')
            ->row(view('admin.settings.dashboard', compact('settings', 'menus')));
    }
}
