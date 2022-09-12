<?php

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 25/12/2560
 * Time: 17:20
 */

use yii\db\Migration;

class m171225_172050_add_column_user extends Migration
{
    const USER_TABLE_NAME = '{{%user}}';

    public function safeUp()
    {
        $this->addColumn(self::USER_TABLE_NAME, 'mobile', $this->string());
        $this->addColumn(self::USER_TABLE_NAME, 'lineId', $this->string());
        $this->addColumn(self::USER_TABLE_NAME, 'profileImage', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn(self::USER_TABLE_NAME,'mobile');
        $this->dropColumn(self::USER_TABLE_NAME,'lineId');
        $this->dropColumn(self::USER_TABLE_NAME,'profileImage');
    }
}