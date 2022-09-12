<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lol_win_lottery".
 *
 * @property int $id
 * @property int $lotteryId
 * @property int $typeLotteryId
 * @property string $number
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdAt
 * @property string $updatedAt
 * @property int $answer
 *
 * @property Lottery $lottery
 * @property TypeLottery $typeLottery
 */
class WinLottery extends ActiveRecord
{
    const NAME_TREE_DIGIT_BOTTOM = '3 ตัวล่าง';
    const NAME_TWO_DIGIT_BOTTOM = '2 ตัวล่าง';
    const NAME_DIGIT_TREE_ON = '3 ตัวบน';
    const NAME_DIGIT_TWO_ON = '2 ตัวบน';
    const NAME_DIGIT_TREE_ON_TODS = '3 ตัวบนโต๊ด';
    const NAME_DIGIT_TREE_BUTTOM_TODS = '3 ตัวล่างโต๊ด';
    public $treeDigitTod;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%win_lottery}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'createdBy',
                'updatedByAttribute' => 'updatedBy',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lotteryId', 'typeLotteryId', 'number'], 'required'],
            ['number', 'string', 'length' => [6, 6], 'on' => 'create-lottery'],
            [['lotteryId', 'typeLotteryId', 'number'], 'unique',
                'targetAttribute' => ['lotteryId', 'typeLotteryId', 'number'], 'message' => Yii::t('app', 'The combination of Type Lotter, Lottery and Promotion Lottery has already been taken.')],
            [['lotteryId', 'typeLotteryId', 'createdBy', 'updatedBy', 'answer'], 'integer'],
            [['createdAt', 'updatedAt', 'treeDigitTod'], 'safe'],
            [['typeLotteryId'], 'validateMaxCount'],
            [['lotteryId'], 'validateGenerateLotteryTods', 'on' => 'create-lottery'],
            [['treeDigitTod'], 'validateCompareTod'],
            [['number'], 'string', 'max' => 255],
            ['typeLotteryId', 'validateTypeLottery'],
            [['lotteryId'], 'exist', 'skipOnError' => true, 'targetClass' => Lottery::className(), 'targetAttribute' => ['lotteryId' => 'id']],
            [['typeLotteryId'], 'exist', 'skipOnError' => true, 'targetClass' => TypeLottery::className(), 'targetAttribute' => ['typeLotteryId' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenario = parent::scenarios();
        $scenario['create-lottery'] = ['number', 'lotteryId'];
        return $scenario;
    }

    public function validateCompareTod()
    {
        $nameTypeLottery = $this->typeLottery->name;
        if ($this->treeDigitTod && $nameTypeLottery !== self::NAME_DIGIT_TREE_BUTTOM_TODS) {
            $this->addError('treeDigitTod', Yii::t('app', 'Tree Digit Tod Invalid'));
        }
    }

    public function validateMaxCount()
    {
        $count = WinLottery::find()->where(['lotteryId' => $this->lotteryId, 'typeLotteryId' => $this->typeLotteryId])->count();
        if (($this->typeLottery->name === self::NAME_DIGIT_TREE_ON || $this->typeLottery->name === self::NAME_DIGIT_TWO_ON
                || $this->typeLottery->name === self::NAME_TREE_DIGIT_BOTTOM ||
                $this->typeLottery->name === self::NAME_TWO_DIGIT_BOTTOM) && intval($count) >= 1) {
            $this->addError('typeLotteryId', Yii::t('app', 'Lottery Max Answer Because Type Lottery Max {0}', $count));
        } elseif ($this->typeLottery->name === self::NAME_DIGIT_TREE_ON_TODS || $this->typeLottery->name === self::NAME_DIGIT_TREE_BUTTOM_TODS && $count > 6) {
            $this->addError('typeLotteryId', Yii::t('app', 'Lottery Max Answer Because Type Lottery Max {0}', $count));
        }
    }

    public function validateGenerateLotteryTods()
    {
        $count = WinLottery::find()->joinWith('typeLottery')->where(['name' => self::NAME_DIGIT_TREE_ON, 'lotteryId' => $this->lotteryId])->count();
        if ($count) {
            $this->addError('lotteryId', Yii::t('app', 'Cannot Create Answer Lottery Because Lottery Exist'));
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lotteryId' => Yii::t('app', 'Lottery Name'),
            'typeLotteryId' => Yii::t('app', 'Type Lottery Name'),
            'number' => Yii::t('app', 'Number'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    public function validateTypeLottery()
    {
        $typeLotteryName = $this->typeLottery->name;
        $numberTypeLottery = intval($typeLotteryName);
        if ($numberTypeLottery) {
            if ($numberTypeLottery !== strlen($this->number)) {
                $this->addError('number', 'Incorrect length number.');
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLottery()
    {
        return $this->hasOne(Lottery::className(), ['id' => 'lotteryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeLottery()
    {
        return $this->hasOne(TypeLottery::className(), ['id' => 'typeLotteryId']);
    }
}
