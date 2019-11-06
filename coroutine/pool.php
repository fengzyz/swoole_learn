<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/8/30
 * Time: 17:09
 */
use Swoole\Coroutine as co;
$pool = new Swoole\Process\Pool(5, SWOOLE_IPC_NONE, 0, true);
co::set([
    'max_coroutine' => 4096,
]);
$pool->on('workerStart', function (Swoole\Process\Pool $pool, int $workerId) {
    $temp = 100;
    for ($j = 0; $j < $temp; $j++) {
        co::sleep(0.5);
        echo "hello world\n".co::getCid();
    }
});

$pool->start();