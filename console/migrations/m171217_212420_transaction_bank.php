<?php

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 17/12/2560
 * Time: 21:24
 */

use yii\db\Migration;

class m171217_212420_transaction_bank extends Migration
{
    const TRANSACTION_BANK_TABLE_NAME = '{{%transaction_bank}}';
    const USER_TABLE_NAME = '{{%user}}';
    const FK_USER_ID = 'transaction_userId';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TRANSACTION_BANK_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'bankName' => $this->string()->notNull(),
            'bankNumber' => $this->string()->notNull(),
            'money' => $this->float()->notNull(),
            'status' => $this->integer()->notNull(),
            'userId' => $this->integer()->notNull(),
            'triggerId' => $this->integer()->notNull(),
            'triggerName' => $this->string()->notNull(),
            'createdAt' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey(
            self::FK_USER_ID,
            self::TRANSACTION_BANK_TABLE_NAME,
            'userId',
            self::USER_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::FK_USER_ID, self::TRANSACTION_BANK_TABLE_NAME);
        $this->dropTable(self::TRANSACTION_BANK_TABLE_NAME);
    }
}