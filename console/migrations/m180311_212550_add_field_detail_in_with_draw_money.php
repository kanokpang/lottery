<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 11/3/2561
 * Time: 21:25
 */

class m180311_212550_add_field_detail_in_with_draw_money extends Migration
{
    const WITH_DRAW_MONEY_TABLE_NAME = '{{%withdraw_money}}';

    public function safeUp()
    {
        $this->addColumn(self::WITH_DRAW_MONEY_TABLE_NAME,'detail', $this->text());
        $this->addColumn(self::WITH_DRAW_MONEY_TABLE_NAME,'createdBy', $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn(self::WITH_DRAW_MONEY_TABLE_NAME,'detail');
        $this->dropColumn(self::WITH_DRAW_MONEY_TABLE_NAME,'createdBy', $this->integer());
    }
}