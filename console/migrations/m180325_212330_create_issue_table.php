<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 25/3/2561
 * Time: 21:26
 */

class m180325_212330_create_issue_table extends Migration
{
    const ISSUE_TABLE_NAME = '{{%issue}}';
    const USER_TABLE_NAME = '{{%user}}';

    public function safeUp()
    {
        $this->createTable(self::ISSUE_TABLE_NAME,[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'createdBy' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey('{{%createdByIssue}}',
            self::ISSUE_TABLE_NAME,
            'createdBy',
            self::USER_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%createdByIssue}}',self::ISSUE_TABLE_NAME);
        $this->dropTable(self::ISSUE_TABLE_NAME);
    }
}