<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 16/12/2560
 * Time: 14:57
 */

use yii\db\Migration;
class m171211_095550_promotion_lottery extends  Migration
{
    const PROMOTION_LOTTERY_TABLE_NAME ='{{%promotion_lottery}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::PROMOTION_LOTTERY_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable(self::PROMOTION_LOTTERY_TABLE_NAME);
    }
}