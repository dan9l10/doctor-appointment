<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');
    *{
        font-family: 'Open Sans', sans-serif;
    }
    .left{
        display:flex;
        justify-content:flex-end;
    }
    .container{
        margin: auto;
        width: 50%;
        border: 3px solid #77a9f3;
        padding: 10px;
        border-radius: 10px;
    }
    .heading{
        text-align:center;
        border-bottom:1px solid #77a9f3;
    }
    .diagnosis{
        display:flex;
        margin-top:5px;
        padding:10px;
        border-radius:5px;
        border:1px solid #77a9f3;
    }
    .diagnosis-heading{
        border-right: 2px solid #77a9f3;
    }
    .diagnosis-heading h3{
        margin: 5px;
    }
    .diagnosis-description span{
        margin:10px;
        text-align:center;
    }
    .complaint{
        margin-bottom: 20px;
    }
</style>
<div class="container">
    <div class="left">
        <div>
            <span><b>Пацієнт: </b></span>
            <span>{{$data['user_data']}}</span>
        </div>
    </div>
    <div class="left">
        <div>
            <span><b>Доктор:</b></span>
            <span>{{$data['doctor_data']}}</span>
        </div>
    </div>
    <h1 class="heading">Висновок</h1>
    <div class="description">
        <div class="complaint">
            <h3><b>Скарга:</b></h3>
            <span>{{$data['complaint']}}</span>
        </div>
        <div class="diagnosis">
            <div class="diagnosis-heading">
                <h3><b>Діагноз:</b></h3>
            </div>
            <div class="diagnosis-description">
                <span>{{$data['diagnosis']}}</span>
            </div>
        </div>
        <h3><b>Препарати:</b></h3>
        <ul>
            @foreach($data['pills'] as $pills)
                <li>{{$pills}}</li>
            @endforeach
        </ul>
    </div>
    <div class="diagnosis">
        <div class="diagnosis-heading">
            <h3><b>Рекомендації:</b></h3>
        </div>
        <div class="diagnosis-description">
            <span>{{$data['recommendation']}}</span>
        </div>
    </div>
</div>
