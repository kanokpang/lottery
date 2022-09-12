<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/13/2018
 * Time: 12:13 AM
 */
class m180513_121340_result_football extends Migration
{
    const RESULT_FOOTBALL = '{{%result_football}}';
    const MATCH_TAME_FOOTBALL_TABLE_NAME = '{{%matchfootball}}';
    const USER = '{{%user}}';

    public function safeUp()
    {
        $this->createTable(self::RESULT_FOOTBALL, [
            'id' => $this->primaryKey(),
            'matchId' => $this->integer()->notNull(),
            'teamWinByMatchId' => $this->integer()->notNull(),
            'createdBy' => $this->integer()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey('{{%result_football_match_id}}',
            self::RESULT_FOOTBALL,
            'matchId',
            self::MATCH_TAME_FOOTBALL_TABLE_NAME,
            'id'
        );
        $this->addForeignKey('{{%result_football_created_by}}',
            self::RESULT_FOOTBALL,
            'createdBy',
            self::USER,
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%result_football_match_id}}', self::RESULT_FOOTBALL);
        $this->dropForeignKey('{{%result_football_created_by}}', self::RESULT_FOOTBALL);
        $this->dropTable(self::RESULT_FOOTBALL);
    }
}