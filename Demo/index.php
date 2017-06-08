<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use Yurun\Until\Event;

// 监听事件
Event::on('test', function($e){
	var_dump('trigger test', $e);
	$e['value'] = 'yurun';
});

// 触发事件
Event::trigger('test', array('message'=>'666', 'value'=>&$value));
var_dump('value:',$value);