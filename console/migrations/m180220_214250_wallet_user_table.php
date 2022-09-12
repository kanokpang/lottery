<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 20/2/2561
 * Time: 21:42
 */

class m180220_214250_wallet_user_table extends Migration
{
    const WALLET_USER_TABLE_NAME = '{{%wallet_user}}';
    const USER_TABLE_NAME = '{{%user}}';
    const USER_ID = 'walletUserId';

    public function safeUp()
    {
        $this->createTable(self::WALLET_USER_TABLE_NAME,[
            'id' => $this->primaryKey(),
            'total' => $this->float()->notNull(),
            'userId' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey(self::USER_ID,
            self::WALLET_USER_TABLE_NAME,
            'userId',
            self::USER_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::USER_ID,self::WALLET_USER_TABLE_NAME);
        $this->dropTable(self::WALLET_USER_TABLE_NAME);
    }


}