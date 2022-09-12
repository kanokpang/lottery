<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/29/2018
 * Time: 8:08 PM
 */

class m180529_200930_bill_football extends Migration
{
    const BILL_FOOTBALL = '{{%bill_football}}';
    const USER_TABLE_NAME = '{{%user}}';
    const BUY_FOOTBALL = '{{%buy_football}}';

    public function safeUp()
    {
        $this->createTable(self::BILL_FOOTBALL, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'buyId' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'createdBy' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('{{%bill_football_buy_id}}',
            self::BILL_FOOTBALL,
            'buyId',
            self::BUY_FOOTBALL,
            'id',
            'CASCADE'
        );

        $this->addForeignKey('{{%bill_football_created_by}}',
            self::BILL_FOOTBALL,
            'createdBy',
            self::USER_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%bill_football_buy_id}}', self::BILL_FOOTBALL);
        $this->dropForeignKey('{{%bill_football_created_by}}', self::BILL_FOOTBALL);
        $this->dropTable(self::BILL_FOOTBALL);
    }
}