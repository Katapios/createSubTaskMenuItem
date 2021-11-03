<?php
defined('B_PROLOG_INCLUDED') || die;

use
    Bitrix\Main\Page\Asset,
    Bitrix\Main\EventManager,
    Bitrix\Main\Application,
    Bitrix\Main\Context,
    Bitrix\Main\Request,
    Bitrix\Main\Server,
    Bitrix\Main\UI\Extension,
    Bitrix\Main\Config\Option,
    Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\UserField\TypeBase;


Asset::getInstance()->addJs(SITE_DIR."local/js/jquery-3.1.1.min.js");

Asset::getInstance()->addJs('/local/js/swap.js');

Asset::getInstance()->addCss('/local/css/fontawesomeall.css');

CJSCore::RegisterExt(
    'custom_stuff',
    array(
        'js' => '/local/js/custom_stuff.js',
        'lang' => '/local/lang/ru/custom_stuff.js.php',
        'css' => '/local/css/custom_stuff.css',
        'rel' => array('ajax','popup')
    )
);

//инициализируем наше подключение
CJSCore::Init('custom_stuff');

$asset = Asset::getInstance();

//$asset->addString('<script>BX.ready(function() {BX.CustomStuff.myfunc();}); </script>');