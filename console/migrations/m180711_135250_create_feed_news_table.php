<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: topte
 * Date: 7/11/2018
 * Time: 1:52 PM
 */

class m180711_135250_create_feed_news_table extends Migration
{
    const FEED_NEWS_TABLE_NAME = '{{%feed_news}}';

    public function safeUp()
    {
        $this->createTable(self::FEED_NEWS_TABLE_NAME,[
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'createdBy' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable(self::FEED_NEWS_TABLE_NAME);
    }
}