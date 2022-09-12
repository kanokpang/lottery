<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/19/2018
 * Time: 5:02 PM
 */

class m180519_170250_add_data_chanel extends Migration
{
    const CHANEL_BANK_TABLE_NAME = '{{%chanel_bank}}';

    public function safeUp()
    {
        $this->insert(self::CHANEL_BANK_TABLE_NAME, ['name' => 'Not specified']);
        $this->update(self::CHANEL_BANK_TABLE_NAME, ['id' => 0], ['name'=>'Not specified']);
    }

    public function safeDown()
    {
        $this->delete(self::CHANEL_BANK_TABLE_NAME, ['name' => 'Not specified']);
    }

}