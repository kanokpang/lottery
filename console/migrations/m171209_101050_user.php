<?php

use yii\db\Migration;

class m171209_101050_user extends Migration
{
    const USER_TABLE_NAME = '{{%user}}';
    const FK_ID_BANK = 'fk-bank';
    const BANK_TABLE_NAME = '{{%bank}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::USER_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'fristName' => $this->string()->notNull(),
            'lastName' => $this->string()->notNull(),
            'address' => $this->string(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'bankId' => $this->integer()->notNull(),
            'numberBank' => $this->string(),
            'enabled' => $this->integer()->notNull()->defaultValue(1), 
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
        $this->insert(self::USER_TABLE_NAME, [
            'fristName' => 'sys',
            'lastName' => 'admin',
            'username' => 'sys',
            'password_hash' => Yii::$app->security->generatePasswordHash('sys123456'),
            'email' => 'sys@sys.com',
            'bankId' => 1,
            'numberBank' => '788499',
        ]);
         $this->addForeignKey(
            self::FK_ID_BANK,
            self::USER_TABLE_NAME,
            'bankId',
            self::BANK_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(self::FK_ID_BANK, self::USER_TABLE_NAME);
        $this->dropTable(self::USER_TABLE_NAME);
    }
}
