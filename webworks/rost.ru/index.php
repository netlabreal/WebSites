<!DOCTYPE html>
<html lang="en">
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mreal.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <title>Агенство недвижимости ОСТ. Недвижимость г.Находки.</title>
    <meta name="keywords" content="купить квартиру, продать квартиру , Недвижимость г.Находки, Агенство недвижимости ОСТ">
    <meta name="description" content="Агенство недвижимости ОСТ: покупка, продажа недвижимости в г.Находка">
</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top" id="menu">
    <div class="container-fluid">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Open navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="row">
            <div class="col-md-4 col-xs-4 col-sm-4">
                <a class="navbar-brand" href="index.php"><img src="img/logo.png"></a>
            </div>

            <div class="col-md-8 col-xs-8 col-sm-8">
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="index.php">Главная</a></li>
                        <li ><a href="objects.php">Недвижимость</a></li>
                        <li ><a href="uslugi.php">Наши услуги</a></li>
                        <li ><a href="info.php">Полезная информация</a></li>
                        <li ><a href="about.php">Контакты</a></li>
                    </ul>
                </div>
            </div>

        </div>


    </div>
</nav>


<div class="container-fluid" id="main_content">
    <div class="row">

        <div class="col-md-8 col-xs-12 col-sm-12" id="carusel">

            <div class="realcarusel">
                <div id="myCarousel2" class="carousel slide" data-interval="3000" data-ride="carousel">
                    <div class="carousel-inner" id="r_carusel">
                        <div class="active item">
                            <div id="rrr">
                                <img class="img-responsive" src="img/slide-1.jpg">
                                <div class="panel" id="inside">
                                    <a href="#">Ипотека под 14% годовых!</a>
                                </div>
                            </div>

                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/slide-2.jpg">
                            <div class="panel" id="inside">
                                Мифы на раз, два, три. Рейтинг популярных мифов<br><br>
                                <a href="#">Как определить надежность агентства недвижимости: рейтинг популярных мифов. </a>
                            </div>

                        </div>
                        <div class="item">
                            <img class="img-responsive" src="img/slide-3.jpg">
                            <div class="panel" id="inside">
                                Как правильно купить квартиру на вторичном рынке<br><br>
                                <a href="#">Покупка квартиры является хлопотным делом, а порой и довольно рискованным.  </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <ol class="breadcrumb"><li>Спецпредложения</li></ol>
            <div class="spec">

            </div>


        </div>

        <div class="col-md-4 col-xs-12 col-sm-12" id="dop_menu">
            <div class="panel panel-default">
                <div class="panel-heading">Поиск недвижимости</div>
                <div class="panel-body">
                    <select class="form-control input-sm" id="tp" >
                        <option selected>-Тип операции-</option>
                    </select>
                    <select class="form-control input-sm" id="tip" >
                        <option selected disabled>Выберите тип недвижимости</option>
                    </select>
                    <select class="form-control input-sm" id = "rayon">
                        <option selected disabled>Выберите район</option>
                    </select>
                    <button class="btn btn-primary btn-sm" id="b_search">Поиск</button>
                </div>
            </div>

            <div class="panel panel-default" id="r_imgtel">
                <img src="img/tel.png">
            </div>

            <div class="panel panel-default" id="r_img">
                <img src="img/VTB.png">
            </div>

        </div>

    </div>
</div>


<div class="navbar navbar-inverse navbar-fixed-bottom" id="footer">
<div class="container-fluid">
    <div class="row">

        <div class="col-md-4  col-xs-12 col-sm-12 hidden-sm hidden-xs">
            <div class="page-header" id="f_header" >Наш адрес
            </div>
            <div id ="textfooter_txt">
                <p>692900 Приморский край</p>
                <p>г.Находка, ул. Гагарина дом 8</p>
                <p>Телефон: (4236) 62-64-30</p>
            </div>
        </div>

        <div class="col-md-4  col-xs-12 col-sm-12">
            <div class="page-header" id="f_header">Мы в соцсетях
            </div>
            <i class="fa fa-facebook fa-3x"></i>
            <i class="fa fa-twitter fa-3x"></i>
            <br>
        </div>

        <div class="col-md-4  col-xs-12 ">
            <div class="page-header" id="f_header">Связаться с нами
            </div>
            <button class="btn btn-primary btn-sm" id="sendmess">Оставить сообщение</button>
        </div>


    </div>
