<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: topte
 * Date: 7/21/2018
 * Time: 9:51 AM
 */

class m180721_095050_add_filed_is_fulltime_in_buy_football_and_result_football extends Migration
{
    const RESULT_FOOTBALL = '{{%result_football}}';
    const BUY_FOOTBALL = '{{%buy_football}}';

    public function safeUp()
    {
        $this->addColumn(self::BUY_FOOTBALL, 'isFullTime', $this->integer());
        $this->addColumn(self::RESULT_FOOTBALL, 'isFullTime', $this->integer());
        $this->addColumn(self::RESULT_FOOTBALL, 'isAnswer', $this->integer()->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn(self::BUY_FOOTBALL, 'isFullTime');
        $this->dropColumn(self::RESULT_FOOTBALL, 'isFullTime');
        $this->dropColumn(self::RESULT_FOOTBALL, 'isAnswer');
    }
}