<html>
<head>
    <title>Tecтовoe задание</title>
</head>

<body>
<?php include 'includes/form.php'; ?>
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
            $(".form-error").hide().html('');
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data : form.serialize(),
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        //успех

                    } else {

                        $(".form-error").show();
                        printErrorMessages(data.error);
                    }
                }
            });
            return false;
        });
    } )
</script>
