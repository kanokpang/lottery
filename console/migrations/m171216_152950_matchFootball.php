<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 16/12/2560
 * Time: 15:30
 */

use yii\db\Migration;

class m171216_152950_matchFootball extends Migration
{
    const MATCH_FOOTBALL_TABLE_NAME = '{{%matchFootball}}';
    const FK_LEAGUE_ID = 'leagueId';
    const FK_TEAM_ID1 = 'teamId1';
    const FK_TEAM_ID2 = 'teamId2';
    const LEAGUE_FOOTBALL_TABLE_NAME = '{{%leagueFootball}}';
    const TEAM_FOOTBALL_TABLE_NAME = '{{%teamFootball}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::MATCH_FOOTBALL_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'leagueId' => $this->integer()->notNull(),
            'teamId1' => $this->integer()->notNull(),
            'teamId2' =>  $this->integer()->notNull(),
            'scoreTeam1' => $this->string()->defaultValue(0),
            'scoreTeam2' => $this->string()->defaultValue(0),
            'detail' => $this->text(),
            'status' => $this->integer()->defaultValue(1),
            'startMatch' => $this->dateTime()->notNull(),
            'endMatch' => $this->dateTime()->notNull(),
            'price' => $this->string(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->addForeignKey(
            self::FK_LEAGUE_ID,
            self::MATCH_FOOTBALL_TABLE_NAME,
            'leagueId',
            self::LEAGUE_FOOTBALL_TABLE_NAME,
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(self::FK_LEAGUE_ID, self::MATCH_FOOTBALL_TABLE_NAME);
        $this->dropTable(self::MATCH_FOOTBALL_TABLE_NAME);
    }
}