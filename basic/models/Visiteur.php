<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visiteur".
 *
 * @property string $id
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $username
 * @property string|null $mdp
 * @property string|null $adresse
 * @property string|null $cp
 * @property string|null $ville
 * @property string|null $dateEmbauche
 * @property int|null $idfkm
 * @property string|null $user_type
 *
 * @property Cartegrise[] $cartegrises
 * @property Fichefrais[] $fichefrais
 * @property Fraisforfait[] $fraisforfaits
 * @property Horsforfait[] $horsforfaits
 * @property Fraiskilometrique $idfkm0
 */
class Visiteur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visiteur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['mdp'], 'string'],
            [['dateEmbauche'], 'safe'],
            [['idfkm'], 'integer'],
            [['id'], 'string', 'max' => 4],
            [['nom', 'prenom', 'adresse', 'ville'], 'string', 'max' => 30],
            [['username'], 'string', 'max' => 20],
            [['cp'], 'string', 'max' => 5],
            [['user_type'], 'string', 'max' => 1],
            [['id'], 'unique'],
            [['idfkm'], 'exist', 'skipOnError' => true, 'targetClass' => Fraiskilometrique::class, 'targetAttribute' => ['idfkm' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'username' => 'Username',
            'mdp' => 'Mdp',
            'adresse' => 'Adresse',
            'cp' => 'Cp',
            'ville' => 'Ville',
            'dateEmbauche' => 'Date Embauche',
            'idfkm' => 'Nombre de CV',
            'user_type' => 'User Type',
        ];
    }

    /**
     * Gets query for [[Cartegrises]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartegrises()
    {
        return $this->hasMany(Cartegrise::class, ['idVisiteur' => 'id']);
    }

    /**
     * Gets query for [[Fichefrais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFichefrais()
    {
        return $this->hasMany(Fichefrais::class, ['idVisiteur' => 'id']);
    }

    /**
     * Gets query for [[Fraisforfaits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFraisforfaits()
    {
        return $this->hasMany(Fraisforfait::class, ['idVisiteur' => 'id']);
    }

    /**
     * Gets query for [[Horsforfaits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHorsforfaits()
    {
        return $this->hasMany(Horsforfait::class, ['idVisiteur' => 'id']);
    }

    /**
     * Gets query for [[Idfkm0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdfkm0()
    {
        return $this->hasOne(Fraiskilometrique::class, ['ID' => 'idfkm']);
    }
}
