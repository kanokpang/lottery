<?php

use yii\db\Migration;

class m171214_190440_condition_lottery extends Migration
{
    const CONDITION_LOTTERY_TABLE_NAME = '{{%condition_lottery}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::CONDITION_LOTTERY_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'number' => $this->string()->notNull(),
            'condition' => $this->integer(),
            'limit' => $this->string(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::CONDITION_LOTTERY_TABLE_NAME);
    }
}
