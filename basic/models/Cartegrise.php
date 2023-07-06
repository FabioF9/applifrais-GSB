<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cartegrise".
 *
 * @property int $ID
 * @property string|null $Chemin
 * @property string $idVisiteur
 *
 * @property Visiteur $idVisiteur0
 */
class Cartegrise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cartegrise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Chemin'], 'string'],
            [['Chemin'], 'file', 'extensions' => ['png', 'jpeg', 'jpg', 'pdf']],
            [['idVisiteur'], 'required'],
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
            'Chemin' => 'Chemin',
            'idVisiteur' => 'Id Visiteur',
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
