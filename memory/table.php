<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/8/5
 * Time: 15:23
 */

$table = new swoole_table(1024);

//定义列
$table->column('id',swoole_table::TYPE_INT,4);
$table->column('name',swoole_table::TYPE_STRING,64);
$table->column('age',swoole_table::TYPE_INT,4);
//创建内存表
$table->create();

$table->set('1', ['id' => 1, 'name' => 'test1', 'age' => 20]);
$table->set('2', ['id' => 2, 'name' => 'test2', 'age' => 21]);
$table->set('3', ['id' => 3, 'name' => 'test3', 'age' => 19]);