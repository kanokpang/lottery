<?php

namespace frontend\models;

use DateTime;
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
            [['id', 'leagueId', 'teamId1', 'teamId2', 'status', 'team'], 'integer'],
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
        if (isset($params['MatchFootball']['team'])) {
            if ($params['MatchFootball']['team']) {
                $query->andFilterWhere([
                    'teamId1' => $params['MatchFootball']['team'],
                ])->orWhere([
                    'teamId2' => $params['MatchFootball']['team'],
                ]);
            }
        }
        if (isset($params['MatchFootball']['leagueId'])) {
            if ($params['MatchFootball']['leagueId']) {
                $query->andFilterWhere([
                    'leagueId' => $params['MatchFootball']['leagueId'],
                ]);
            }
        }
        if (isset($params['MatchFootball']['startMatch'])) {
            $date = $params['MatchFootball']['startMatch'];
            if ($date) {
                $date = new DateTime($date);
                $startDate = $date->setTime(0, 0, 0)->format('Y-m-d H:i:s');
                $endDate = $date->setTime(23, 59, 59)->format('Y-m-d H:i:s');
                $query->andFilterWhere([
                    'between', 'startMatch', $startDate, $endDate
                ]);
            }
        } else {
            $currentDate = date("Y-m-d");
            $date = new DateTime($currentDate);
            $startDate = $date->setTime(0, 0, 0)->format('Y-m-d H:i:s');
            $endDate = $date->setTime(23, 59, 59)->format('Y-m-d H:i:s');
            $query->andFilterWhere([
                'between', 'startMatch', $startDate, $endDate
            ]);
        }

        $query->andFilterWhere(['like', 'scoreTeam1', $this->scoreTeam1])
            ->andFilterWhere(['like', 'scoreTeam2', $this->scoreTeam2])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }
}
