<?php

namespace App\Helpers;

use DateTime;

class CalendrierHelper
{

    public static function afficher($calendrier)
    {

        $today = new DateTime();

        foreach ($calendrier as $row) {
            echo "<tr>";
            echo "<td>Du " . htmlspecialchars($row->date_debut) . " au " . htmlspecialchars($row->date_fin) . "</td>";
            echo "<td>" . htmlspecialchars($row->titre) . "</td>";
            echo "<td>" . htmlspecialchars($row->lieu) . "</td>";
            echo "<td>" . htmlspecialchars($row->club) . "</td>";
            echo "<td>";
            if ($today < new DateTime($row->date_debut)) {
                // Si la date actuelle est inférieure à la date de début
                echo "<p class='text-4xs text-center text-yellow-600'>À venir</p>";
            } elseif ($today >= new DateTime($row->date_debut) && $today <= new DateTime($row->date_fin)) {
                // Si la date actuelle est entre la date de début et la date de fin
                echo "<p class='text-4xs text-center text-green-600'>En cours</p>";
            } else {
                // Si la date actuelle est supérieure à la date de fin
                echo "<a href='" . htmlspecialchars($row->url) . "' target='_blank'>Voir détail</a>";
            }
            echo "</td>";
        }
    }
}