<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BuyLottery;

/**
 * BuyLotterySearch represents the model behind the search form of `backend\models\BuyLottery`.
 */
class BuyLotterySearch extends BuyLottery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'paymentId'], 'integer'],
            [['number', 'moneyPlay', 'moneyPay', 'createdAt', 'updatedAt', 'lotteryId'], 'safe'],
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
        $query = BuyLottery::find()->where(['userId' => Yii::$app->user->id])->orderBy('id DESC');

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
            'paymentId' => $this->paymentId,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'lotteryId' => $this->lotteryId,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'moneyPlay', $this->moneyPlay])
            ->andFilterWhere(['like', 'moneyPay', $this->moneyPay]);

        return $dataProvider;
    }
}
