<script>
    $('#submit-new-info').click(function (){

        var name = $('#name').val();
        var lastName = $('#last_name').val();
        var city = $('#city').val();
        var dob = $('#DOB').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var rise = $('#rise').val();
        var weight = $('#weight').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('user.profile.update',auth()->user()->id)}}",
            type: 'PATCH',
            data: {
                name: name,
                lastName:lastName,
                city:city,
                dob:dob,
                email:email,
                phone:phone,
                rise:rise,
                weight:weight
            },
            dataType: 'json',
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

</script>
