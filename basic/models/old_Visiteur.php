<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

/**
 * This is the model class for table "applifrais.visiteur".
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
 */
class Visiteur extends \yii\db\ActiveRecord 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'applifraisyii.visiteur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['dateEmbauche'], 'safe'],
            [['id'], 'string', 'max' => 4],
            [['nom', 'prenom', 'adresse', 'ville'], 'string', 'max' => 30],
            [['username', 'mdp'], 'string', 'max' => 20],
            [['cp'], 'string', 'max' => 5],
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
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'username' => 'username',
            'mdp' => 'Mdp',
            'adresse' => 'Adresse',
            'cp' => 'Cp',
            'ville' => 'Ville',
            'dateEmbauche' => 'Date Embauche',
            'idfkm' => 'idfkm',
            'user_type'=>'type',
        ];
    }
}
