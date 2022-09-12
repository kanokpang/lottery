<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 3/3/2561
 * Time: 23:37
 */

class m180303_233750_add_filed_show_frontend_in_type_lottery extends Migration
{
    const TYPE_LOTTERY_TABLE_NAME = '{{%type_lottery}}';

    public function safeUp()
    {
        $this->addColumn(self::TYPE_LOTTERY_TABLE_NAME,'status', $this->integer()->defaultValue(1));
    }

    public function safeDown()
    {
        $this->dropColumn(self::TYPE_LOTTERY_TABLE_NAME,'status');
    }
}