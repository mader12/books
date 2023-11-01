<?php

use yii\db\Migration;

/**
 * Class m231031_173631_author
 */
class m231031_173631_author extends Migration
{
    public $tableName = '{{%author}}';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
        ], $tableOptions);

    }

    public function down()
    {
        if ($this->db->getTableSchema($this->tableName, true) !== null) {
            $this->dropTable($this->tableName);
        }
    }
}
