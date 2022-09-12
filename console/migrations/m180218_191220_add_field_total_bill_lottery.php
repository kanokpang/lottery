<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 18/2/2561
 * Time: 19:13
 */

class m180218_191220_add_field_total_bill_lottery extends Migration
{
    const BILL_LOTTERY_TABLE_NAME = '{{%bill_lottery}}';

    public function safeUp()
    {
        $this->addColumn(self::BILL_LOTTERY_TABLE_NAME, 'total', $this->float());
    }

    public function safeDown()
    {
        $this->dropColumn(self::BILL_LOTTERY_TABLE_NAME,'total');
    }
}