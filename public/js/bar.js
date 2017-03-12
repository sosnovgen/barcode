$(document).ready(function () {
    //alert('Подключён, начинаю работу!')

    //-------- Удаление категории ---------------
    $('td > .cat_link').click(function (event) {
        event.preventDefault();

        var id = $(this).attr("href"); //Получить текст ссылки из таб. "categories"
        var href = 'cat/' + id; //Сформировать ссылку для AJAX
        var _parent = $(this).parent().parent();
        var token = $('#token-keeper').data("token"); //Строка таблицы <TR>

        confirm_var = confirm('Удалить категорию?'); //запрашиваем подтверждение на удаление
        if (!confirm_var) {
            return false;
        }

        $.ajax({
            url: href, //url куда мы передаем delete запрос
            method: "POST",
            data: {'_token': token, '_method': "DELETE"}, //не забываем передавать токен, или будет ошибка.

            success: function () {
                _parent.remove(); // удаляем строчку tr из таблицы
                console.log('Успешно! (delete)');
            },
            error: function () {
                console.log('Не то!');
            }
        });
    })

    //-------- Удаление товара ---------------
    $('td > .article_link').click(function (event) {
        event.preventDefault();

        var id = $(this).attr("href"); //Получить текст ссылки из таб. "article"
        var href = 'article/' + id; //Сформировать ссылку для AJAX
        var _parent = $(this).parent().parent();
        var token = $('#token-keeper2').data("token"); //Строка таблицы <TR>

        confirm_var = confirm('Удалить товар?'); //запрашиваем подтверждение на удаление
        if (!confirm_var) {
            return false;
        }

        $.ajax({
            url: href, //url куда мы передаем delete запрос
            method: "POST",
            data: {'_token': token, '_method': "DELETE"}, //не забываем передавать токен, или будет ошибка.

            success: function () {
                _parent.remove(); // удаляем строчку tr из таблицы
                console.log('Успешно! (delete)');
            },
            error: function () {
                console.log('Не то!');
            }
        });
    })
    //-------- Удаление группы ---------------
    $('td > .group_link').click(function (event) {
        event.preventDefault();

        var id = $(this).attr("href"); //Получить текст ссылки из таб. "article"
        var href = 'group/' + id; //Сформировать ссылку для AJAX
        var _parent = $(this).parent().parent();
        var token = $('#token-keeper3').data("token"); //Строка таблицы <TR>

        confirm_var = confirm('Удалить группу?'); //запрашиваем подтверждение на удаление
        if (!confirm_var) {
            return false;
        }

        $.ajax({
            url: href, //url куда мы передаем delete запрос
            method: "POST",
            data: {'_token': token, '_method': "DELETE"}, //не забываем передавать токен, или будет ошибка.

            success: function () {
                _parent.remove(); // удаляем строчку tr из таблицы
                console.log('Успешно! (delete)');
            },
            error: function () {
                console.log('Не то!');
            }
        });
    })

    //-------- Удаление склада ---------------
    $('td > .sklad_link').click(function (event) {
        event.preventDefault();

        var id = $(this).attr("href"); //Получить текст ссылки из таб. "atribute"
        var href = 'sklads/' + id; //Сформировать ссылку для AJAX
        var _parent = $(this).parent().parent();
        var token = $('#token-keeper4').data("token"); //Строка таблицы <TR>

        confirm_var = confirm('Удалить склад?'); //запрашиваем подтверждение на удаление
        if (!confirm_var) {
            return false;
        }

        $.ajax({
            url: href, //url куда мы передаем delete запрос
            method: "POST",
            data: {'_token': token, '_method': "DELETE"}, //не забываем передавать токен, или будет ошибка.

            success: function () {
                _parent.remove(); // удаляем строчку tr из таблицы
                console.log('Успешно! (delete)');
            },
            error: function () {
                console.log('Не то!');
            }
        });
    })




    /*-------------  tree  ---------------*/
    $('.trees').click(function(event) {
        event.preventDefault();

        var cat = $(this).attr("href"); //Получить текст ссылки
        $('select').val(cat);
        /*alert(cat);*/
        $('#treeModal').modal('hide');
    });

    

    //-------- Modal Barcode view.blade ---------------
    $('td > .bar_link').click(function (event) {
        event.preventDefault();
        var id = $(this).data("id"); //Получить id строки.
        var href = $(this).text(); //Получить текст ссылки.
        
        $('#bar1').val(href); //Ввести штрих-код в input 
        var f = $('#form_bar').attr("action"); //получить адресную строку
        var str = f.substr(0, f.length - 2);   //обрезать параметр из шаблона(id)

        str = str + id;  // сформировать реальный адрес.
        $('#form_bar').attr("action", str); //вставить его в модальную форму.
    })

    /*-------------------------------------*/
    //при появлении модального окна выделить поле ввода input.
    $('#barcode').on('shown.bs.modal', function() {
        $('#bar1').select();
    })
    $('#barModal2').on('shown.bs.modal', function() {
        var f = $("input[name='barcode']").val();
        $('#bar3').val(f);
        $('#bar3').select();
    })


    

    /*-------------  Modal Barcode create.blade  ---------------*/
    $('#bar2').keyup(function (e) {
        if (e.keyCode == 13) {
            var f = $('#bar2').val();
            $("input[name='barcode']").val(f);
            $('#barModal').modal('hide');

        }
    })
     /*-------------------- key press button "Close"  -------------------------*/
    $('#bmw1').click(function (event) {
        event.preventDefault();

        var f = $('#bar2').val();
        $("input[name='barcode']").val(f);

    })



    /*-------------  Modal Barcode edit.blade  ---------------*/
    $('#bar3').keyup(function (e) {
        if (e.keyCode == 13) {
            var f = $('#bar3').val();
            $("input[name='barcode']").val(f);
            $('#barModal2').modal('hide');

        }
    })

    /*-------------------- key press button "Close"  -------------------------*/
    $('#bmw2').click(function (event) {
        event.preventDefault();

        var f = $('#bar3').val();
        $("input[name='barcode']").val(f);

    })

//-------- Modal edit2 ---------------
    $('td > .edit2').click(function (event) {
        event.preventDefault();
        var id = $(this).data("id"); //Получить id строки.

        $('#group2').val($(this).data("group")); //Ввести группу в input
        $('#title2').val($(this).data("title")); //Ввести группу в input
        $('#text2').val($(this).data("note")); //Ввести группу в input

        var f = $('#form_edit2').attr("action"); //получить адресную строку

        var str = f.substr(0, f.length - 2);   //обрезать параметр из шаблона(-1)
        str = str + id;  // сформировать реальный адрес.
        $('#form_edit2').attr("action", str); //вставить его в модальную форму.

    })


})