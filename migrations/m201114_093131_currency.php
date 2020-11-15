<?php

use yii\db\Migration;

/**
 * Class m201114_093131_currency
 */
class m201114_093131_currency extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('currencies', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->unique(),
            'name' => $this->string()->notNull(),
            'rate' => $this->decimal(8, 4),
            'insert_dt' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('currencies');

//        echo "m201114_093131_currency cannot be reverted.\n";
//        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201114_093131_currency cannot be reverted.\n";

        return false;
    }
    */
}
