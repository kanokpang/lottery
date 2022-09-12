<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ResultFootball;

/**
 * ResultFootballSearch represents the model behind the search form of `backend\models\ResultFootball`.
 */
class ResultFootballSearch extends ResultFootball
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'matchId', 'teamWinByMatchId', 'createdBy', 'type', 'isFullTime'], 'integer'],
            [['createdAt'], 'safe'],
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
        $query = ResultFootball::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'matchId' => $this->matchId,
            'teamWinByMatchId' => $this->teamWinByMatchId,
            'createdBy' => $this->createdBy,
            'createdAt' => $this->createdAt,
            'type' => $this->type,
            'isFullTime' => $this->isFullTime,
        ]);

        return $dataProvider;
    }
}
