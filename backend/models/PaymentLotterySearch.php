<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PaymentLottery;

/**
 * PaymentLotterySearch represents the model behind the search form of `backend\models\PaymentLottery`.
 */
class PaymentLotterySearch extends PaymentLottery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'typeLotteryId', 'lotteryId', 'promotionLotteryId'], 'integer'],
            [['payment', 'discount', 'createdAt', 'updatedAt'], 'safe'],
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
        $query = PaymentLottery::find()->orderBy('id DESC');

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
            'typeLotteryId' => $this->typeLotteryId,
            'promotionLotteryId' => $this->promotionLotteryId,
            'lotteryId' => $this->lotteryId,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'payment', $this->payment])
            ->andFilterWhere(['like', 'discount', $this->discount]);

        return $dataProvider;
    }
}
