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
    <input type="checkbox" name="checkboxvar[]" value="connected"> connected<br>
    <input type="checkbox" name="checkboxvar[]" value="disconnected"> disconnected <br>
    <input type="submit" value="отправить">
</form>
<?php include 'includes/card.php'; ?>
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
            e.preventDefault();
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                success: function (data) {
                    var data = typeof data == 'string' ? jQuery.parseJSON(data) : data;
                    if (data.result === 'success') {
                        alert('Есть такой клиент!');
                        $('#client-card').show();
                    } else {
                        alert('Такого клиента нет!');
                    }
                }
            });
            return false;
        });
    })
</script>
