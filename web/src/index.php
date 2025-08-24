<?php
if($_SERVER['REQUEST_URI'] === 'admin'){
    require 'admin/index.php';
    exit;
}

if($_SERVER['REQUEST_URI'] === 'user'){
    require 'user/index.php';
    exit;
}

if($_SERVER['REQUEST_URI'] === 'ai'){
    require 'ai/index.php';
    exit;
}

if($_SERVER['REQUEST_URI'] === 'auth/login'){
    require 'auth/login.php';
    exit;
}
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path === '/openai') {
    require 'openai.php';
    exit;
}



