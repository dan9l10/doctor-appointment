@extends('hospital.layouts.app')

@section('content')
    <section id="home" class="slider" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">

                <div class="owl-carousel owl-theme">
                    <div class="item item-first">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>Зробимо ваше життя кращим</h3>
                                <h1>Healthy Living</h1>
                                <a href="#team" class="section-btn btn btn-default smoothScroll">Записатися до наших лікарів</a>
                            </div>
                        </div>
                    </div>

                    <div class="item item-second">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>COVID-19</h3>
                                <h1>Статистика Укаїни</h1>
                                <a href="https://covid19.rnbo.gov.ua/" class="section-btn btn btn-default btn-gray smoothScroll">Інформація</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-6">
                    <div class="about-info">
                        <h2 class="wow fadeInUp" data-wow-delay="0.6s">Ласкаво просимо до вашого <i class="fa fa-h-square"></i>ealth Center</h2>
                        <div class="wow fadeInUp" data-wow-delay="0.8s">
                            <p> - Онлайн-консультації.</p>
                            <p> - Прийоми в лікарні.</p>
                        </div>
                        <figure class="profile wow fadeInUp" data-wow-delay="1s">
                            <img src="/home/images/author-image.jpg" class="img-responsive" alt="">
                            <figcaption>
                                <h3>Neil Jackson</h3>
                                <p>Генеральний директор</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- TEAM -->
    <section id="team" data-stellar-background-ratio="1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="about-info">
                        <h2 class="wow fadeInUp" data-wow-delay="0.1s">Наші лікарі</h2>
                    </div>
                </div>
                <div class="clearfix"></div>
                @foreach($doctors as $doctor)
                <div class="col-md-4 col-sm-6">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                        <img src="{{is_null($doctor->members->avatar)? "/home/images/team-image1.jpg": $doctor->members->avatar }}" class="img-responsive" alt="">
                        <div class="team-info">
                            <h3>{{$doctor->name}} {{$doctor->last_name}} {{$doctor->patronymic}}</h3>
                            @foreach($doctor->specials as $special)
                            <p>{{$special->name}}</p>
                            @endforeach
                            <div class="team-contact-info">
                                <p><i class="fa fa-phone"></i> {{$doctor->members->phone}}</p>
                                <p><i class="fa fa-envelope-o"></i> <a href="#">{{$doctor->email}}</a></p>
                            </div>
                            <ul class="social-icon">
                                <li><a href="{{route('appointment.index',$doctor->members->id)}}" class="fa fa-pencil"></a></li>
                                <li><a href="#" class="fa fa-envelope-o"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('google_map')
    @include('hospital.layouts.map')
@endsection
@section('pre_footer')
    @include('hospital.layouts.pre_footer')
@endsection
