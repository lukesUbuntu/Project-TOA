<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class GameMigration_101 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'game',
            array(
            'columns' => array(
                new Column(
                    'game_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 80,
                        'after' => 'game_id'
                    )
                ),
                new Column(
                    'description',
                    array(
                        'type' => Column::TYPE_TEXT,
                        'size' => 1,
                        'after' => 'name'
                    )
                ),
                new Column(
                    'start_file',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'description'
                    )
                ),
                new Column(
                    'author',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'after' => 'start_file'
                    )
                ),
                new Column(
                    'prefix',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 45,
                        'after' => 'author'
                    )
                ),
                new Column(
                    'updated_at',
                    array(
                        'type' => Column::TYPE_DATETIME,
                        'size' => 1,
                        'after' => 'prefix'
                    )
                ),
                new Column(
                    'created_at',
                    array(
                        'type' => Column::TYPE_DATETIME,
                        'size' => 1,
                        'after' => 'updated_at'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('game_id', 'prefix'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '22',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'latin1_swedish_ci'
            )
        )
        );
    }
}
