<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: topte
 * Date: 6/28/2018
 * Time: 11:10 PM
 */

class m180628_230950_add_fields_match_football_table extends Migration
{
    const MATCH_TAME_FOOTBALL_TABLE_NAME = '{{%matchfootball}}';

    public function safeUp()
    {
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'rangeOverFirstTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'rangeOverFullTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'homeWinFirstTime', $this->float());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'awayWinFirstTime', $this->float());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'drawWinFirstTime', $this->float());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'homeWinFullTime', $this->float());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'awayWinFullTime', $this->float());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'drawWinFullTime', $this->float());
    }

    public function safeDown()
    {
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'rangeOverFirstTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'rangeOverFullTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'homeWinFirstTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'awayWinFirstTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'drawWinFirstTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'homeWinFullTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'awayWinFullTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME, 'drawWinFullTime');
    }
}