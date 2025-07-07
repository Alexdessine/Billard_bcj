<?php

namespace App\Helpers;

use App\Models\Document;

class DocumentHelper
{
    public static function getDocumentByDiscipline($discipline)
    {
        return Document::where('discipline', $discipline)->get();
    }
}