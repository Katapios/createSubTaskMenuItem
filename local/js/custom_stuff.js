var CustomStuff = BX.namespace('CustomStuff');

CustomStuff.taskExtend = function(){

    //код исполняем, только когда DOM загружен
    BX.ready(function(){
        BX.addCustomEvent('onPopupFirstShow', function(p) {
            var menuId = 'task-view-b';
            if (p.uniquePopupId === 'menu-popup-' + menuId)
            {
                var menu = BX.PopupMenu.getMenuById(menuId)

                //добавляем пункт меню, полученному по id
                    menu.addMenuItem({
                    text: BX.message('CUSTOM_STUFF_CLONE_BUTTON_TITLE'),
                    href: 'javascript:CustomStuff.makeSubTask();',
                    className: 'menu-popup-item-copy'
                });
            }
        });
    });



}



CustomStuff.makeSubTask = function() {

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