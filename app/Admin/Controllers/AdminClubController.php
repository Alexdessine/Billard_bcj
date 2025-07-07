<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use OpenAdmin\Admin\Admin;
use OpenAdmin\Admin\Controllers\Dashboard;
use OpenAdmin\Admin\Layout\Column;
use OpenAdmin\Admin\Layout\Content;
use OpenAdmin\Admin\Layout\Row;

class AdminClubController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Tableau de bord')
            ->description('Bienvenue dans l\'administration')
            ->row(view('admin.club.dashboard'));
    }

}