<?php

use yii\db\Migration;

class m170616_115018_add_note_to_product extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170616_115018_add_note_to_product cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->addColumn('product', 'note', $this->text());
    }

    public function down()
    {
        $this->dropColumn('product', 'note');
    }
    
}
