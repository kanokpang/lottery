<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 6/21/2018
 * Time: 10:24 PM
 */

class m180621_222450_add_field_in_user_table extends Migration
{
    const USER_TABLE_NAME = '{{%user}}';

    public function safeUp()
    {
        $this->addColumn(self::USER_TABLE_NAME, 'referCode', $this->string());
        $this->addColumn(self::USER_TABLE_NAME, 'referenceReferCode', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn(self::USER_TABLE_NAME, 'referCode');
        $this->dropColumn(self::USER_TABLE_NAME, 'referenceReferCode');
    }
}