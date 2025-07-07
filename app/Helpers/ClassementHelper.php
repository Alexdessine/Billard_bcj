<?php

namespace App\Helpers;

use App\Models\ClassementCarambole;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Facades\Excel;

class ClassementHelper
{
    private $classementData;

    public function __construct($classementData) {
        $this->classementData = $classementData;
    }

    public static function afficher($classementData)
    {
        if($classementData->isNotEmpty()) {
            foreach ($classementData as $row) {
                echo "<tr>";
                echo "<td class='rang'>" . htmlspecialchars($row->classement) . ($row->classement == 1 ? 'er' : "ème") . "</td>";
                echo "<td class='nom'>" . htmlspecialchars($row->joueur) . "</td>";
                echo "<td class='points' style='text-align:right;'>" . htmlspecialchars($row->points) . " points</td>";
                echo "</tr>";
            }
        }else {
            echo "";
        }
    }

        public static function classementCarambole($discipline)
    {
        return ClassementCarambole::where('discipline', $discipline)->get();
    }

    static function getAllExcelData($path = 'public/pdf/carambole/excel')
    {
        $files = Storage::files($path);
        $previews = [];

        foreach ($files as $file) {
            $localPath = storage_path('app/' . $file);
            $spreadsheet = IOFactory::load($localPath);

            $fileData = [
                'filename' => basename($file),
                'url' => Storage::url($file),
                'sheets' => []
            ];

            foreach ($spreadsheet->getSheetNames() as $index => $sheetName) {

                $sheet = $spreadsheet->getSheet($index);
                $rows = $sheet->toArray(null, true, true, true);

                $fileData['sheets'][] = [
                    'name' => $sheetName,
                    'rows' => $rows,
                ];
            }

            $results[] = $fileData;
        }

        return $results;
    }
}