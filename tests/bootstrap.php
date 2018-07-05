<?php
if (!@include_once __DIR__ . '/../vendor/autoload.php') {
    $message = <<<MSG
You must run the following commands:
> wget http://getcomposer.org/composer.phar
> php composer.phar install
MSG;
    exit($message);
}