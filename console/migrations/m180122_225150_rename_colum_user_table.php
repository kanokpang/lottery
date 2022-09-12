<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 22/1/2561
 * Time: 22:51
 */

class m180122_225150_rename_colum_user_table extends Migration
{
    const USER_TABLE_NAME = '{{%user}}';

    public function safeUp()
    {
        $table = Yii::$app->db->schema->getTableSchema(self::USER_TABLE_NAME);
        if ($table->getColumn('fristName')) {
            $this->renameColumn(self::USER_TABLE_NAME, 'fristName', 'firstName');
        }
        $this->addColumn(self::USER_TABLE_NAME,'birthDate', $this->date());
    }

    public function safeDown()
    {
        $this->dropColumn(self::USER_TABLE_NAME,'birthDate');
    }
}