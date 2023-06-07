<?php

namespace app\models;

use Yii;
use yii\validators\DateValidator;

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
class Horsforfait extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $file;

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
            [['idVisiteur', 'date', 'Libellé', 'Montant'], 'required'],
            [['date'], 'safe'],
            [['file'], 'file', 'skipOnEmpty' => true],
            [['Libellé', 'Justificatif'], 'string'],
            [['Montant'], 'integer', 'min' => 0],
            [['idVisiteur'], 'string', 'max' => 4],
            [['idVisiteur'], 'exist', 'skipOnError' => true, 'targetClass' => Visiteur::class, 'targetAttribute' => ['idVisiteur' => 'id']],
            [['date'], DateValidator::class, 'format' => 'php:Y-m-d', 'max' => date('Y-m-d'), 'tooBig' => 'Vous ne pouvez pas rentrer de date postérieure.'],
        ];
    }

    public function hasJustificatif()
    {
        return !empty($this->Justificatif);
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
            // 'Justificatif' => 'Justificatif',
            'file' => 'Justificatif',
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
