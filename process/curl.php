<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/8/5
 * Time: 14:17
 */


echo "process-start-time：".date('Ymd H:i:s');
$workers = [];
$urls  = [
    'www.baidu.com',
    'https://learnku.com',
    'https://www.imooc.com'
];
for ($i = 0; $i < 3;$i++){
    $process = new swoole_process(function (swoole_process $worker)
    use($i,$urls){
        $content = curlData($urls[$i]);
        echo $content.PHP_EOL;
    },true);
    $pid = $process->start();
    $workers[$pid] = $process;
}
//从管道中读取数据
foreach ($workers as $process){
   echo $process->read();
}
/**
 * 模拟请求url
 * @param $url
 * @return string
 */
function curlData($url){
    sleep(1);
    return  $url.'success'.PHP_EOL;
}
echo "process-end-time：".date('Ymd H:i:s');