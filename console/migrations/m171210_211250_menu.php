<?php

use yii\db\Migration;

class m171210_211250_menu extends Migration
{
    const MENU_TABLE_NAME = '{{%menu}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::MENU_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'parentId' => $this->integer(),
            'status' => $this->integer()->defaultValue(1),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->execute(
            "INSERT INTO `lol_menu` (`id`, `url`, `name`, `parentId`, `createdAt`, `updatedAt`, `status`) VALUES
(1, 'contact-us', 'ติดต่อเรา', NULL, '2017-12-11 14:48:19', '2017-12-11 14:48:19', 0),
(2, 'news', 'ข่าวสาร', NULL, '2017-12-11 14:49:38', '2017-12-11 14:49:38', 1),
(3, 'manual-register', 'คู่มือการสมัครสมาชิก', NULL, '2017-12-11 14:50:28', '2017-12-11 14:50:28', 1),
(4, '#', 'โปรโมชั่น', NULL, '2017-12-11 14:51:25', '2017-12-11 14:51:25', 1),
(5, 'promotion-normal', 'โปรโมชั่นสมาชิกปกติ', 4, '2017-12-11 14:51:47', '2017-12-11 14:51:47', 1),
(6, 'promotion-agent', 'โปรโมชั่นตัวแทนขาย', 4, '2017-12-11 14:52:20', '2017-12-11 14:52:20', 1),
(7, 'home', 'หน้าแรก', NULL, '2018-02-19 22:50:59', '2018-02-19 22:50:59', 0);"
        );
    }

    public function down()
    {
        $this->dropTable(self::MENU_TABLE_NAME);
    }
}
