<script>
    $(document).ready(function () {
        // Listen for 'change' event, so this triggers when the user clicks on the checkboxes labels
        $('.special_checkbox').on('change', function (e) {
            var specials = [];
            e.preventDefault();
            $('input[name="special[]"]:checked').each(function () {
                specials.push($(this).val());
            });
            console.log(specials);
            send(specials);
        });
    });
    function send(specials){
        $('#doc_card').empty();
        $.ajax({
            url: "{{route('doctor.update')}}",
            type: 'GET',
            data: {
                specials: specials,
            },
            dataType: 'json',
            success: function (responce) {
                var userId = {{auth()->user()->id}};
                if(isNaN(responce)){
                    $('#doc_card').empty();
                    $.each(responce, function (index, element) {
                        $('#doc_card').append(`
                            <div class="container-card col-md-10 col-md-offset-2">
                                <div class="card-doc">
                                    <img src="${(element.avatar)? element.avatar: 'https://html5css.ru/howto/img_avatar2.png' }" alt="Avatar" style="width: 65%; margin: 5px">
                                    <div class="container-card-info">
                                        <h4><b>${element.user.name} ${element.user.last_name} ${element.user.patronymic}</b></h4>
                                        <p>${element.user.email}</p>
                                        <p>${element.specials.name}</p>
                                        ${(!(element.user.id===userId))?'<a href="" class="btn btn-info">Записаться</a>':''}
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                }
            },
            error: function () {
                console.log('error');
            }
        });
    }

</script>
