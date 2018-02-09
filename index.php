<html>
<head>
    <title>Tecтовoe задание</title>
</head>

<body>

<form action="includes/submit_handler.php" method="post" id="our-form">

    <input name="search-client" type="text" id="search-box" list="search-results" placeholder="Название клиента"/>
    <datalist id="search-results"></datalist>
    <div class="form-error"></div>
    <br>
    <b> Status:</b>
    <br>
    <input type="checkbox" name="checkboxvar[]" value="work">work<br>
    <input type="checkbox" name="checkboxvar[]" value="connecting"> connecting<br>
    <input type="checkbox" name="checkboxvar[]" value="disconnected"> disconnected <br>
    <input type="submit" value="отправить">
</form>
<div id="card-container"></div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $("#search-box").on('keyup', function (e) {
        $.ajax({
            type: "POST",
            url: "includes/autocomplete_handler.php",
            data: 'keyword=' + $(this).val(),
            success: function (data) {
                $("#search-results").empty().html(data);
            }
        });
    });
</script>

<script>
    $(document).ready(function () {

        var form = $('#our-form');
        form.submit(function (e) {
            $('#card-container').html('');
            e.preventDefault();
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                success: function (data) {
                    var data = typeof data == 'string' ? $.parseJSON(data) : data;
                    if (data.result === 'success') {
                        var html = '';
                        $.each(data.cards, function (i, ob) {
                            html += '<table id="client-card-' + i +'">' +
                                    '<tr> <td colspan="2"><b>Информация про клиента</b></td> </tr>' +
                                '<tr>  <td>Название клиента</td> <td>' +ob.name_customer + '</td> </tr>' +
                                '<tr>  <td>Компания</td> <td>' + ob.company +'</td> </tr>' +
                                '<tr> <td colspan="2"><b>Информация про договор</b></td> </tr>' +
                                '<tr>  <td>Номер Договора</td> <td>' +ob.id_contract + '</td> </tr>' +
                                '<tr>  <td>Дата подписания</td> <td>' + ob.date_sign +'</td> </tr>' +

                                '<tr> <td colspan="2"><b>Информация про сервисы</b></td> </tr>' +
                                '<tr>  <td>Название сервиса</td> <td>' +ob.title_service + '</td> </tr>' +
                                '<tr>  <td>Статус</td> <td>' + ob.status +'</td> </tr> <br> <br>';

                        });
                        $('#card-container').html(html);
                    }
                    else {
                        alert(data.text_error);
                    }
                }
            });
            return false;
        });
    })
</script>
