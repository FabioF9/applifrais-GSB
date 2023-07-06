<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fichefrais".
 *
 * @property int $ID
 * @property string $Date
 * @property string $idVisiteur
 * @property string|null $idEtat
 *
 * @property Etat $idEtat0
 * @property Visiteur $idVisiteur0
 */
class Fichefrais extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fichefrais';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Date', 'idVisiteur'], 'required'],
            [['Date'], 'safe'],
            [['idVisiteur'], 'string', 'max' => 4],
            [['idEtat'], 'string', 'max' => 2],
            [['idVisiteur'], 'exist', 'skipOnError' => true, 'targetClass' => Visiteur::class, 'targetAttribute' => ['idVisiteur' => 'id']],
            [['idEtat'], 'exist', 'skipOnError' => true, 'targetClass' => Etat::class, 'targetAttribute' => ['idEtat' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Date' => 'Date',
            'idVisiteur' => 'Nom',
            'idEtat' => 'Etat',
        ];
    }

    /**
     * Gets query for [[IdEtat0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEtat0()
    {
        return $this->hasOne(Etat::class, ['id' => 'idEtat']);
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
