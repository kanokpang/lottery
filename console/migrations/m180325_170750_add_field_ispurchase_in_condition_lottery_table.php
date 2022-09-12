<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 25/3/2561
 * Time: 17:10
 */

class m180325_170750_add_field_ispurchase_in_condition_lottery_table extends Migration
{
    const CONDITION_LOTTERY_TABLE_NAME = '{{%condition_lottery}}';

    public function safeUp()
    {
        $this->addColumn(self::CONDITION_LOTTERY_TABLE_NAME,'isPurchaseLimit',$this->integer()->defaultValue(1));
    }

    public function safeDown()
    {
        $this->dropColumn(self::CONDITION_LOTTERY_TABLE_NAME,'isPurchaseLimit');
    }
}