<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BillLottery;

/**
 * BillLotterySearch represents the model behind the search form of `backend\models\BillLottery`.
 */
class BillLotterySearch extends BillLottery
{
    public $idLottery;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idLottery'], 'integer'],
            [['name', 'idBuyLottery', 'createdAt'], 'safe'],
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
    public function search($params, $userId = null)
    {
        $query = BillLottery::find()->orderBy('id DESC');
        $idLottery = isset($params['BillLotterySearch']['idLottery']) ? $params['BillLotterySearch']['idLottery'] : null;
        if ($userId) {
            $query->where([BillLottery::tableName().'.userId' => $userId]);
        }
        if($idLottery) {
            $idLottery = $params['BillLotterySearch']['idLottery'];
            $query->innerJoinWith('buyLottery');
            $query->groupBy(BillLottery::tableName().'.id');
            $query->andFilterWhere([BuyLottery::tableName().'.lotteryId' => $idLottery]);
        }

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
            'createdAt' => $this->createdAt,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'idBuyLottery', $this->idBuyLottery]);

        return $dataProvider;
    }
}
