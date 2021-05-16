<!-- MultiStep Form -->
<title>Регістрація</title>
<link href="/auth/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/auth/auth.css">
<div class="page-header text-center">
    <h1 >Create your account</h1>
</div>

<div class="container col-md-offset-3">

    <div class="modal fade" id="alert2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content bg-danger text-white">
                <div class="modal-body text-center">
                    <h3 class="text-white mb-15">Помилка</h3>
                    <span>Заповніть поля імені, прізвища, по-батькові, номер телефону та дату народження</span>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <form id="msform" action="{{route('register')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active">Personal Details</li>
                    <li>Parameters</li>
                    <li>Account Setup</li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                    <h2 class="fs-title">Personal Details</h2>
                    @foreach ($errors->all() as $message)
                        <span class="invalid-feedback color text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @endforeach
                    <input type="text" name="name" placeholder="Ім'я" value="{{ old('name') }}" required/>
                    <input type="text" name="last_name" placeholder="Прізвище" value="{{ old('last_name') }}" required/>
                    <input type="text" name="patronymic" placeholder="По-батькові"  value="{{ old('patronymic') }}" required/>
                    <input type="text" id="phone-mobile" name="phone" placeholder="+38"  value="{{ old('phone') }}" required/>
                    <input type="text" name="city" placeholder="Місто"  value="{{ old('city') }}"/>
                    <input type="text" name="address" placeholder="Адреса"  value="{{ old('address') }}"/>
                    <select name="male">
                        <option value="">Вибиріть свою стать</option>
                        <option value="Man">Чоловік</option>
                        <option value="Woman">Жінка</option>
                    </select>
                    <input type="date" name="DOB" class="ui-datepicker" placeholder="Дата народження"  value="{{ old('DOB') }}" required>
                    <input type="file" name="avatar" placeholder="Ваша фотокартка"  value="{{ old('avatar') }}">

                    <input type="button" name="next" class="next action-button" value="Далі"/>
                </fieldset>
                <fieldset>
                    <h3 class="fs-subtitle">Заповніть поля</h3>
                    <input type="text" name="rise" placeholder="Зріст" value="{{ old('rise') }}"/>
                    <input type="text" name="weight" placeholder="Вага" value="{{ old('weight') }}"/>
                    <input type="button" name="previous" class="previous action-button-previous" value="Назад"/>
                    <input type="button" name="next" class="next action-button" value="Далі"/>
                </fieldset>
                <fieldset>
                    <h2 class="fs-title">Створіть аккаунт</h2>
                    <h3 class="fs-subtitle">Заповніть поля</h3>
                    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required/>
                    <input type="password" name="password" placeholder="Пароль" required/>
                    <input type="password" id="password-confirm" name="password_confirmation" required autocomplete="new-password" placeholder="Підтвердіть пароль"/>
                    <input type="button" name="previous" class="previous action-button-previous" value="Назад"/>
                    <button type="submit" class="registration-button">
                        {{ __('Зареєструватись') }}
                    </button>
                </fieldset>
            </form>
            <!-- link to designify.me code snippets -->
            <div class="dme_link">
                <p><a href="{{route('root')}}">Go Back</a></p>
            </div>

            <!-- /.link to designify.me code snippets -->
        </div>
    </div>

</div>
<!-- /.MultiStep Form -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src="/auth/bootstrap/js/bootstrap.min.js"></script>
<script src="/auth/auth.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    $('#phone-mobile').mask("+389999999999");




</script>


