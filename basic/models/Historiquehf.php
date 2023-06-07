<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "horsforfait".
 *
 * @property int $ID
 * @property string $idVisiteur
 * @property string $date
 * @property string $Libellé
 * @property int $Montant
 * @property string $Justificatif
 *
 * @property Visiteur $idVisiteur0
 */
class Historiquehf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horsforfait';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idVisiteur', 'date', 'Libellé', 'Montant', 'Justificatif'], 'required'],
            [['date'], 'safe'],
            [['Libellé', 'Justificatif'], 'string'],
            [['Montant'], 'integer'],
            [['idVisiteur'], 'string', 'max' => 4],
            [['idVisiteur'], 'exist', 'skipOnError' => true, 'targetClass' => Visiteur::class, 'targetAttribute' => ['idVisiteur' => 'id']],
        ];
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
            'Libellé' => 'Libellé',
            'Montant' => 'Montant (en €)',
            'Justificatif' => 'Justificatif',
        ];
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
