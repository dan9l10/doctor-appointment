<script>

    $(document).ready(function(){

        var specials = [];

        $('.special_checkbox').on('change', function (e) {
            pushChecked();
        });

        function pushChecked(){
            specials = [];
            var query = $('#search-doc').val();
            var page = $('#hidden_page').val();
            $('input[name="special[]"]:checked').each(function () {
                specials.push($(this).val());
            });
            fetch_data(page, specials, query);
        }

        function fetch_data(page, specials, query)
        {
            $.ajax({
                url: '{{route('doctor.update')}}?page='+page,
                type: 'get',
                data: {
                    query: query,
                    specials: specials,
                },
                dataType: 'json',
                success: function (responce) {
                    $('#doc_card').empty().html(responce);
                },
                error: function (responce) {
                    console.log(responce);
                }
            });
        }

        $('#search-doc').on('keyup', function(){
            var query = $(this).val();
            var page = $('#hidden_page').val();
            fetch_data(page, specials, query);
        });

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);

            var query = $('#search-doc').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data(page, specials, query);
        });
    })
</script>
