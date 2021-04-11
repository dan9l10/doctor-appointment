<script type="text/javascript">
    $(document).ready(function (e) {

        $('.information').click(function (){
            $('.button').removeClass('active');
            $(this).addClass('active');
            $('.profile-info').addClass('hidden');
            $('.information-profile').removeClass('hidden').html('<div class="panel-body bio-graph-info">\n' +
                '                            <h1>Особиста інформація</h1>\n' +
                '                            <div class="row">\n' +
                '                                <div class="bio-row">\n' +
                '                                    <p><span><b>Ім"я </b> </span>: {{$userInfo->user->name}}</p>\n' +
                '                                </div>\n' +
                '                                <div class="bio-row">\n' +
                '                                    <p><span><b>Прізвище</b> </span>: {{$userInfo->user->last_name}}</p>\n' +
                '                                </div>\n' +
                '                                <div class="bio-row">\n' +
                '                                    <p><span><b>Адреса</b> </span>: {{$userInfo->city}} {{$userInfo->address}}</p>\n' +
                '                                </div>\n' +
                '                                <div class="bio-row">\n' +
                '                                    <p><span><b>Дата народження</b></span>: {{$userInfo->DOB}}</p>\n' +
                '                                </div>\n' +
                '                                <div class="bio-row">\n' +
                '                                    <p><span><b>Email</b> </span>: {{$userInfo->user->email}}</p>\n' +
                '                                </div>\n' +
                '                                <div class="bio-row">\n' +
                '                                    <p><span><b>Мобільний телефон</b> </span>: {{$userInfo->phone}}</p>\n' +
                '                                </div>\n' +
                '                                <div class="bio-row">\n' +
                '                                    <p><span><b>Вага</b> </span>: {{$userInfo->rise}}</p>\n' +
                '                                </div>\n' +
                '                                <div class="bio-row">\n' +
                '                                    <p><span><b>Зріст</b> </span>: {{$userInfo->weight}}</p>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>')
        });

        $('.appointment').click(function (){
            $('.button').removeClass('active');
            $(this).addClass('active');
            $('.profile-info').addClass('hidden');
            $('.appointment-info').removeClass('hidden');
        });

        $('.edit-information').click(function (){
            $('.button').removeClass('active');
            $(this).addClass('active');
            $('.profile-info').addClass('hidden');
            $('.information-profile').removeClass('hidden').html('<div class="panel-body bio-graph-info">\n' +
                '                            <h1>Введіть нові дані</h1>\n' +
                '                            <div class="row">\n' +
                '                                <form>\n' +
                '                                    <div class="bio-row">\n' +
                '                                        <label for="name">Iм"я</label> <input type="text" id="name" class="form-control col-md-3" value="{{$userInfo->user->name}}">\n' +
                '                                    </div>\n' +
                '                                    <div class="bio-row">\n' +
                '                                        <label for="last_name">Прізвище</label> <input type="text" id="last_name" class="form-control col-md-3" value="{{$userInfo->user->last_name}}">\n' +
                '                                    </div>\n' +
                '                                    <div class="bio-row">\n' +
                '                                        <label for="city">Місто</label> <input type="text" id="city" class="form-control col-md-3" value="{{$userInfo->city}}">\n' +
                '                                    </div>\n' +
                '                                    <div class="bio-row">\n' +
                '                                        <label for="DOB">Дата народження</label> <input type="date" id="DOB" class="form-control col-md-3" value="{{$userInfo->DOB}}">\n' +
                '                                    </div>\n' +
                '                                    <div class="bio-row">\n' +
                '                                        <label for="email">Email</label> <input type="text" id="email" class="form-control col-md-3" value="{{$userInfo->user->email}}">\n' +
                '                                    </div>\n' +
                '                                    <div class="bio-row">\n' +
                '                                        <label for="phone">Мобільний телефон</label> <input type="text" id="phone" class="form-control col-md-3" value="{{$userInfo->phone}}">\n' +
                '                                    </div>\n' +
                '                                    <div class="bio-row">\n' +
                '                                        <label for="rise">Зріст</label> <input type="text" id="rise" class="form-control col-md-3" value="{{$userInfo->rise}}">\n' +
                '                                    </div>\n' +
                '                                    <div class="bio-row">\n' +
                '                                        <label for="weight">Вага</label> <input type="text" id="weight" class="form-control col-md-3" value="{{$userInfo->weight}}">\n' +
                '                                    </div>\n' +
                '                                    <div class="form-group col-md-6">\n' +
                '                                        <a class="btn btn-primary" id="submit-new-info">Submit</a>\n' +
                '                                    </div>\n' +
                '                                </form>\n' +
                '                            </div>\n' +
                '                        </div>');
        });

    });
</script>
