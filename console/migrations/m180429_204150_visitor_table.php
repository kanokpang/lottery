<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 29/4/2561
 * Time: 20:41
 */

class m180429_204150_visitor_table extends Migration
{
    const VISITOR_TABLE_NAME = '{{%visitor}}';

    public function safeUp()
    {
        $this->createTable(self::VISITOR_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'ip' => $this->string(),
            'visitorByDate' => $this->date(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable(self::VISITOR_TABLE_NAME);
    }
}