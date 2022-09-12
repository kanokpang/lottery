<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 22/1/2561
 * Time: 23:28
 */

class m180122_232820_add_field_code_bank_owner extends Migration
{
    const BANk_TABLE_NAME = '{{%bank_owner}}';

    public function safeUp()
    {
        $this->addColumn(self::BANk_TABLE_NAME,'code',$this->string());
    }

    public function safeDown()
    {
        $this->dropColumn(self::BANk_TABLE_NAME, 'code');
    }
}