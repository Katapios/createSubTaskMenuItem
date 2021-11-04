var CustomStuff = BX.namespace('CustomStuff');


CustomStuff.taskExtend = function() {
    var panelWidget = BX.findChildByClassName(document, 'task-view-buttonset',true);
    var panelCategoryWidget = BX.findChildByClassName(panelWidget, 'edit', true);
    console.log(panelCategoryWidget)
    var thankButton = BX.create('a', {
        attrs : {
            className : 'user-profile-events-item',
            href : 'javascript:void(0);'
        },
        html : '<i></i> ' + BX.message('CUSTOM_STUFF_CLONE_BUTTON_TITLE')
    });

    BX.bind(thankButton, 'click', CustomStuff.showThankPopup);
    panelCategoryWidget.appendChild(thankButton);
};

CustomStuff.showThankPopup = function() {

//отправляю POST запрос и получаю ответ

//работаем с url для выделеня id задачи
    var url = document.location.pathname;
    trimUrl = url.slice(0, -1)
    var id = trimUrl.substring(trimUrl.lastIndexOf('/') + 1);

    BX.ajax.loadJSON (//Выполняем POST запрос
        '/local/php_interface/ajax-files/taskExtends.php',
        {
            sessid : BX.bitrix_sessid(),
            id:id,
            Userid:1
        },
        function (response) {//Функция при успешном выполнении
            console.log(response);
            //редиректим на редактирование подзадачи
            var subTaskid = response;

            // console.log(subTaskid.Subid)
            // console.log(subTaskid.EditorUrl)

            window.location.replace("/company/personal/user/"+subTaskid.EditorUrl+"/tasks/task/edit/"+subTaskid.Subid+"/" +"");

        });
}