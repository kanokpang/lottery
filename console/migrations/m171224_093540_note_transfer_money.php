<?php

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 24/12/2560
 * Time: 9:39
 */

use yii\db\Migration;

class m171224_093540_note_transfer_money extends Migration
{
    const NOTE_TRANSFER_MONEY = '{{%note_transfer_money}}';
    const TRANSFER_MONEY = '{{%transfer_money}}';
    const FK_ID_TRANSFER_MONEY = 'idTransferMoney';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::NOTE_TRANSFER_MONEY, [
            'id' => $this->primaryKey(),
            'note' => $this->text()->notNull(),
            'photos' => $this->text(),
            'idTransferMoney' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updateAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
        $this->addForeignKey(
            self::FK_ID_TRANSFER_MONEY,
            self::NOTE_TRANSFER_MONEY,
            'idTransferMoney',
            self::TRANSFER_MONEY,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::FK_ID_TRANSFER_MONEY, self::NOTE_TRANSFER_MONEY);
        $this->dropTable(self::NOTE_TRANSFER_MONEY);
    }
}