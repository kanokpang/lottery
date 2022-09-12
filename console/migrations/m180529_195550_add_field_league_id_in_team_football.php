<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/29/2018
 * Time: 7:55 PM
 */

class m180529_195550_add_field_league_id_in_team_football extends Migration
{
    const TEAM_FOOTBALL_TABLE_NAME = '{{%teamFootball}}';
    const LEAGUE_FOOTBALL_TABLE_NAME = '{{%leagueFootball}}';

    public function safeUp()
    {
        $this->addColumn(self::TEAM_FOOTBALL_TABLE_NAME, 'leagueId', $this->integer()->notNull());
        $this->addForeignKey(
            '{{%team_football_league_id}}',
            self::TEAM_FOOTBALL_TABLE_NAME,
            'leagueId',
            self::LEAGUE_FOOTBALL_TABLE_NAME,
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%team_football_league_id}}', self::TEAM_FOOTBALL_TABLE_NAME);
        $this->dropColumn(self::TEAM_FOOTBALL_TABLE_NAME,'leagueId');
    }
}