<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: topte
 * Date: 7/11/2018
 * Time: 1:56 PM
 */

class m180711_135650_create_comment_feed_news_table extends Migration
{
    const COMMENT_FEED_NEWS = '{{%comment_feed_news}}';
    const FEED_NEWS_TABLE_NAME = '{{%feed_news}}';

    public function safeUp()
    {
        $this->createTable(self::COMMENT_FEED_NEWS, [
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'feedNewsId' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'createdBy' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            '{{%comment_feed_news_feedNewsId}}',
            self::COMMENT_FEED_NEWS,
            'feedNewsId',
            self::FEED_NEWS_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable(self::COMMENT_FEED_NEWS);
    }
}