<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 17/12/2560
 * Time: 8:54
 */

use yii\db\Migration;

class m171217_085450_buy_lottery extends Migration
{
    const BUY_LOTTERY_TABLE_NAME = '{{%buy_lottery}}';
    const PAYMENT_LOTTERY_TABLE_NAME = '{{%payment_lottery}}';
    const USER_TABLE_NAME = '{{%user}}';
    const FK_PAYMENT_ID = 'paymentId';
    const FK_USER_ID = 'userId';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::BUY_LOTTERY_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'number' => $this->string()->notNull(),
            'typeName' => $this->string()->notNull(),
            'moneyPlay' =>  $this->string()->notNull(),
            'moneyPay' => $this->float()->notNull(),
            'paymentId' => $this->integer()->notNull(),
            'userId' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->addForeignKey(
            self::FK_PAYMENT_ID,
            self::BUY_LOTTERY_TABLE_NAME,
            'paymentId',
            self::PAYMENT_LOTTERY_TABLE_NAME,
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            self::FK_USER_ID,
            self::BUY_LOTTERY_TABLE_NAME,
            'userId',
            self::USER_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::FK_PAYMENT_ID, self::BUY_LOTTERY_TABLE_NAME);
        $this->dropForeignKey(self::FK_USER_ID, self::BUY_LOTTERY_TABLE_NAME);
        $this->dropTable(self::BUY_LOTTERY_TABLE_NAME);
    }
}