<?php

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 17/12/2560
 * Time: 21:09
 */

use yii\db\Migration;

class m171217_211020_transfer_money extends Migration
{
    const TRANSFER_MONEY_TABLE_NAME = '{{%transfer_money}}';
    const BANK_OWNER_TABLE_NAME = '{{%bank_owner}}';
    const USER_TABLE_NAME = '{{%user}}';
    const FK_BANK_OWNER_ID = 'bankOwnerId';
    const FK_USER_ID = 'transfer_userId';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TRANSFER_MONEY_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'bankOwnerId' => $this->integer()->notNull(),
            'money' => $this->float()->notNull(),
            'status' => $this->integer()->notNull(),
            'userId' => $this->integer()->notNull(),
            'updatedBy' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
        $this->addForeignKey(
            self::FK_BANK_OWNER_ID,
            self::TRANSFER_MONEY_TABLE_NAME,
            'bankOwnerId',
            self::BANK_OWNER_TABLE_NAME,
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            self::FK_USER_ID,
            self::TRANSFER_MONEY_TABLE_NAME,
            'userId',
            self::USER_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::FK_BANK_OWNER_ID, self::TRANSFER_MONEY_TABLE_NAME);
        $this->dropForeignKey(self::FK_USER_ID, self::TRANSFER_MONEY_TABLE_NAME);
        $this->dropTable(self::TRANSFER_MONEY_TABLE_NAME);
    }
}