<?php
/**
 * lsys service
 * 示例配置 未引入
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
return array(
	"default"=>array(
		"uri"=>"mongodb://192.168.1.101",//MONGODB连接地址
		'db'=>array(
			'name'=>'test',//默认数据库
			'options'=>[],
		),
	),
);