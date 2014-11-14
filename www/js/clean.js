s('body#cleaner').pageInit(function(body){
    var buttons = s('a.main_clean_btn', 'div.main_clean_menu');
    buttons.each(function(btn){
        btn.click(function () {
            if (confirm("Вы уверены, что хотите очистить выбранные материалы? Восстановление невозможно.")) {
                s('.clean_result').html('Идет удаление, пожалуйста, подождите...');
            }
        });
        btn.ajaxClick(function (response) {
            if (response.status == '1') {
                s('.clean_result').html(response['html']);
            } else {
                s('.clean_result').html(response['html'] + '<br>Не удалось произвести очистку. Возможно нет подходящих материалов.');
            }
        });
    });
});
