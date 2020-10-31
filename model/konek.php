<?php
 require 'vendor/autoload.php';
$config = require 'config.php';
$host = $config['db']['host']??('127.0.0.1');
$klien = new MongoDB\Client("mongodb://{$host}:27017");