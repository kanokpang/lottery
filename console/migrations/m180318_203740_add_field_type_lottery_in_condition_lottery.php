<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 18/3/2561
 * Time: 20:37
 */

class m180318_203740_add_field_type_lottery_in_condition_lottery extends Migration
{
    const CONDITION_LOTTERY_TABLE_NAME = '{{%condition_lottery}}';
    const TYPE_LOTTERY_TABLE_NAME = '{{%type_lottery}}';

    public function safeUp()
    {
        $this->addColumn(self::CONDITION_LOTTERY_TABLE_NAME,'typeLotteryId', $this->integer()->notNull());
        $this->addForeignKey(
        '{{%typeLotteryId}}',
            self::CONDITION_LOTTERY_TABLE_NAME,
            'typeLotteryId',
            self::TYPE_LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%typeLotteryId}}', self::CONDITION_LOTTERY_TABLE_NAME);
        $this->dropColumn(self::CONDITION_LOTTERY_TABLE_NAME,'typeLotteryId');
    }
}