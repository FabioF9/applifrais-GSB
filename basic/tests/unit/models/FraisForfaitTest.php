<?php

namespace tests\unit\models;

use app\models\Fraisforfait;
use Codeception\Test\Unit;

class FraisforfaitTest extends Unit
{
    public function testCheckDouble()
    {
        // Création d'un objet Fraisforfait pour tester
        $fraisForfait = new Fraisforfait();

        // Simuler des valeurs pour les attributs nécessaires
        $fraisForfait->idFraisForfait = '39';
        $fraisForfait->date = '2024-04-18';
        $fraisForfait->idVisiteur = 'a131';

        // Appeler la méthode checkDouble
        $fraisForfait->checkDouble('idFraisForfait', []);

        // Vérifier qu'aucune erreur n'a été ajoutée
        $this->assertFalse($fraisForfait->hasErrors());
    }
}
