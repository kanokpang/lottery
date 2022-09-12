<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: topte
 * Date: 6/30/2018
 * Time: 4:32 PM
 */

class m180630_163250_add_field_type_result_football_and_buy_football_table extends Migration
{
    const RESULT_FOOTBALL = '{{%result_football}}';
    const BUY_FOOTBALL = '{{%buy_football}}';

    public function safeUp()
    {
        $this->addColumn(self::RESULT_FOOTBALL, 'type', $this->integer()->comment('1 = hdp, 2 = over, 3 = HxA')->defaultValue(1));
        $this->addColumn(self::BUY_FOOTBALL, 'type', $this->integer()->comment('1 = hdp, 2 = over, 3 = HxA')->defaultValue(1));
    }

    public function safeDown()
    {
        $this->dropColumn(self::RESULT_FOOTBALL, 'type');
        $this->dropColumn(self::BUY_FOOTBALL, 'type');
    }
}