<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 17/12/2560
 * Time: 8:54
 */

use yii\db\Migration;

class m180217_190850_order_lottery extends Migration
{
    const ORDER_LOTTERY_TABLE_NAME = '{{%order_lottery}}';
    const PAYMENT_LOTTERY_TABLE_NAME = '{{%payment_lottery}}';
    const USER_TABLE_NAME = '{{%user}}';
    const FK_PAYMENT_ID = 'orderPaymentId';
    const FK_USER_ID = 'orderUserId';
    const TYPE_LOTTERY_ID = 'orderLottery_typeLotteryId';
    const TYPE_LOTTERY_TABLE_NAME = '{{%type_lottery}}';
    const ORDER_LOTTERY_ID = 'order_Lottery_lotteryId';
    const LOTTERY_TABLE_NAME = '{{%lottery_period}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::ORDER_LOTTERY_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'number' => $this->string()->notNull(),
            'moneyPlay' =>  $this->string()->notNull(),
            'moneyPay' => $this->float()->notNull(),
            'paymentId' => $this->integer()->notNull(),
            'userId' => $this->integer()->notNull(),
            'typeLotteryId' => $this->integer()->notNull(),
            'OrderlotteryId' => $this->integer()->notNull(),
            'isExistBuy' => $this->integer()->defaultValue(0),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
        $this->addForeignKey(
            self::TYPE_LOTTERY_ID,
            self::ORDER_LOTTERY_TABLE_NAME,
            'typeLotteryId',
            self::TYPE_LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            self::FK_PAYMENT_ID,
            self::ORDER_LOTTERY_TABLE_NAME,
            'paymentId',
            self::PAYMENT_LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            self::FK_USER_ID,
            self::ORDER_LOTTERY_TABLE_NAME,
            'userId',
            self::USER_TABLE_NAME,
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            self::ORDER_LOTTERY_ID,
            self::ORDER_LOTTERY_TABLE_NAME,
            'OrderlotteryId',
            self::LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::FK_PAYMENT_ID, self::ORDER_LOTTERY_TABLE_NAME);
        $this->dropForeignKey(self::FK_USER_ID, self::ORDER_LOTTERY_TABLE_NAME);
        $this->dropForeignKey(self::TYPE_LOTTERY_ID, self::ORDER_LOTTERY_TABLE_NAME);
        $this->dropForeignKey(self::ORDER_LOTTERY_ID,self::ORDER_LOTTERY_TABLE_NAME);
        $this->dropTable(self::ORDER_LOTTERY_TABLE_NAME);
    }
}