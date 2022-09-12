<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 16/12/2560
 * Time: 15:28
 */

use yii\db\Migration;

class m171216_152840_teamFootball extends Migration
{
    const TEAM_FOOTBALL_TABLE_NAME = '{{%teamFootball}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TEAM_FOOTBALL_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable(self::TEAM_FOOTBALL_TABLE_NAME);
    }
}