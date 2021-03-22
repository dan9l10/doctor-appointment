<!-- MultiStep Form -->

<link href="/auth/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/auth/auth.css">
<div class="page-header text-center">
    <h1 >Create your account</h1>
</div>

<div class="container col-md-offset-3">


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
                    <input type="text" name="name" placeholder="First Name" value="{{ old('name') }}"/>
                    <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}"/>
                    <input type="text" name="patronymic" placeholder="Patronymic "  value="{{ old('patronymic') }}"/>
                    <input type="text" name="phone" placeholder="Phone"  value="{{ old('phone') }}"/>
                    <input type="text" name="city" placeholder="City"  value="{{ old('city') }}"/>
                    <input type="text" name="address" placeholder="Address"  value="{{ old('address') }}"/>
                    <select name="male">
                        <option value="">Select your male</option>
                        <option value="Man">Man</option>
                        <option value="Woman">Woman</option>
                    </select>
                    <input type="date" name="DOB" class="ui-datepicker" placeholder="Date of birth"  value="{{ old('DOB') }}">
                    <input type="file" name="avatar" placeholder="Select photo"  value="{{ old('avatar') }}">

                    <input type="button" name="next" class="next action-button" value="Next"/>
                </fieldset>
                <fieldset>
                    <h3 class="fs-subtitle">Fill in your credentials</h3>
                    <input type="text" name="rise" placeholder="Rise" value="{{ old('rise') }}"/>
                    <input type="text" name="weight" placeholder="Weight" value="{{ old('weight') }}"/>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                    <input type="button" name="next" class="next action-button" value="Next"/>
                </fieldset>
                <fieldset>
                    <h2 class="fs-title">Create your account</h2>
                    <h3 class="fs-subtitle">Fill in your credentials</h3>
                    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}"/>
                    <input type="password" name="password" placeholder="Password"/>
                    <input type="password" id="password-confirm" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"/>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                    <button type="submit" class="btn">
                        {{ __('Register') }}
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

