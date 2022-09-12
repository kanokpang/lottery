<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MatchFootball;

/**
 * MatchFootballSearch represents the model behind the search form of `backend\models\MatchFootball`.
 */
class MatchFootballSearch extends MatchFootball
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'leagueId', 'teamId1', 'teamId2', 'status'], 'integer'],
            [['scoreTeam1', 'scoreTeam2', 'detail', 'startMatch', 'endMatch', 'createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = MatchFootball::find();

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
            'leagueId' => $this->leagueId,
            'teamId1' => $this->teamId1,
            'teamId2' => $this->teamId2,
            'status' => $this->status,
            'startMatch' => $this->startMatch,
            'endMatch' => $this->endMatch,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'scoreTeam1', $this->scoreTeam1])
            ->andFilterWhere(['like', 'scoreTeam2', $this->scoreTeam2])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }
}
