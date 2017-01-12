<?php

require_once(realpath(dirname(__FILE__) . '/../vendor/autoload.php'));


$es = new Elasticsearch\Client([
	'hosts' => ['127.0.0.1:9200']
	]);
?>