<?php

use yii\db\Migration;

class m171210_222440_information extends Migration
{
    const INFORMATION_TABLE_NAME = '{{%information}}';
    const MENU_TABLE_NAME = '{{%menu}}';
    const FK_MENU_ID = 'menuId';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::INFORMATION_TABLE_NAME, [
            'id' => $this->primaryKey(),
            'menuId' => $this->integer()->notNull(),
            'detail' => $this->text(),
            'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->addForeignKey(
            self::FK_MENU_ID,
            self::INFORMATION_TABLE_NAME,
            'menuId',
            self::MENU_TABLE_NAME,
            'id',
            'CASCADE'
        );

        $this->execute(
            "INSERT INTO `lol_information` (`id`, `menuId`, `detail`, `createdAt`, `updatedAt`) VALUES
(1, 1, '<p>ติดต่อเรา</p>\r\n', '2017-12-11 14:52:43', '2017-12-11 14:52:43'),
(2, 2, '<p>ข่าวสาร</p>\r\n', '2017-12-11 14:59:09', '2017-12-11 14:59:09'),
(3, 3, '<p>คู่มือการสมัครสมาชิก</p>\r\n', '2017-12-11 14:59:31', '2017-12-11 14:59:31'),
(4, 5, '<p>โปรโมชั่นแบบปกติ</p>\r\n\r\n<p>สมัครครั้งแรกมี ID. Refer<br />\r\nST000x ของคนที่เป็นสมาชิกอยู่แล้ว ทั ้งคนสมัครกับคนที่ให้ ID. Refer ST000xจะได้<br />\r\nCredit free 50) และจะมีส่วนสดพิเศษ ตามยอดที่ซื ้อ หรือเป็น Credit<br />\r\n&nbsp;</p>\r\n', '2017-12-11 15:00:04', '2017-12-11 15:00:04'),
(5, 6, '<p>โปรโมชั่นตัวแทนขาย</p>\r\n\r\n<p>ตัวแทนขาย (มีส่วนสดพิเศษ ตามยอดที่ขายก้อคือซื ้อ เงือนไขการเป็นตัวแทน<br />\r\nขายต้องจ่ายสมัคร<br />\r\n&nbsp;</p>\r\n', '2017-12-11 15:00:39', '2017-12-11 15:00:39'),
(6, 7, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h1 style=\"text-align:center\">เปิดให้บริการ 8.00น. - 24.00น.</h1>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h5 style=\"text-align:center\"><span style=\"color:#008000\">(ปัญหาฝากเงิน โอนผิด ลืมเศษสตางค์ เริ่มแก้ยอดให้ตอน 10.00น.)</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</h5>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><strong><span style=\"color:#0000ff\">ฝากเงินได้24ชั่วโมง ไม่มีขั้นต่ำ / ถอนเงินขั้นต่ำ500บาทฟรีค่าธรรมเนียม / แนะนำเพื่อนAFF 5% / รางวัลปิงปอง 300 บาท/รอบ</span></strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"background-color:#ffff99; color:#ff0000\">เว็บจะปรับยอดเงินให้กับลูกค้าที่ใช้บัญชีถอนโอนเติมเข้ามาเท่านั้น หากเราพบความผิดปกติ ยกเลิกปรับให้ทุกกรณีและระงับuserถาวร</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"background-color:#ff0000; color:#ffffff\"><strong>ห้ามฝากเพื่อนหรือบุคคลอื่นโอน ต้องใช้บัญชีถอนเงินกับทางเว็บโอนเท่านั้น ตรวจพบแบนทุกกรณี</strong></span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h3>ยินดีต้อนรับ 999LUCKY</h3>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&nbsp; เว็บ<strong>แทงหวยออนไลน์</strong> รูปแบบใหม่ ทำงานด้วยระบบอัตโนมัติ&nbsp; การฝากเงิน การถอนเงิน รวดเร็ว ปลอดภัย การเงินมั่นคง&nbsp;เหมาะสำหรับลูกค้าที่ต้องการความสะดวกสบาย โปรงใส่100% มีให้เลือกแทงหวยแทบทุกชนิด หวยรัฐบาล หวยล็อตเตอรี่ หวยหุ้น หวยต่างประเทศ หวยมาเล และ หวยปิงปอง(จับยีกี) 24&nbsp;ชั่วโมง ทุก15นาที การประมวลผลด้วยทีมงานมืออาขีพ&nbsp;ท่านจึงมั่นใจได้ว่าท่านจะได้รับการบริการและการแก้ไขปัญหาต่างๆในระดับที่ดีที่สุดไม่ว่าท่านจะแทง1บาท 5บาท 10บาท ท่านจะได้รับความสะดวกสบายแน่นอน สำหรับมือใหม่ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; เรามีคู่มือให้อ่านตั้งแต่เริ่มต้น พร้อมอธิบายทุกรายละเอียด&nbsp; มีทีมงานค่อยบริการตลอดการใช้งาน สามารถติดต่อทีมงานได้ที่เมนูของเว็บ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; หมดปัญหาการถูกหลอกลวงอีกต่อไป เราเท่านั้นที่กล้าให้ เฮียบิ๊ก@ปอยเปต</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h3>สำหรับลูกค้าใหม่ การฝากเงิน</h3>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&nbsp; ระบบเราเป็นระบบฝากเงินอัตโนมัติ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ลูกค้าที่โอนเงินเข้ามาอย่าเซฟเลขบัญชีเป็นรายการโปรด ให้กรอกเพื่อโอนเองทุกครั้ง &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ระบบอาจมีการเปลี่ยนแปลงบัญชีฝากเงิน ให้ดูยอดเงินที่ต้องโอนทุกครั้ง &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ห้ามปัดเศษสตางค์ ห้ามลืมเศษสตางค์ ใช้บัญชีที่ถอนเงินโอนเข้ามาเท่านั้น &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ไม่เช่นนั้นระบบจะไม่ปรับเครดิตและแบนถอนuserทันที</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h3><span style=\"color:#0000ff\">#</span>&nbsp;วิธีใช้งานเว็บ/วิธีดูหวย ทุกส่วน &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; อยู่ใน&nbsp;<a href=\"https://999lucky.com/page/faq\" title=\"คู่มือใช้งาน วิธีแทงหวยทุกส่วน มือใหม่อ่านค่ะ\">คู่มือใช้งาน</a>&nbsp;(อ่านครั้งเดียวเป็นครับ) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</h3>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h2>ติดต่อทีมงาน / บริหารงานโดย เฮียบิ๊ก @ ปอยเปต</h2>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p><span style=\"color:#ff0000\"><strong>#</strong></span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; เนื่องจากทีมงานทำงานต่างประเทศ ลูกค้าสามารถติดต่อได้ทางเมนูของเว็บเท่านั้นค่ะ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong><a href=\"https://999lucky.com/profile/help\">คลิ้กที่นี้เพื่อติดต่อทีมงานโดยด่วน</a></strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h5><span style=\"color:#ff0000\">(ระวังมิจฉาชีพหลอกให้โอนเงิน เว็บไม่มีนโยบายชักชวนให้เติมเงินผ่านทางแชทหรือLINE ให้เติมผ่านเมนูในระบบเว็บเท่านั้นค่ะ)</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</h5>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h3 style=\"text-align:center\"><span style=\"color:#008000\"><a href=\"https://999lucky.com/page/announce/show/30\" style=\"color: #008000;\" title=\"แทงหวยออนไลน์\">สิทธิพิเศษลูกค้า999LUCKY สามารถรับผลหวยปิงปอง หวยหุ้น หวยต่างๆ ผ่าน LINE ได้แล้วค่ะ</a></span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</h3>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p><img alt=\"แทงหวยออนไลน์\" src=\"https://999lucky.com/assets/global/img/lucky.jpg\" style=\"height:auto; width:1024px\" /></p>\r\n', '2018-02-19 22:53:48', '2018-02-19 22:53:48');"
        );
    }

    public function down()
    {
        $this->dropForeignKey(self::FK_MENU_ID, self::INFORMATION_TABLE_NAME);
        $this->dropTable(self::INFORMATION_TABLE_NAME);
    }
}
