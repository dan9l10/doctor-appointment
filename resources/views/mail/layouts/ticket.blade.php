<meta charset="UTF-8">
<style>
    *{
        margin-top: 5px;
        font-size: 15px;
    }
</style>
<table border="1">
    <tr>
        <td>Врач</td><td>{{$data['doctor_name']}} {{$data['doctor_lastname']}} {{$data['doctor_patronymic']}}</td>
    </tr>
    <tr>
        <td>Дата</td><td>{{$data['date']}}</td>
    </tr>
    <tr>
        <td>Время</td><td>{{$data['time']}}</td>
    </tr>
    <tr>
        <td>Должность</td><td>{{$data['doctor_special']}}</td>
    </tr>
    <tr>
        <td>Названная причина обращения</td><td>{{$data['complaint']}}</td>
    </tr>
</table>
