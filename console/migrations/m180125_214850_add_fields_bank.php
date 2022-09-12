<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 25/1/2561
 * Time: 21:48
 */

class m180125_214850_add_fields_bank extends Migration
{
    const BANK_TABLE_NAME = '{{%bank}}';

    public function safeUp()
    {
        $this->addColumn(self::BANK_TABLE_NAME,'code', $this->string());
        $this->addColumn(self::BANK_TABLE_NAME,'status', $this->integer()->defaultValue(1));
    }

    public function safeDown()
    {
        $this->dropColumn(self::BANK_TABLE_NAME,'code');
        $this->dropColumn(self::BANK_TABLE_NAME,'status');
    }
}