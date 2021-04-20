<script>
    $(document).ready(function (){

        function send(page, sort){
            $.ajax({
                url: '{{route('meet.filter')}}?page='+page,
                type: 'get',
                data: {
                    sorting: sort,
                },
                dataType: 'json',
                success: function (responce) {
                    $('.meets').empty().html(responce);
                },
                error: function (responce) {
                    console.log(responce);
                }
            });
        }

        $('#sort-meet').on('change',function (){
            var sorting = $(this).val();
            var page = $('#hidden_page').val();
            send(page, sorting);
        });

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);

            var sorting = $('#sort-meet').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            send(page, sorting);
        });
    })

</script>
