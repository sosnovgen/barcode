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

        var id = $(this).attr("href"); //Получить id товара из таб. "article"
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

//---------- Сумма товара --------------
    //При изменении поля INPUT менять поле "Сумма"
    $('td > input').change(function (event) {

        var kol = $(this).val(); //шт.
        var cena = $(this).parent().prev().text();    //цена товара.
        var summ = $(this).parent().next().text(kol * cena); //изменить сумму.
        var id = $(this).parent().siblings().eq(0).text(); //ID товара

        $("input[name='bar']").select(); //фокус на input.

        var token = $('#token-keeper7').data("token");
        var href = 'count/' + id + '/' + kol; //Сформировать ссылку.

        $.ajax({
            type: "POST",
            url: href,
            data: {id: 'id', kol: 'kol', '_token': token, '_method': "POST"},

            success: function () {
                console.log('Успешно! (shange)')
            },

            error: function () {
                console.log('Не получилось! (shange)')
            } // в консоле  отображаем информацию об ошибке


        })

        calc_summ();//Вывести сумму выбранного товара.
    })

    //При изменении поля SELECT фокус на input.
    $('select').change(function (event) {

        $("input[name='bar']").select();
    })

//---------- Подсчёт суммы при загрузке ---------------
    $('table').ready(function () {
        calc_row(); //Вывести сумму по строке
        calc_summ();//Вывести общую сумму
    });

    //---------- Подсчёт суммы в строке ---------------
    //Здесь используется цикл ".each"
    function calc_row() {
        $('td > input').each(function (indx, element) {
            var kol = $(element).val(); //шт.
            var cena = $(element).parent().prev().text();    //цена товара.
            var summ = $(element).parent().next().text(kol * parseInt(cena)); //изменить сумму.
        })
    }

    //---------- Подсчёт и вывод суммы выбранного товара --------------
    function calc_summ() {

        var sus = [];  // переменная, которая будет хранить содержимое ячеек с ценой (с учётом кол.)

        $('.summ_row').each(function (indx, element) { //записать в массив.
            sus.push(parseInt($(element).text()));  //переведя в чифру.
        });


        //Используя цикл "reduce" подсчитать сумму по столбцу "Сумма".
        var result = sus.reduce(function (sum, current) {
            return sum + current;
        }, 0);
        $('.price_summ').html(result); //Вывести результат.
        //alert( result );
    }


    //------------- Удаление товара из корзины ----------------------
    $('td > .cart_delete').click(function (event) {

        var id = $(this).attr("onclick"); //Получить ID товара.
        var _parent = $(this).parent().parent();
        var href = '../del/' + id; //Сформировать ссылку для AJAX
        var token = $('#token-keeper_4').data("token");

        confirm_var = confirm('Удалить товар?'); //запрашиваем подтверждение на удаление
        if (!confirm_var) {
            return false;
        }

        $.ajax({
            type: "POST",
            url: href,
            data: {id: 'id', '_token': token, '_method': "POST"},

            success: function () {

                var len = $('#token-keeper_4 tr').size();
                if (len == 2) {
                    window.location.href = "javascript:history.back()"
                }
                else {
                    _parent.remove(); // удаляем строчку tr из таблицы
                    calc_summ();//Вывести общую сумму
                }
                console.log('Успешно! (delete)');
            },
            error: function () {
                console.log(msg);
            } // в консоле  отображаем информацию об ошибки, если они есть

        });

    })

    /*--------------------- DatePicker  ----------------------*/




})