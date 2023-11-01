<?php

use yii\db\Migration;

/**
 * Class m231031_183657_bookauthor
 */
class m231031_183657_bookauthor extends Migration
{
    public $tableName = '{{%bookauthor}}';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'idbook' => $this->integer()->notNull(),
            'idauthor' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('bookauthor_book_fk_constraint', $this->tableName, 'idbook', '{{%book}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('bookauthor_author_fk_constraint', $this->tableName, 'idauthor', '{{%author}}', 'id', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        if ($this->db->getTableSchema($this->tableName, true) !== null) {
            $this->dropTable($this->tableName);
        }
    }
}
