<?php

namespace App\Helpers;

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
                echo "<td>" . htmlspecialchars($row->classement) . ($row->classement == 1 ? 'er' : "ème") . "</td>";
                echo "<td>" . htmlspecialchars($row->joueur) . "</td>";
                echo "<td style='text-align:right;'>" . htmlspecialchars($row->points) . " points</td>";
                echo "</tr>";
            }
        }else {
            echo "";
        }
    }
}