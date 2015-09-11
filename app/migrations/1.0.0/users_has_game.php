<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class UsersHasGameMigration_100 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'users_has_game',
            array(
            'columns' => array(
                new Column(
                    'game_game_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'game_score',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'game_game_id'
                    )
                ),
                new Column(
                    'users_id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 10,
                        'after' => 'game_score'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('game_game_id', 'users_id')),
                new Index('fk_users_has_game_game1_idx', array('game_game_id')),
                new Index('fk_users_has_game_users1_idx', array('users_id'))
            ),
            'references' => array(
                new Reference('fk_users_has_game_game1', array(
                    'referencedSchema' => 'toa',
                    'referencedTable' => 'game',
                    'columns' => array('game_game_id'),
                    'referencedColumns' => array('game_id')
                )),
                new Reference('fk_users_has_game_users1', array(
                    'referencedSchema' => 'toa',
                    'referencedTable' => 'users',
                    'columns' => array('users_id'),
                    'referencedColumns' => array('id')
                ))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '8',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'latin1_swedish_ci'
            )
        )
        );
    }
}
