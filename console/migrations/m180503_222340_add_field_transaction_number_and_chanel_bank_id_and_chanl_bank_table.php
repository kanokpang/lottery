<?php

use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/3/2018
 * Time: 9:26 PM
 */

class m180503_222340_add_field_transaction_number_and_chanel_bank_id_and_chanl_bank_table extends Migration
{
    const CHANEL_BANK_TABLE_NAME = '{{%chanel_bank}}';
    const TRANSFER_MONEY_TABLE_NAME = '{{%transfer_money}}';
    const WITHDRAW_MONEY_TABLE_NAME = '{{%withdraw_money}}';

    public function safeUp()
    {
        $this->createTable(self::CHANEL_BANK_TABLE_NAME,[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->insert(self::CHANEL_BANK_TABLE_NAME,['name' => 'อินเทอร์เน็ต แบงค์กึ้ง']);
        $this->insert(self::CHANEL_BANK_TABLE_NAME,['name' => 'ผ่านเคาวน์เตอร์ธนาคาร']);
        $this->insert(self::CHANEL_BANK_TABLE_NAME,['name' => 'เอทีเอ็ม']);
        $this->insert(self::CHANEL_BANK_TABLE_NAME,['name' => 'ผ่านมือถือแบงค์']);
        $this->insert(self::CHANEL_BANK_TABLE_NAME,['name' => 'ตู้ฝากเงินสด']);
        $this->addColumn(self::TRANSFER_MONEY_TABLE_NAME, 'transactionNumber',$this->string()->notNull());
        $this->addColumn(self::TRANSFER_MONEY_TABLE_NAME,'chanelBankId',$this->integer()->notNull());
        $this->addForeignKey('{{%transfer_money_chanel_bank}}',
            self::TRANSFER_MONEY_TABLE_NAME,
            'chanelBankId',
            self::CHANEL_BANK_TABLE_NAME,
            'id',
            'CASCADE'
        );
        $this->addColumn(self::WITHDRAW_MONEY_TABLE_NAME, 'transactionNumber',$this->string()->notNull());
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%transfer_money_chanel_bank}}', self::TRANSFER_MONEY_TABLE_NAME);
        $this->dropColumn(self::WITHDRAW_MONEY_TABLE_NAME,'transactionNumber');
        $this->dropColumn(self::TRANSFER_MONEY_TABLE_NAME,'chanelBankId');
        $this->dropColumn(self::TRANSFER_MONEY_TABLE_NAME,'transactionNumber');
        $this->dropTable(self::CHANEL_BANK_TABLE_NAME);
    }
}