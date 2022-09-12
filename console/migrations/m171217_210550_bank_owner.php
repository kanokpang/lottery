<?php

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 17/12/2560
 * Time: 21:05
 */

use yii\db\Migration;

class m171217_210550_bank_owner extends Migration
{
    const BANK_OWNER_TABLE_NAME = '{{%bank_owner}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::BANK_OWNER_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'number' => $this->string()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable(self::BANK_OWNER_TABLE_NAME);
    }
}