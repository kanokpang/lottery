<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/12/2018
 * Time: 4:34 PM
 */

class m180512_163340_add_field_in_match_football extends Migration
{
    const MATCH_TAME_FOOTBALL_TABLE_NAME = '{{%matchfootball}}';

    public function safeUp()
    {
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'startBuy', $this->dateTime());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'endBuy', $this->dateTime());
    }

    public function safeDown()
    {
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'startBuy');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'endBuy');
    }
}