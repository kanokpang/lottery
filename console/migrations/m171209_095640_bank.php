<?php

use yii\db\Migration;

class m171209_095640_bank extends Migration
{
    const BANK_TABLE_NAME = '{{%bank}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::BANK_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
        $this->insert(self::BANK_TABLE_NAME, [
            'name' => 'ธนาคารออมสิน',
        ]);
    }

    public function down()
    {
        $this->dropTable(self::BANK_TABLE_NAME);
    }
}
