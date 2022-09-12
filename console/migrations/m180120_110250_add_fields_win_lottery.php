<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 20/1/2561
 * Time: 11:03
 */

class m180120_110250_add_fields_win_lottery extends Migration
{
    const WIN_LOTTERY_TABLE_NAME = '{{%win_lottery}}';

    public function safeUp()
    {
        $this->addColumn(self::WIN_LOTTERY_TABLE_NAME,'answer', $this->integer()->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn(self::WIN_LOTTERY_TABLE_NAME,'answer');
    }
}