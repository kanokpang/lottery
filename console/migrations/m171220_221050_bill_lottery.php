<?php

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 20/12/2560
 * Time: 22:09
 */

use yii\db\Migration;

class m171220_221050_bill_lottery extends Migration
{
    const BILL_LOTTERY_TABLE_NAME = '{{%bill_lottery}}';

    public function up()
    {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable(self::BILL_LOTTERY_TABLE_NAME, [
        'id' => $this->primaryKey(),
        'name' => $this->string()->notNull(),
        'idBuyLottery' => $this->string()->notNull(),
        'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
    ], $tableOptions);
}

    public function safeDown()
    {
        $this->dropTable(self::BILL_LOTTERY_TABLE_NAME);
    }
}