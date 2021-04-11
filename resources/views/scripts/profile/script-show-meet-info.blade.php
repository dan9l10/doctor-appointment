<script>
    function getDataMeet($this){
        var id = $this.attr('id')
        console.log(id);
        $.ajax({
            url: '/meet/'+id,
            type: 'GET',
            data: {
                id:id
            },
            dataType: 'json',
            success: function (data) {
                $('.appointment-info').addClass('hidden');
                $('.information-profile').removeClass('hidden').empty().append(`
                        <div class="panel-body bio-graph-info">
                            <div class="row">
                                <p class="col-md-6"><b>Дата: </b>${data.date}</p>
                                <p class="col-md-6"><b>Лікар: </b>${data.doctor.name} ${data.doctor.last_name} ${data.doctor.patronymic}</p>
                            </div>
                            <div class="row">
                                <p class="col-md-6"><b><i class="fa fa-clock-o" aria-hidden="true"></i> Час: </b>${data.times.time}</p>
                                <p class="col-md-6"><b>Cтатус: </b>${(data.status)? 'Завершено': 'Очікується'}</p>
                            </div>
                        </div>
                        <div class="panel-body bio-graph-info">
                            <div class="row">
                                <p class="col-md-12"><b>Скрага: </b>${data.complaint}</p>
                            </div>
                            <div class="row">
                                <p class="col-md-12"><b>Діагноз: </b>${(data.diagnosis)? data.diagnosis : 'Діагнозу не проставлено'}</p>
                            </div>
                        </div>

                    `);
                if (data.status){
                    $('.information-profile').append(`<div class="col-md-offset-7"><div class="row"><a onclick="back()" class="btn ml-2"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Повернутись назад</a> <a href="" class="btn btn-primary">Записатися повторно</a></div></div>`)
                }else{
                    $('.information-profile').append(`<div class="col-md-offset-9"><div class="row"><a onclick="back()" class="btn ml-2"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Повернутись назад</a></div></div>`)
                }

            },
            error: function (data) {
                console.log(data);
            }
        });

    }
    function back(){
        // $('.back-link').on('click',function (){
        $('.information-profile').addClass('hidden');
        $('.appointment-info').removeClass('hidden');
        /* });*/
    }
</script>
