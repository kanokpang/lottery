<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 25/3/2561
 * Time: 21:38
 */
class m180325_213830_create_answer_issue_table extends Migration
{
    const ANSWER_ISSUE_TABLE_NAME = '{{%answer_issue}}';
    const ISSUE_TABLE_NAME = '{{%issue}}';
    const USER_TABLE_NAME = '{{%user}}';

    public function safeUp()
    {
        $this->createTable(self::ANSWER_ISSUE_TABLE_NAME,[
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'issueId' => $this->integer()->notNull(),
            'createdBy' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey('{{%issueAnswerIssue}}',
            self::ANSWER_ISSUE_TABLE_NAME,
            'issueId',
            self::ISSUE_TABLE_NAME,
            'id',
            'CASCADE'
        );
        $this->addForeignKey('{{%createdByAnswerIssue}}',
            self::ANSWER_ISSUE_TABLE_NAME,
            'createdBy',
            self::USER_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%issueAnswerIssue}}',self::ANSWER_ISSUE_TABLE_NAME);
        $this->dropForeignKey('{{%createdByAnswerIssue}}',self::ANSWER_ISSUE_TABLE_NAME);
        $this->dropTable(self::ANSWER_ISSUE_TABLE_NAME);
    }
}