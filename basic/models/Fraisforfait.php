<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\web\JsExpression;

/**
 * This is the model class for table "fraisforfait".
 *
 * @property int $ID
 * @property string $idVisiteur
 * @property string $date
 * @property string $idFraisForfait
 * @property int $quantite
 *
 * @property Baremeforfait $idFraisForfait0
 * @property Visiteur $idVisiteur0
 */
class Fraisforfait extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fraisforfait';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idVisiteur', 'date', 'idFraisForfait', 'quantite'], 'required'],
            [['date'], 'safe'],
            [['quantite'], 'integer'],
            [['Montant'], 'number'],
            [['idVisiteur'], 'string', 'max' => 4],
            [['idFraisForfait'], 'string', 'max' => 3],
            [['idFraisForfait'], 'checkDouble'],
            [['date'], 'checkDouble'],
            [['date'], 'validateLastDayOfMonth'],
            [['idFraisForfait'], 'exist', 'skipOnError' => true, 'targetClass' => Baremeforfait::class, 'targetAttribute' => ['idFraisForfait' => 'id']],
            [['idVisiteur'], 'exist', 'skipOnError' => true, 'targetClass' => Visiteur::class, 'targetAttribute' => ['idVisiteur' => 'id']],
        ];
    }

    
    public function checkDouble($attribute, $params)
    {

        if (!$this->isNewRecord) {
            // Si c'est une mise à jour, ignorer la vérification des doublons
            return;
        }
        $existing = Fraisforfait::findOne([
            'idFraisForfait' => $this->idFraisForfait,
            'date' => $this->date,
            'idVisiteur' => $this->idVisiteur,
        ]);

        if ($existing !== null) {
            $this->addError($attribute, 'Un frais de ce type existe déjà.');
            $session = Yii::$app->session;
            $session->setFlash('message', 'Vous avez été redirigé sur la page de modification car un frais de ce type existe déjà.');
            $editUrl = Url::to(['update', 'ID' => $existing->ID]);
            Yii::$app->getResponse()->redirect($editUrl);
            
        }
    }

    public function validateLastDayOfMonth($attribute, $params)
    {
        $lastDayOfMonth = date('Y-m-t');
        $inputDate = strtotime($this->$attribute);
        $lastDayOfMonth = strtotime($lastDayOfMonth);

        if ($inputDate >= $lastDayOfMonth) {
            $this->addError($attribute, 'La saisie de frais n\'est pas autorisée le dernier jour du mois.');
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'idVisiteur' => 'Id Visiteur',
            'date' => 'Date',
            'idFraisForfait' => 'Type',
            'quantite' => 'Quantité',
            'Montant' => 'Total TTC (en €)',
        ];
    }

    
    /**
     * Gets query for [[IdFraisForfait0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdFraisForfait0()
    {
        return $this->hasOne(Baremeforfait::class, ['id' => 'idFraisForfait']);
    }

    public function getBaremeforfait()
{
    return $this->hasOne(Baremeforfait::class, ['id' => 'idFraisForfait']);
}

    /**
     * Gets query for [[IdVisiteur0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdVisiteur0()
    {
        return $this->hasOne(Visiteur::class, ['id' => 'idVisiteur']);
    }
}
