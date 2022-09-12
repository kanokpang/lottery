<?php

use yii\db\Migration;

class m171209_222150_group extends Migration
{
    const GROUP_TABLE_NAME = '{{%group}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::GROUP_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'enabled' => $this->integer()->notNull()->defaultValue(1),
            'showFrontend' => $this->integer()->defaultValue(0),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
        $this->execute("INSERT INTO `lol_group` (`name`, `enabled`, `createdAt`, `updatedAt`, `showFrontend`) VALUES
('เจ้ามือ', 1, '2018-01-13 15:30:25', '2018-01-13 15:30:25', 0),
('Admin Website', 1, '2018-01-13 15:30:31', '2018-01-13 15:30:31', 0),
('Administrator', 1, '2018-01-17 22:11:27', '2018-01-17 22:11:27', 0),
('ตัวแทนขาย', 1, '2018-01-28 19:35:17', '2018-01-28 19:35:17', 1),
('ผู้ใช้ทั่วไป', 1, '2018-01-28 19:35:27', '2018-01-28 19:35:27', 1);");
    }

    public function down()
    {
        $this->dropTable(self::GROUP_TABLE_NAME);
    }
}
