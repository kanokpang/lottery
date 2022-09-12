<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/13/2018
 * Time: 12:04 AM
 */
class m180513_240450_buy_football extends Migration
{
    const BUY_FOOTBALL = '{{%buy_football}}';
    const MATCH_TAME_FOOTBALL_TABLE_NAME = '{{%matchfootball}}';
    const USER = '{{%user}}';

    public function safeUp()
    {
        $this->createTable(self::BUY_FOOTBALL, [
            'id' => $this->primaryKey(),
            'matchId' => $this->integer()->notNull(),
            'teamWinByMatchId' => $this->integer()->notNull(),
            'moneyPlay' => $this->string()->notNull(),
            'createdBy' => $this->integer()->notNull(),
            'isTrue' => $this->integer()->defaultValue(0),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey('{{%buy_football_match_id}}',
            self::BUY_FOOTBALL,
            'matchId',
            self::MATCH_TAME_FOOTBALL_TABLE_NAME,
            'id'
        );
        $this->addForeignKey('{{%buy_football_created_by}}',
            self::BUY_FOOTBALL,
            'createdBy',
            self::USER,
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%buy_football_match_id}}', self::BUY_FOOTBALL);
        $this->dropForeignKey('{{%buy_football_created_by}}', self::BUY_FOOTBALL);
        $this->dropTable(self::BUY_FOOTBALL);
    }
}