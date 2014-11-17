s('body#cleaner').pageInit(function(body){
    var buttons = s('a.main_clean_btn', 'div.main_clean_menu');
    //s('.loader').hide();
    buttons.each(function(btn){
        var cleanResult = s('.clean_result');
        var loader = s('.loader');
        btn.click(function () {
            //if (confirm("Вы уверены, что хотите очистить выбранные материалы? Восстановление невозможно.")) {
            cleanResult.html('Идет удаление, пожалуйста, подождите...');
            loader.show();
            //}
        });
        btn.ajaxClick(function (response) {
            //if (confirm("Вы уверены, что хотите очистить выбранные материалы? Восстановление невозможно.")) {
            cleanResult.html('Идет удаление, пожалуйста, подождите...');
                if (response.status == '1') {
                    cleanResult.html(response['html']);
                    loader.hide();
                } else {
                    cleanResult.html(response['html'] + '<br>Не удалось произвести очистку. Возможно нет подходящих материалов.');
                    loader.hide();
                }
            //}
        });
    });
});
