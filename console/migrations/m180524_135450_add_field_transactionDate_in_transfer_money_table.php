<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 6/9/2018
 * Time: 1:57 PM
 */

class m180524_135450_add_field_transactionDate_in_transfer_money_table extends Migration
{
    const TRANSFER_MONEY_TABLE_NAME = '{{%transfer_money}}';

    public function safeUp()
    {
        $this->addColumn(self::TRANSFER_MONEY_TABLE_NAME, 'transactionDate', $this->dateTime()->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn(self::TRANSFER_MONEY_TABLE_NAME, 'transactionDate');
    }
}