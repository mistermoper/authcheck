<?php

require_once "vendor/autoload.php";

use GuzzleHttp\Client;
use Authcheck\Config;
use Authcheck\Authcheck;

$config = new Config();
$client = new Client();

$authcheck = new Authcheck($config, $client);
$authcheck->check();