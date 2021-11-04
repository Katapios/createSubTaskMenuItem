<?php
define('PUBLIC_AJAX_MODE', true);
define('STOP_STATISTICS', true);
define('NO_AGENT_CHECK', true);

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

check_bitrix_sessid() || die;

//$APPLICATION->ShowAjaxHead();


//копируем задачу
//CModule::IncludeMOdule('tasks');
//$task = new CTaskItem(1, 1);
//$res = $task->duplicate();
//foreach($res as $taskInst)
//{
//    $data = $taskInst->getData(false);
//    print_r($data['ID'].' -> '.$data['TITLE'].PHP_EOL);
//}



//получаем response ajax и забираем id задачи
//получаем задачу юзера

if (CModule::IncludeModule("tasks"))
{
    $res = CTasks::GetList(
        Array("TITLE" => "ASC"),
        Array("ID" => $_GET['id']),
        Array("ID","TITLE","DESCRIPTION","CREATED_BY","RESPONSIBLE_ID")
    );

    while ($arTask = $res->GetNext())
    {
//        echo "Название задачи: ".$arTask["TITLE"]."<br>";
//        echo "Описание задачи: ".$arTask["DESCRIPTION"]."<br>";
//        echo "Постановщик задачи: ".$arTask["CREATED_BY"]."<br>";
//        echo "Ответственный за задачу".$arTask["RESPONSIBLE_ID"]."<br>";
        $result["TASK_NAME"] = $arTask["TITLE"];
        $result["TASK_DESCRIPTION"] = $arTask["DESCRIPTION"];
        $result["TASK_CREATED_BY"] = $arTask["CREATED_BY"];
        $result["TASK_RESPONSIBLE_ID"] = $arTask["RESPONSIBLE_ID"];
    }

//создаем подзадачу от задачи
    $arFields = array(
        "TITLE" => $result["TASK_NAME"],
        "DESCRIPTION" => $result["TASK_DESCRIPTION"],
        "RESPONSIBLE_ID" => $result["TASK_RESPONSIBLE_ID"],
        "PARENT_ID" => $_GET['id'],
    );

    $obTask = new CTasks;
    $ID = $obTask->Add($arFields);
    $success = ($ID > 0);
//    echo $ID;
    $result = array(
        'Subid' => (string)$ID,
        'EditorID' => $_GET['Userid']
    );

   echo json_encode($result);
}
