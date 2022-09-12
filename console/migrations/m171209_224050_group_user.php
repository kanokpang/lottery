<?php

use yii\db\Migration;

class m171209_224050_group_user extends Migration
{
    const GROUP_USER_TABLE_NAME = '{{%user_group}}';
    const GROUP_TABLE_NAME = '{{%group}}';
    const USER_TABLE_NAME = '{{%user}}';
    const FK_GROUP_ID = 'groupIdFk';
    const FK_USER_ID = 'userIdFk';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::GROUP_USER_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'groupId' => $this->integer()->notNull(), 
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->addForeignKey(
            self::FK_USER_ID,
            self::GROUP_USER_TABLE_NAME,
            'userId',
            self::USER_TABLE_NAME,
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            self::FK_GROUP_ID,
            self::GROUP_USER_TABLE_NAME,
            'groupId',
            self::GROUP_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(self::FK_GROUP_ID, self::GROUP_USER_TABLE_NAME);
        $this->dropForeignKey(self::FK_USER_ID, self::GROUP_USER_TABLE_NAME);
        $this->dropTable(self::GROUP_USER_TABLE_NAME);
    }
}
