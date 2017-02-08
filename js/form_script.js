/**
 * Created by gektorgit on 31.01.17.
 */
//при нажатии на кнопку с id="confirm"
$(function () {
    $('#confirm').click(function () {
        //переменная formValid
        formValid = true;

        //перебрать все элементы управления input
        $('.input-group-addon').children().each(function () {
            //найти предков, которые имеют класс .form-group, для установления success/error
            var formGroup = $(this).parents('.form-group');
            //найти glyphicon, который предназначен для показа иконки успеха или ошибки
            var glyphicon = formGroup.find('.form-control-feedback');
            //для валидации данных используем HTML5 функцию checkValidity
            if (this.checkValidity()) {
                //добавить к formGroup класс .has-success, удалить has-error
                formGroup.addClass('has-success').removeClass('has-error');
                //добавить к glyphicon класс glyphicon-ok, удалить glyphicon-remove
                glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
            } else {
                //добавить к formGroup класс .has-error, удалить .has-success
                formGroup.addClass('has-error').removeClass('has-success');
                //добавить к glyphicon класс glyphicon-remove, удалить glyphicon-ok
                glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
                //отметить форму как невалидную
                formValid = false;
            }
        });
        //если форма валидна, то
        if (formValid) {
            return true;
        }
    });

    // Загрузка окна предпросмотра
    $('button#modal').click(function () {
        console.log($('#img').val());
        $('#modal_name').val($('#name').val());
        $('#modal_mail').val($('#mail').val());
        $('#modal_descr').val($('#descr').val());
        //$('img#modal_img').attr('src', $('#img').val());
    });

    $('#save').click(function() {
        var formValid = true;

        $('.input-group').find('input').each(function() {
            var formGroup = $(this).parents('.form-group');
            var glyphicon = formGroup.find('.form-control-feedback');
            if (this.checkValidity() && $(this).val() == 'admin' || $(this).val() == '123') {
                formGroup.addClass('has-success').removeClass('has-error');
                glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
            } else {
                formGroup.addClass('has-error').removeClass('has-success');
                glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
                formValid = false;
            }
        });
        if (formValid) {
            $('#SignModal').modal('hide');
            $('#success-alert').removeClass('hidden');
        }
    });

    // Сортировка
    $('.sort button').click(function () {
        var id = $(this).attr('id');
        var sort_id;

        if($(this).attr('class').split(' ').length == 4){
            sort_id = 'sort_id='+id+'_a';
        }else
            sort_id = 'sort_id='+id+'_d';
        $('#fon').css({'display':'block'});
        $('#load').fadeIn(1000,function () {
            $.ajax({
                url:$(this).parent().attr('id'),
                data:sort_id,
                type:'get',
                success:function (html) {

                    $('#task').html(html).hide().fadeIn(1000);
                    $('#fon').css({'display':'none'});
                    $('#load').fadeOut(1000);
                }

            });
        });
    });

    // Выход админа
    $('#signOut').click(function(){
        $.ajax({
            url:'signOut',
            data:'out',
            type:'get',
            success:function (html) {
                location.reload(true)

            }
        });
    });

});
