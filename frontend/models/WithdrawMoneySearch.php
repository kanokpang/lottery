<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\WithdrawMoney;

/**
 * WithdrawMoneySearch represents the model behind the search form of `backend\models\WithdrawMoney`.
 */
class WithdrawMoneySearch extends WithdrawMoney
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'userId'], 'integer'],
            [['bankName', 'bankNumber', 'createdAt', 'updatedAt'], 'safe'],
            [['money'], 'number'],
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
        $query = WithdrawMoney::find()->where(['userId' => Yii::$app->user->id])->orderBy('id DESC');

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
            'money' => $this->money,
            'status' => $this->status,
            'userId' => $this->userId,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'bankName', $this->bankName])
            ->andFilterWhere(['like', 'bankNumber', $this->bankNumber]);

        return $dataProvider;
    }
}
