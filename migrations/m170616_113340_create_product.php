<?php

use yii\db\Migration;

class m170616_113340_create_product extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170616_113340_create_product cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
      $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'description' => $this->text(),
            'photo' => $this->string(255),
            'cost' => $this->integer(),
            'price' => $this->integer(),
            'status' => $this->integer(1),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    public function down()
    {
        $this->dropTable('product');
    }

}
