<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 18/1/2561
 * Time: 22:05
 */

class m180118_220550_add_fields_bank_owner_table extends Migration
{
    const BANK_OWNER_TABLE = '{{%bank_owner}}';

    public function safeUp()
    {
        $this->addColumn(self::BANK_OWNER_TABLE, 'accountName',$this->string()->notNull());
        $this->addColumn(self::BANK_OWNER_TABLE,'status',$this->integer()->defaultValue(1));
    }

    public function safeDown()
    {
        $this->dropColumn(self::BANK_OWNER_TABLE,'accountName');
        $this->dropColumn(self::BANK_OWNER_TABLE,'status');
    }
}