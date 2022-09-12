<?php

use yii\db\Migration;

class m171211_100040_payment_lottery extends Migration
{
    const PAYMENT_LOTTERY_TABLE_NAME = '{{%payment_lottery}}';
    const TYPE_LOTTERY_TABLE_NAME = '{{%type_lottery}}';
    const LOTTERY_TABLE_NAME = '{{%lottery_period}}';
    const FK_LOTTERY_ID = 'lotteryId';
    const FK_TYPE_LOTTERY_ID = 'typeLotteryId';
    const FK_PROMOTION_LOTTERY_ID = 'promotionLotteryId';
    const PROMOTION_LOTTERY_TABLE_NAME = '{{%promotion_lottery}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::PAYMENT_LOTTERY_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'typeLotteryId' => $this->integer()->notNull(),
            'lotteryId' => $this->integer()->notNull(),
            'promotionLotteryId' => $this->integer()->notNull(),
            'payment' => $this->string()->notNull(),
            'discount' => $this->string()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->addForeignKey(
            self::FK_LOTTERY_ID,
            self::PAYMENT_LOTTERY_TABLE_NAME,
            'lotteryId',
            self::LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            self::FK_TYPE_LOTTERY_ID,
            self::PAYMENT_LOTTERY_TABLE_NAME,
            'typeLotteryId',
            self::TYPE_LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            self::FK_PROMOTION_LOTTERY_ID,
            self::PAYMENT_LOTTERY_TABLE_NAME,
            'promotionLotteryId',
            self::PROMOTION_LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(self::FK_LOTTERY_ID, self::PAYMENT_LOTTERY_TABLE_NAME);
        $this->dropForeignKey(self::FK_TYPE_LOTTERY_ID, self::PAYMENT_LOTTERY_TABLE_NAME);
        $this->dropForeignKey(self::FK_PROMOTION_LOTTERY_ID, self::PAYMENT_LOTTERY_TABLE_NAME);
        $this->dropTable(self::PAYMENT_LOTTERY_TABLE_NAME);
    }
}