</div>

    <div class="col-md-12  col-xs-12 col-sm-12 hidden-sm hidden-xs" id="foot">
        <div class='last'>
            <div id="last_txt"> Всё права защищены © <?echo date(Y)?> ОСТ - юридическое бюро недвижимости. </div>
            <div id="last_txt1"><a href="http://www.designedbylab.ru">Разработка @LAB </a></div>
        </div>
    </div>

</div>


<div class="modal fade" id="SendMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="m_head">
                Отправить сообщение
            </div>
            <div class="modal-body" id="m_body">
                <input type="text" class="form-control" id="yourname" placeholder="Введите Ваше имя">
                <input type="text" class="form-control" id="yourmale" placeholder="Введите Ваш телефон">
                <textarea rows="3" class="form-control" id='yourdata' placeholder="Текст Вашего сообщения"></textarea>
            </div>
            <div class="modal-footer" id="m_foot">
                <button class="btn btn-primary btn-sm" id="sendm">Оставить сообщение</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Pause" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img id="load" src="img/ajax-loader.gif" /><div class="load_txt"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ViewObject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="m_id"></div>
            <div class="modal-header" id="m_head1">

            </div>
            <div class="modal-body" id="m_body1">

            </div>
            <div class="modal-footer" id="m_foot1">

            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(function () {
        random();
        Initcarusel();

        $('[data-toggle="popover"]').popover({trigger:'hover'});

        $('.fa-twitter').click(function () {
            window.open('https://twitter.com/ostnakhodkar');
        });

        $('.fa-facebook').click(function () {
            window.open('https://www.facebook.com/%D0%9E%D0%A1%D0%A2-%D0%9D%D0%B0%D1%85%D0%BE%D0%B4%D0%BA%D0%B0-193393884327179/');
            //document.location.href ='https://www.facebook.com/%D0%9E%D0%A1%D0%A2-%D0%9D%D0%B0%D1%85%D0%BE%D0%B4%D0%BA%D0%B0-193393884327179/';
        });

        $('#sendmess').click(function(){
            $('#SendMessage').modal("show");
        });
        $('#sendm').click(function(){
            $('#SendMessage').modal("hide");
        })
        ////////////////////////////////////////////////////////////////
        $('#b_search').click(function(){
            tp1 = $('#tp').val();tip1 = $('#tip').val();rayon1 = $('#rayon').val();
            document.location.href ='objects.php?type='+tp1+'&tip='+tip1+'&rayon='+rayon1;
        });
        ////////////////////////////////////////////////////////////////


        getTdata();
        ////////////////////////////////////////////////////////////////
        function getTdata(){
            $.ajax({
                type:"POST",
                dataType: "json",
                url:"/inc/ind.php",
                data:{param:"1"},
                beforeSend: function (data) {
                    $('.load_txt').html("");
                    $('.load_txt').append("Подождите! Идет обработка данных!");
                    $('#Pause').modal({
                        keyboard: false,
                        backdrop: false
                    })
                    $('#Pause').modal("show");
                },
                success:function(data){
                    if(data[0].length!=0){
                        $('#tp').html("");
                        $('#tp').append("<option selected value='0'>-Тип операции-</option>");
                        for(var i = 0;i<data[0].length;i++)
                        {
                            $('#tp').append("<option value="+data[0][i]['id']+">"+data[0][i]['name']+"</option>");
                        }
                    }
                    else{
                        $('#tp').attr('disabled', true);
                    }
                    if(data[1].length!=0){
                        $('#tip').html("");
                        $('#tip').append("<option selected value='0'>-Тип недвижимости-</option>");
                        for(var i = 0;i<data[1].length;i++)
                        {
                            $('#tip').append("<option value="+data[1][i]['id']+">"+data[1][i]['name']+"</option>");
                        }
                    }
                    else{
                        $('#tip').attr('disabled', true);
                    }
                    if(data[2].length!=0){
                        $('#rayon').html("");
                        $('#rayon').append("<option selected value='0'>-Район недвижимости-</option>");
                        for(var i = 0;i<data[2].length;i++)
                        {
                            $('#rayon').append("<option value="+data[2][i]['id']+">"+data[2][i]['name']+"</option>");
                        }
                    }
                    else{
                        $('#rayon').attr('disabled', true);
                    }
                    $('#Pause').modal("hide");
                },
                error:function(result){
                    $('.load_txt').html("");
                    $('.load_txt').append("Произошла ошибка!!! Обратитесь к ресурсу чуть позже.");
                    $('#Pause').modal("hide");
                    $('#rayon').attr('disabled', true);$('#tip').attr('disabled', true);$('#tp').attr('disabled', true);
                }
            });
        }
        ////////////////////////////////////////////////////////////////
        function Initcarusel(){
            $.ajax({
                type:"POST",
                dataType: "json",
                url:"/inc/ind.php",
                data:{param:"randomnews"},
                beforeSend: function (data) {
                    $('.load_txt').html("");
                    $('.load_txt').append("Подождите! Идет обработка данных!");
                    $('#Pause').modal({keyboard: false,backdrop: false});
                    $('#Pause').modal("show");
                },
                success:function(data){
                    var x = 0;
                    $('#r_carusel').html('');
                    for(var i = 0;i<data.length;i++)
                    {
                        if(x!=0){
                            x += 1;
                            $('#r_carusel').append('<div class="item"><div id="rrr"><img class="img-responsive" src="img/slide-'+x+'.jpg">'+
                                    '<div class="panel" id="inside"><a href="info.php?nid='+data[i][0]+'">'+data[i][1]+'</a></div></div></div>');
                        }
                        if(x==0){
                            $('#r_carusel').append('<div class="active item"><div id="rrr"><img class="img-responsive" src="img/slide-1.jpg">'+
                                    '<div class="panel" id="inside"><a href="info.php?nid='+data[i][0]+'">'+data[i][1]+'</a></div></div></div>');
                            x = 1;
                        }
                    }

                },
                error:function(result){
                    $('.load_txt').html("");
                    $('.load_txt').append("Произошла ошибка!!! Обратитесь к ресурсу чуть позже.");
                    $('#Pause').modal("hide");
                }
            });


        };
        ////////////////////////////////////////////////////////////////
        //**************************************************//
        $('#sendm').click(function(){
            if($('#yourname').val()!="" && $('#yourmale').val()!="" && $('#yourdata').val()!="") {
                $.ajax({
                    type:"POST",
                    dataType: "json",
                    url:"/inc/ind.php",
                    data:{param:"5",name:$('#yourname').val(),tel:$('#yourmale').val(),txt:$('#yourdata').val()},
                    beforeSend: function (data) {
                        $('.load_txt').html("");
                        $('.load_txt').append("Подождите! Идет обработка данных!");
                        $('#Pause').modal({keyboard: false,backdrop: false});
                        $('#Pause').modal("show");
                    },
                    success:function(data){
                        $('.load_txt').html("");
                        $('.load_txt').append("Ваша сообщение отправлено!");
                        $('#yourname').val("");$('#yourmale').val("");$('#yourdata').val("");
                        setTimeout(function () {$('#Pause').modal("hide");},1000);
                    },
                    error:function(result){
                        $('.load_txt').html("");
                        $('.load_txt').append("Произошла ошибка!!! Обратитесь к ресурсу чуть позже.");
                        $('#Pause').modal("hide");
                    }
                });
            }else{
                $('.load_txt').html("");
                $('.load_txt').append("Необходимо заполнить все поля!");
                $('#Pause').modal({keyboard: false,backdrop: false});
                $('#Pause').modal("show");
                setTimeout(function () {$('#Pause').modal("hide");},1000);
            }
            $('#SendMessage').modal("hide");
        })
        //**************************************************//
        function setstat() {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/inc/ind.php",
                data: {param: "setstat",tip:'Дом',kom:0},
                beforeSend: function (data) {

                },
                success: function (data) {
                    alert(data);
                },
                error: function (result) {
                }

            });
        }
        ////////////////////////////////////////////////////////////////
        function random(){
            $.ajax({
                type:"POST",
                dataType: "json",
                url:"/inc/ind.php",
                data:{param:"random"},
                beforeSend: function (data) {
                    $('.load_txt').html("");
                    $('.load_txt').append("Подождите! Идет обработка данных!");
                    $('#Pause').modal({keyboard: false,backdrop: false});
                    $('#Pause').modal("show");
                },
                success:function(data){
                    for(var i = 0;i<data.length;i++)
                    {
                        $tt="";$cen="не указана";imgg = 'img/p.jpg';
                        if(data[i][7]!=0){$cen=data[i][7];}
                        //if(data[i][10]!=null){imgg=data[i][10];}

                        if(data[i][12].length!=0){imgg=data[i][12];}

                        if(data[i][2]==="Продажа"){$tt="Продается";}if(data[i][2]==="Аренда"){$tt="Сдается";}
                        if(data[i][1]==="Дом"){$txt=$tt+' '+data[i][1].toLowerCase()+' '+data[i][6]+' кв.м в районе '+data[i][3];}
                        else{$txt=$tt+' '+data[i][4]+' комн. '+data[i][1].toLowerCase()+' '+data[i][6]+' кв.м в районе '+data[i][3];}
                        $('.spec').append('<div class="col-md-6 col-xs-12 col-sm-6" id="kartochka" ><div id="id">'+data[i][0]+'</div>'+
                                '<div class="panel panel-default" id="rdata" data-toggle="popover" data-placement="bottom"  data-content="'+data[i][8]+'" >'+
                                '<img class="img-responsive ffg" src="'+imgg+'">'+
                                '<div id="kartochka_txt">'+$txt+'</div>'+
                                '<div id="cena">'+$cen+'</div>'+
                                '<button class="btn btn-primary" id="ssilka_r">Подробнее</button>'+
                                '<br></div></div>');
                        $('[data-toggle="popover"]').popover({trigger:'hover'});
                    }
                    $('.spec').delegate("button","click",function(){
                        $('#m_foot1').html("");
                        getObject($(this).parent().parent().find('#id').text());
                        $('#ViewObject').modal("show");
                    });

                },
                error:function(result){
                    $('.load_txt').html("");
                    $('.load_txt').append("Произошла ошибка!!! Обратитесь к ресурсу чуть позже.");
                    $('#Pause').modal("hide");
                }
            });
        };
        ////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
        function getObject(rid){
            $.ajax({
                type:"POST",
                dataType: "json",
                url:"/inc/ind.php",
                data:{param:"2",id:rid},
                success:function(data){
                    $tt="";
                    if(data[2]==="Продажа"){$tt="Продается";}if(data[2]==="Аренда"){$tt="Сдается";}
                    $('#m_head1').html("");$('#m_body1').html("");$('#m_foot1').html("");
                    $('#m_head1').append($tt+" "+data[1].toLowerCase());

                    $('#m_body1').html("");
                    $('#m_body1').append('<table class="table" id="t1"><tr><td>'+
                            'Код объекта</td><td>'+data[0]+'</td></tr>'+
                            '<tr><td>Район</td><td>'+data[3]+'</td></tr>'+
                            '<tr><td>Количество комнат</td><td>'+data[4]+'</td></tr>'+
                            '<tr><td>Этаж</td><td>'+data[5]+'</td></tr>'+
                            '<tr><td>Площадь</td><td>'+data[6]+' м2</td></tr>'+

                            '</table>');

                    cen = "Цена не указана";if(data[7]!=0){cen = data[7]+" руб.";}
                    $('#m_body1').append('<div id="cena">'+cen+' </div><br>');
                    $('#m_body1').append('<div class="panel panel-default" id="m_op">'+data[8]+' </div>');
                    if(data[10]!="" || data[10]!=""){$('#m_body1').append('<h4>По всем вопросам обращаться: '+data[10]+'; '+data[11]+'</h4>');}

                    if(data[12].length!=0){
                        for(var i = 0;i<data[12].length;i++)
                        {
                            $('#m_foot1').append('<img class="img-responsive" id="m_img" src="'+data[12][i]+'"></img><br>');
                        }
                    }


                },
                error:function(result){
                }
            });
        }
////////////////////////////////////////////////////////////////

    });
</script>
</body>
</html>