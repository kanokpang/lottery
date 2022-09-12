<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/4/2018
 * Time: 9:20 PM
 */

class m180504_211920_add_fields_in_match_football extends Migration
{
    const MATCH_TAME_FOOTBALL_TABLE_NAME = '{{%matchfootball}}';

    public function safeUp()
    {
        $matchTable = Yii::$app->db->schema->getTableSchema(self::MATCH_TAME_FOOTBALL_TABLE_NAME);
        if ($matchTable->getColumn('price')) {
            $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'price');
        }
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'hdpFirstTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'homeFirstTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'awayFirstTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'overFirstTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'underFirstTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'goalFirstTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'isFullTime', $this->integer());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'hdpFullTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'homeFullTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'awayFullTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'overFullTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'underFullTime', $this->string());
        $this->addColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'goalFullTime', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'hdpFirstTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'homeFirstTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'awayFirstTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'overFirstTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'underFirstTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'goalFirstTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'isFullTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'hdpFullTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'homeFullTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'awayFullTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'overFullTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'underFullTime');
        $this->dropColumn(self::MATCH_TAME_FOOTBALL_TABLE_NAME,'goalFullTime');
    }
}