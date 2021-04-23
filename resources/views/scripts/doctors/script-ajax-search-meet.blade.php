<script>
    $(document).ready(function (){

        function fetch_data(page, status, query)
        {
            var docId = {{auth()->user()->id}}
            $.ajax({
                url: '{{route('meet.filter.doc')}}?page='+page,
                type: 'get',
                data: {
                    query: query,
                    status: status,
                    docId:docId,
                },
                dataType: 'json',
                success: function (responce) {
                    $('#data-meet').empty().html(responce);
                },
                error: function (responce) {
                    console.log(responce);
                }
            });
        }
        $('#select-status').on('change',function (){
            var page = $('#hidden_page').val();
            var query = $('#patient-search').val();
            var status = $(this).val();
            fetch_data(page,status,query);
        });
        $('#patient-search').on('keyup',function (){
            var page = $('#hidden_page').val();
            var query = $(this).val();
            var status = $('#select-status').val();
            fetch_data(page,status,query);
        });
    });
    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);

        var query = $('#patient-search').val();
        var status = $('#select-status').val();

        $('li').removeClass('active');
        $(this).parent().addClass('active');
        fetch_data(page,status,query);
    });
</script>
