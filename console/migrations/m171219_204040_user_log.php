<?php

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 19/12/2560
 * Time: 20:40
 */

use yii\db\Migration;

class m171219_204040_user_log extends Migration
{
    const USER_LOG_TABLE_NAME = '{{%user_log}}';
    const USER_TABLE_NAME = '{{%user}}';
    const FK_USER_ID = 'userLog_userId';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::USER_LOG_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'ipAddress' => $this->string()->notNull(),
            'status' => $this->integer()->notNull()->comment('1 = login, 2 = logout'),
            'userId' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
        $this->addForeignKey(
            self::FK_USER_ID,
            self::USER_LOG_TABLE_NAME,
            'userId',
            self::USER_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::FK_USER_ID, self::USER_LOG_TABLE_NAME);
        $this->dropTable(self::USER_LOG_TABLE_NAME);
    }
}