<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 20/1/2561
 * Time: 10:57
 */
class m180120_110350_add_fields_buy_lottery extends Migration
{
    const BUY_LOTTERY_TABLE_NAME = '{{%buy_lottery}}';
    const TYPE_LOTTERY_ID = 'buyLottery_typeLotteryId';
    const TYPE_LOTTERY_TABLE_NAME = '{{%type_lottery}}';
    const LOTTERY_ID = 'buyLottery_lotteryId';
    const LOTTERY_TABLE_NAME = '{{%lottery_period}}';

    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableSchema(self::BUY_LOTTERY_TABLE_NAME);
        if ($tables->getColumn('typeName')) {
            $this->dropColumn(self::BUY_LOTTERY_TABLE_NAME,'typeName');
        }
        $this->addColumn(self::BUY_LOTTERY_TABLE_NAME, 'isTrue', $this->integer()->defaultValue(0));
        $this->addColumn(self::BUY_LOTTERY_TABLE_NAME, 'typeLotteryId', $this->integer()->notNull());
        $this->addForeignKey(
            self::TYPE_LOTTERY_ID,
            self::BUY_LOTTERY_TABLE_NAME,
            'typeLotteryId',
            self::TYPE_LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );
        $this->addColumn(self::BUY_LOTTERY_TABLE_NAME, 'lotteryId', $this->integer()->notNull());
        $this->addForeignKey(
            self::LOTTERY_ID,
            self::BUY_LOTTERY_TABLE_NAME,
            'lotteryId',
            self::LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::TYPE_LOTTERY_ID, self::BUY_LOTTERY_TABLE_NAME);
        $this->dropColumn(self::BUY_LOTTERY_TABLE_NAME, 'isTrue');
        $this->dropColumn(self::BUY_LOTTERY_TABLE_NAME,'typeLotteryId');
        $this->dropForeignKey(self::LOTTERY_ID,self::BUY_LOTTERY_TABLE_NAME);
        $this->dropColumn(self::BUY_LOTTERY_TABLE_NAME,'lotteryId');
    }
}