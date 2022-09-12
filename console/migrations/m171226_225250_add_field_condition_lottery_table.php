<?php

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 8/1/2561
 * Time: 22:53
 */

use yii\db\Migration;

class m171226_225250_add_field_condition_lottery_table extends Migration
{
    const CONDITION_LOTTERY_TABLE_NAME = '{{%condition_lottery}}';
    const LOTTERY_TABLE_NAME = '{{%lottery_period}}';
    const LOTTERY_ID = 'lotteryConditionId';

    public function safeUp()
    {
        $this->addColumn(self::CONDITION_LOTTERY_TABLE_NAME, 'lotteryId', $this->integer());
        $this->addForeignKey(
            self::LOTTERY_ID,
            self::CONDITION_LOTTERY_TABLE_NAME,
            'lotteryId',
            self::LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::LOTTERY_ID, self::CONDITION_LOTTERY_TABLE_NAME);
        $this->dropColumn(self::CONDITION_LOTTERY_TABLE_NAME, 'lotteryId');
    }
}
