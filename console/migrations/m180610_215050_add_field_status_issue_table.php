<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 6/10/2018
 * Time: 9:50 PM
 */

class m180610_215050_add_field_status_issue_table extends Migration
{
    const ISSUE_TABLE_NAME = '{{%issue}}';

    public function safeUp()
    {
        $this->addColumn(self::ISSUE_TABLE_NAME, 'status', $this->integer()->defaultValue(1));
    }

    public function safeDown()
    {
        $this->dropColumn(self::ISSUE_TABLE_NAME, 'status');
    }
}