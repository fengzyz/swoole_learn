<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/11/6
 * Time: 17:30
 */

$process =  new swoole_process(function (\Swoole\Process $worker){
    //从主进程中读取数据
    $cmd = $worker->read();
    ob_start();
    passthru($cmd);
    $ret = ob_get_clean() ? : ' ';
    $ret = trim($ret) . ". worker pid:" . $worker->pid . "\n";
    // 将数据写入管道
    $worker->write($ret);
    $worker->exit(0);  // 退出子进程
});

//启动进程
$process->start();
// 从主进程将通过管道发送数据到子进程
$process->write('php --version');
// 从子进程读取返回数据并打印
$msg = $process->read();
echo 'result from worker: ' . $msg;