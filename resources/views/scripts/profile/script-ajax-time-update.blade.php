<script type="text/javascript">
    function refresh(id) {
        var date = $("#date-picker").val();
        $.ajax({
            url: "{{route('time.update')}}",
            type: 'GET',
            data: {
                date: date,
                id: id
            },
            dataType: 'json',
            success: function (data) {
                $('#times').empty();
                $.each(data, function (index, element) {
                    $.each(element.times, function (index, element) {
                        if (element.status === 1) {
                            $('#times').append($('<label class="btn btn-primary disabled"><input type="radio" name="time" id="time" disabled>' + element.time + '</label>'));
                        } else {
                            $('#times').append($('<label class="btn btn-primary"><input type="radio" name="time" id="time" value="' + element.id + '">' + element.time + '</label>'));
                        }

                    });
                });
            },
            error: function () {
                console.log('error');
            }
        });
    }
</script>
