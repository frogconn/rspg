<?php

use yii\db\Migration;

class m170628_061201_init_rbac extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170628_061201_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170628_061201_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
