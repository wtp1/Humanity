<?php
$start_time = microtime(true);
$mem_start=memory_get_usage();
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('date.timezone', 'Asia/Almaty');
session_set_cookie_params(30758400);
ini_set('session.gc_maxlifetime', 30758400);
ini_set('session.cookie_lifetime', 30758400);
session_name('rubus');
session_start();

require_once '../../core/boot.php';
