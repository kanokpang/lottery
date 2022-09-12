<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 31/3/2561
 * Time: 13:48
 */

class m180331_134850_add_field_total_and_created_at_in_transaction_bank extends Migration
{
    const TRANSACTION_BANK_TABLE_NAME = '{{%transaction_bank}}';

    public function safeUp()
    {
        $this->addColumn(self::TRANSACTION_BANK_TABLE_NAME,'total',$this->double());
        $this->addColumn(self::TRANSACTION_BANK_TABLE_NAME,'createdBy', $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn(self::TRANSACTION_BANK_TABLE_NAME,'total');
        $this->dropColumn(self::TRANSACTION_BANK_TABLE_NAME,'createdBy');
    }
}