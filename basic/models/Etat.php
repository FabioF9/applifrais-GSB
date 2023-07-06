<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "etat".
 *
 * @property string $id
 * @property string|null $libelle
 *
 * @property Fichefrais[] $fichefrais
 */
class Etat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'etat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string', 'max' => 2],
            [['libelle'], 'string', 'max' => 30],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'libelle' => 'Libelle',
        ];
    }

    /**
     * Gets query for [[Fichefrais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFichefrais()
    {
        return $this->hasMany(Fichefrais::class, ['idEtat' => 'id']);
    }
}
