<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/26/2018
 * Time: 9:23 AM
 */

class m180526_092350_add_field_rate_buy_football extends Migration
{
    const BUY_FOOTBALL = '{{%buy_football}}';

    public function safeUp()
    {
        $this->addColumn(self::BUY_FOOTBALL, 'rate', $this->float());
    }

    public function safeDown()
    {
        $this->dropColumn(self::BUY_FOOTBALL,'rate');
    }
}