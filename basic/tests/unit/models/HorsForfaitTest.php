<?php

namespace tests\unit\models;

use app\models\Horsforfait;
use Codeception\Test\Unit;

class HorsforfaitTest extends Unit
{
    public function testValidation()
    {
        $model = new Horsforfait();

        // Test des attributs requis
        $model->validate();
        $this->assertTrue($model->hasErrors('idVisiteur'));
        $this->assertTrue($model->hasErrors('date'));
        $this->assertTrue($model->hasErrors('Libellé'));
        $this->assertTrue($model->hasErrors('Montant'));

        // Test de l'attribut file (justificatif)
        $model->file = 'invalid file';
        $model->validate(['file']);
        $this->assertTrue($model->hasErrors('file'));

        // Test de la validation de la date
        $model->date = '2024-04-30'; // Date postérieure
        $model->validate(['date']);
        $this->assertTrue($model->hasErrors('date'));

        $model->date = 'invalid date'; // Format de date invalide
        $model->validate(['date']);
        $this->assertTrue($model->hasErrors('date'));

        // Test de la validation du montant
        $model->Montant = -10; // Montant négatif
        $model->validate(['Montant']);
        $this->assertTrue($model->hasErrors('Montant'));

        // Test de la validation réussie
        $model->idVisiteur = '1234';
        $model->date = '2024-04-18';
        $model->Libellé = 'Some Label';
        $model->Montant = 100;
        $model->validate();
        $this->assertFalse($model->hasErrors());
    }
}
