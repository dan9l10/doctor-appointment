<script>
    function fetch_customer_data(query = '')
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"{{ route('doctor.search') }}",
            method:'GET',
            data:{query:query},
            dataType:'json',
            success:function(responce)
            {
                var userId = {{auth()->user()->id}};
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
                                        ${(!(element.user.id===userId))?'<a href="/appointments/'+element.user.id+'"class="btn btn-info">Записаться</a>':''}
                                    </div>
                                </div>
                            </div>
                        `);
                });
                console.log(responce);
            }
        })
    }

    $(document).ready(function (){
        $('#search-doc').on('keyup',function (){
            var query = $(this).val();
            fetch_customer_data(query);
        });

    });
</script>
