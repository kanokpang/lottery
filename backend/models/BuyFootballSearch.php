<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BuyFootball;

/**
 * BuyFootballSearch represents the model behind the search form of `backend\models\BuyFootball`.
 */
class BuyFootballSearch extends BuyFootball
{
    public $leagueId;
    public $teamId;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'matchId', 'teamWinByMatchId', 'createdBy', 'isTrue', 'leagueId', 'teamId'], 'integer'],
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
        $query = BuyFootball::find()->joinWith(['match']);

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
            MatchFootball::tableName(). '.leagueId' => $this->leagueId,
            MatchFootball::tableName(). '.teamId1' => $this->teamId,
            'teamWinByMatchId' => $this->teamWinByMatchId,
            'createdBy' => $this->createdBy,
            'isTrue' => $this->isTrue,
            'createdAt' => $this->createdAt,
        ]);
        $query->orFilterWhere([MatchFootball::tableName(). '.teamId2' => $this->teamId]);
        return $dataProvider;
    }
}
