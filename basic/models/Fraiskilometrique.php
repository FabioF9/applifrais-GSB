<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fraiskilometrique".
 *
 * @property int $ID
 * @property int $CV
 * @property float $Coeff
 *
 * @property Visiteur[] $visiteurs
 */
class Fraiskilometrique extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fraiskilometrique';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CV', 'Coeff'], 'required'],
            [['CV'], 'integer'],
            [['Coeff'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CV' => 'Cv',
            'Coeff' => 'Coeff',
        ];
    }

    /**
     * Gets query for [[Visiteurs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVisiteurs()
    {
        return $this->hasMany(Visiteur::class, ['idfkm' => 'ID']);
    }

    public static function getCoefficient()
{
    return static::findOne(['Coeff' => 'KM'])->Coeff;
}
}
