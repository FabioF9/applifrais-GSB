<?php

namespace app\models;

use Yii;

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
class Historiqueff extends \yii\db\ActiveRecord
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
            [['idFraisForfait'], 'exist', 'skipOnError' => true, 'targetClass' => Baremeforfait::class, 'targetAttribute' => ['idFraisForfait' => 'id']],
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
