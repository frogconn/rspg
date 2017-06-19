<?php

use yii\db\Migration;

class m170616_114102_update_product extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170616_114102_update_product cannot be reverted.\n";

        return false;
    }

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
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('product');
    }
}
