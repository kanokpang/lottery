<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 26/1/2561
 * Time: 0:06
 */

class m180126_000650_add_fields_user extends Migration
{
    const USER_TABLE_NAME = '{{%user}}';

    public function safeUp()
    {
        $this->addColumn(self::USER_TABLE_NAME, 'note',$this->text());
    }

    public function safeDown()
    {
        $this->dropColumn(self::USER_TABLE_NAME,'note');
    }
}