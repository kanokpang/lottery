<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 13/1/2561
 * Time: 12:44
 */
class m180113_124450_add_field_bill_lottery extends Migration
{
    const BILL_LOTTERY_TABLE_NAME = '{{%bill_lottery}}';
    const USER_TABLE_NAME = '{{%user}}';
    const FK_USER_BILL = 'userBillId';

    public function safeUp()
    {
        $this->addColumn(self::BILL_LOTTERY_TABLE_NAME, 'userId', $this->integer());
        $this->addForeignKey(self::FK_USER_BILL,
            self::BILL_LOTTERY_TABLE_NAME,
            'userId',
            self::USER_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::FK_USER_BILL, self::BILL_LOTTERY_TABLE_NAME);
        $this->dropColumn(self::BILL_LOTTERY_TABLE_NAME, 'userId');
    }
}