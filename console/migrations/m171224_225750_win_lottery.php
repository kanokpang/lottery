<?php

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 24/12/2560
 * Time: 22:57
 */

use yii\db\Migration;

class m171224_225750_win_lottery extends Migration
{
    const WIN_LOTTERY_TABLE_NAME = '{{%win_lottery}}';
    const TYPE_LOTTERY_TABLE_NAME = '{{%type_lottery}}';
    const LOTTERY_TABLE_NAME = '{{%lottery_period}}';
    const FK_LOTTERY_ID = 'win_lotteryId';
    const FK_TYPE_LOTTERY_ID = 'win_typeLotteryId';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::WIN_LOTTERY_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'lotteryId' => $this->integer()->notNull(),
            'typeLotteryId' => $this->integer()->notNull(),
            'number' => $this->string()->notNull(),
            'createdBy' => $this->integer()->notNull(),
            'updatedBy' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->addForeignKey(
            self::FK_LOTTERY_ID,
            self::WIN_LOTTERY_TABLE_NAME,
            'lotteryId',
            self::LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            self::FK_TYPE_LOTTERY_ID,
            self::WIN_LOTTERY_TABLE_NAME,
            'typeLotteryId',
            self::TYPE_LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::FK_LOTTERY_ID, self::WIN_LOTTERY_TABLE_NAME);
        $this->dropForeignKey(self::FK_TYPE_LOTTERY_ID, self::WIN_LOTTERY_TABLE_NAME);
        $this->dropTable(self::WIN_LOTTERY_TABLE_NAME);
    }
}