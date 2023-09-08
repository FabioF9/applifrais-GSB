<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Fichefrais;
use yii\data\ActiveDataProvider;

/**
 * FichefraisSearch represents the model behind the search form of `app\models\Fichefrais`.
 */
class FichefraisSearch extends Fichefrais
{
    /**
     * {@inheritdoc}
     */

    public $nomVisiteur;

    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['Date', 'idVisiteur', 'idEtat'], 'safe'],
            [['nomVisiteur'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Fichefrais::find();

        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('idVisiteur0'); // idVisiteur0 est la relation avec la table Visiteur
        $query->andFilterWhere(['like', 'visiteur.nom', $this->nomVisiteur]);

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'ID' => $this->ID,
        //     'Date' => $this->Date,
        // ]);

        // $query->andFilterWhere(['like', 'idVisiteur', $this->idVisiteur])
        //     ->andFilterWhere(['like', 'idEtat', $this->idEtat]);

        if (!empty($this->Date)) {
    $date = Yii::$app->formatter->asDate($this->Date, 'yyyy-MM');
    $firstDayOfMonth = $date . '-01';
    $lastDayOfMonth = date('Y-m-t', strtotime($firstDayOfMonth));

    $query->andFilterWhere(['between', 'Date', $firstDayOfMonth, $lastDayOfMonth]);
}

        if (!empty($this->idEtat)) {
            $query->andFilterWhere(['idEtat' => $this->idEtat]);
        }

        return $dataProvider;
    }
}
