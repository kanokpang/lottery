<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TransactionBank;

/**
 * TransactionBankSearch represents the model behind the search form of `backend\models\TransactionBank`.
 */
class TransactionBankSearch extends TransactionBank
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'userId', 'createdAt'], 'integer'],
            [['bankName', 'bankNumber'], 'safe'],
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
        $query = TransactionBank::find()->where(['userId' => Yii::$app->user->id])->orderBy('id DESC');

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
        ]);

        $query->andFilterWhere(['like', 'bankName', $this->bankName])
            ->andFilterWhere(['like', 'bankNumber', $this->bankNumber]);

        return $dataProvider;
    }
}
