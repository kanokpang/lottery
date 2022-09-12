<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 6/17/2018
 * Time: 12:33 AM
 */

class m180617_243250_add_field_logo_team_football extends Migration
{
    const TEAM_FOOTBALL_TABLE_NAME = '{{%teamFootball}}';

    public function safeUp()
    {
        $this->addColumn(self::TEAM_FOOTBALL_TABLE_NAME, 'logo', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn(self::TEAM_FOOTBALL_TABLE_NAME, 'logo');
    }
}