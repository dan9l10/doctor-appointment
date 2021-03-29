<script type="text/javascript">
    $(document).ready(function (e) {

        $('.information').click(function (){
            $('.button').removeClass('active');
            $(this).addClass('active');
            $('.profile-info').addClass('hidden');
            $('.information-profile').removeClass('hidden');
        })

        $('.appointment').click(function (){
            $('.button').removeClass('active');
            $(this).addClass('active');
            $('.profile-info').addClass('hidden');
            $('.appointment-info').removeClass('hidden');
        })
    });
</script>
