<?php

namespace App\Helpers;

use DateTime;
use App\Models\SnookerCalendrier;
use App\Models\AmericainCalendrier;
use App\Models\CaramboleCalendrier;

class CalendrierHelper
{
    public static function afficher($calendrier, $type)
    {
        $today = new DateTime();
        $parentId = "accordion{$type}"; // Identifiant unique pour le groupe d'accordéons

        foreach ($calendrier as $row) {
            $collapseId = "collapse{$type}{$row->id}"; // Identifiant unique

            $links = $row->links ? $row->links->getAvailableLinks() : [];
            $linkHtml = "";

            if (!empty($links)) {
                foreach ($links as $link) {
                    $linkHtml .= "<a href='{$link['url']}' target='_blank' class='badge {$link['label']} bg-primary me-1'>{$link['label']}</a>";
                }
            }

            $linked = "";
            if (!empty($row->url)) {
                $linked = "<a href='{$row->url}' target='_blank' class='sportEasy btn btn-success me-1'><i class='fa-solid fa-cart-shopping'> </i> Inscription sur SportEasy</a>";
            }

            
            $dateFinAffichage = date("d-m-Y", strtotime($row->date_fin));
            $now = new DateTime();
            $dateFin = new DateTime($row->date_fin);
            $dateLimite = new DateTime($row->date_limite);
            $dateDebut = new DateTime($row->date_debut);

            $dateDebutAffichage = $dateDebut->format("d-m-Y");
            $dateFinAffichage = $dateFin->format("d-m-Y");

            echo <<<HTML
                <div class='accordion-item'>
                    <h2 class='accordion-header'>
                        <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#$collapseId' aria-expanded='false' aria-controls='$collapseId'>
                            {$row->titre} du $dateDebutAffichage au $dateFinAffichage
                        </button>
                    </h2>
                    <div id='$collapseId' class='accordion-collapse collapse' data-bs-parent='#$parentId'>
            HTML;

            if (!empty(trim($linkHtml))) {
                if ($now > $dateFin) {
                    echo "<div class='accordion-body'><strong>🏆 Voir les classements : </strong><br>$linkHtml</div>";
                } elseif ($now > $dateLimite) {
                    echo "<div class='accordion-body'><strong>🏆 Liste des inscrits : </strong><br>$linkHtml</div>";
                } else {
                    echo "<div class='accordion-body'><strong>🏆 Liens d'inscriptions : </strong><br>$linkHtml</div>";
                }
            }

            echo <<<HTML
                        <div class='accordion-body'>
                            <strong>📍{$row->titre} </strong><br> 
                            <strong>📅 Lieu : </strong>{$row->lieu}<br>
            HTML;

            if (!empty($row->club)) {
                echo "<strong>🎱 Club organisateur : </strong> {$row->club} <br>";
            }

            echo <<<HTML
                            <strong>⏳ Date de l'évènement :</strong> du $dateDebutAffichage au $dateFinAffichage
                        </div>
            HTML;

            // Si le type est "International" (insensible à la casse)
            if (strtolower($type) === 'blackball_international') {
                echo "<br><div class='accordion-body sportEasy'><a href='https://tih.bcj37.fr' target='_blank' class='sportEasy btn btn-success me-1 m-auto'>
                        🌍 Voir la compétition internationale
                    </a></div>";
            }

            if (!empty($row->url)) {
                echo "<div class='accordion-body sportEasy'>$linked</div>";
            }

            echo <<<HTML
                    </div>
                </div>

                <!-- <script>
                    const el = document.getElementById('$collapseId');
                    if (el) {
                        const observer = new MutationObserver(mutations => {
                            mutations.forEach(mutation => {
                                if (mutation.attributeName === 'class') {
                                    const classList = mutation.target.classList;
                                    if (classList.contains('show') && classList.contains('collapse')) {
                                        classList.remove('collapse');
                                        console.log('Classe "collapse" supprimée sur #$collapseId car "show" a été ajoutée.');
                                    }
                                }
                            });
                        });

                        observer.observe(el, {
                            attributes: true,
                            attributeFilter: ['class']
                        });
                    }
                </script> -->
            HTML;
        }
    }

    public static function calendrierParDiscipline(string $discipline)
    {
        $modelMap = [
            'carambole' => CaramboleCalendrier::class,
            'americain' => AmericainCalendrier::class,
            'snooker' => SnookerCalendrier::class,
        ];

        if (!isset($modelMap[$discipline])) {
            return collect(); //Retourne une collection vide si la discipline n'existe pas 
        }

        return $modelMap[$discipline]::where('discipline', self::disciplineCode($discipline))->get();
    }

    public static function disciplineCode(string $discipline): int
    {
        return match ($discipline) {
            'carambole' => 2,
            'snooker' => 3,
            'americain' => 4,
            default => 0,
        };
    }
}
