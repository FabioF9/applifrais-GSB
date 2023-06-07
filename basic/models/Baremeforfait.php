<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "baremeforfait".
 *
 * @property string $id
 * @property string|null $libelle
 * @property float|null $montant
 *
 * @property Fraisforfait[] $fraisforfaits
 */
class Baremeforfait extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'baremeforfait';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['montant'], 'number'],
            [['id'], 'string', 'max' => 3],
            [['libelle'], 'string', 'max' => 20],
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
            'montant' => 'Montant',
        ];
    }

    /**
     * Gets query for [[Fraisforfaits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFraisforfaits()
    {
        return $this->hasMany(Fraisforfait::class, ['idFraisForfait' => 'id']);
    }
}
