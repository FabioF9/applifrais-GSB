<?php

use app\models\Fraisforfait;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$moisEnCours = date('n');
$moisEnFrancais = [
    1 => 'Janvier',
    2 => 'Février',
    3 => 'Mars',
    4 => 'Avril',
    5 => 'Mai',
    6 => 'Juin',
    7 => 'Juillet',
    8 => 'Août',
    9 => 'Septembre',
    10 => 'Octobre',
    11 => 'Novembre',
    12 => 'Décembre',
];

$mois = $moisEnFrancais[$moisEnCours];
$this->title = 'Vos frais forfaitisés du mois de ' . $mois ;

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<div class="fraisforfait-index">
    

    <h1><?= Html::encode($this->title) ?>
    
<?= Html::a('<i class="fas fa-print"></i>', '', ['class' => 'btn btn-primary', 'id' => 'print-button']) ?>
</h1>
    


    <p>
        <?= Html::a('Ajouter un frais forfaitisé', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div id="print-content">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            
            'idFraisForfait',
            'quantite',
            [
                'attribute' => 'Montant',
                'contentOptions' => ['class' => 'text-right'],
                'value' => function ($model) {
                    return $model->Montant;
                },
            ],
            'date',
            [
                'class' => ActionColumn::className(),
                'contentOptions' => ['style' => 'width: 6%;'],
                'urlCreator' => function ($action, Fraisforfait $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ID' => $model->ID]);
                 }
            ],
        ],
    ]); ?>

<?php
        // Calcul du total à rembourser
        $totalRembourser = $dataProvider->query->sum('Montant');
        ?>

            <div class="total-rembourser">
                <?php if ($totalRembourser == 0) : ?>
                    <h4>Total des frais forfaitisés : 0€</h4>
                <?php else : ?>
                    <h4>Total des frais forfaitisés : <?= $totalRembourser ?> €</h4>
                <?php endif; ?>
            </div>
    </div>
    



</div>

<script>
var originalContents = null; // Ajoutez cette variable en dehors de l'événement de clic

document.getElementById('print-button').addEventListener('click', function() {
    var printContents = document.getElementById('print-content').innerHTML;

    if (originalContents === null) {
        originalContents = document.body.innerHTML; // Enregistre le contenu original uniquement s'il n'est pas déjà enregistré
    }

    document.body.innerHTML = printContents;

    window.print();
});

// Ajoutez cet écouteur d'événement pour réinitialiser le contenu original lors de l'annulation de l'impression
window.addEventListener('afterprint', function() {
    if (originalContents !== null) {
        document.body.innerHTML = originalContents;
        originalContents = null; // Réinitialise la variable pour la prochaine impression
    }
});
</script>
