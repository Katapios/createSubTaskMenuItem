<?php
defined('B_PROLOG_INCLUDED') || die;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Bitrix\Main\EventManager;

require (__DIR__ . '/example/js.php');

if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php')){
    require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
}

/* Подключение констант
*/
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/constants.php')){
    require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/constants.php');
}

CModule::AddAutoloadClasses(
    '', // не указываем имя модуля
    array(
        // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
        'MyClass' => '/local/php_interface/include/classes/MyClassName.php',
    )
);

/* Подключение событий
*/
if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/events.php')){
    require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/events.php');
}

/*
 Отключение вредных уведомлений
 */

Cmodule::includemodule('im');
Cmodule::includemodule('main');
\Bitrix\Im\Integration\Intranet\User::unRegisterEventHandler();