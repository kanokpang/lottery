<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/25/2018
 * Time: 9:33 PM
 */

class m180525_214020_add_field_is_seconed_team_in_match_football extends Migration
{
    const MATCH_TAME_FOOTBALL_TABLE_NAME = '{{%matchfootball}}';

    public function safeUp()
    {
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'isSecondTeam', $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'isSecondTeam');
    }
}