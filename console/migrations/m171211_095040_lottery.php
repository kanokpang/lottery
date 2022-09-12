<?php

use yii\db\Migration;

class m171211_095040_lottery extends Migration
{
    const LOTTERY_TABLE_NAME = '{{%lottery_period}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::LOTTERY_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'startDateTime' => $this->dateTime()->notNull(),
            'endDateTime' => $this->dateTime()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(1),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::LOTTERY_TABLE_NAME);
    }
}
