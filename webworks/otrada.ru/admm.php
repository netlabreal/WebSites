<?
require_once 'inc/auto.php';
if (!Sessions::exists("username")){
	exit;
}
else
{?>
<!DOCTYPE html>
<html class="full">
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/man.css">
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script> 
    <title></title>
</head>
<body class="full">
			 	<div id="user">
			 		<? echo Sessions::get("username");?>
			 		<a href="/inc/logout.php"> Выход</a>
			 	</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">

            <div class="panel panel-default" id ="m_panel">
			 <br>

			 <br>	
             <ul class="nav nav-tabs" id="doppanel">
                <li class="active"><a href="#objects" data-toggle="tab" id="ss_o">Объекты недвижимости</a></li>
                <li><a href="#zayavki" data-toggle="tab" id="ss_z">Заявки</a></li>
                <li><a href="#rayons" data-toggle="tab" id="ss_r">Районы</a></li>
            </ul>
            <div class="tab-content" id="doppanel">
			    <div class="tab-pane active" id="objects">
			    <br>
					<table class="table table-hover table-bordered table-condensed" >
						<thead id="objects_table">
							<tr>
								<th>№</th>
								<th>Тип</th>
								<th>Вид</th>
								<th>Район</th>
								<th>Кол-во комнат</th>
								<th>Площадь</th>
								<th>Цена</th>
								<th>Описание</th>
								<th>Дата</th>
								<th>---</th>
							</tr>
						</thead>
					</table>
					<button class="btn btn-primary" id="ssilka">Добавить объект</button>
					<br>
				</div>
			    <div class="tab-pane" id="zayavki">
			    <br>
			    <br>
					<table class="table table-hover table-bordered table-condensed" >
						<thead id="z_table">
							<tr>
								<th>№</th>
								<th>Имя</th>
								<th>Телефон</th>
								<th>Заявка</th>
							</tr>
						</thead>
					</table>
				</div>

			    <div class="tab-pane" id="rayons">
			    <br>
					<table class="table table-hover table-bordered table-condensed" >
						<thead id="rayons_table">
							<tr>
								<th>№</th>
								<th>Район</th>
							</tr>
						</thead>
					</table>
					<button class="btn btn-primary" id="add_r">Добавить район</button>
					<br><br>
					
				</div>
				
			</div>
			
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="YesNo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-body" id="m_b">
				<div id="id_for_del"></div>
				<div id="m_t">Вы уверены что хотите удалить данный объект?</div>
				<div class="btn btn-primary" id="m_but">Отмена</div>
				<div class="btn btn-primary" id="m_but_del">Удалить</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="cap">
			</div>
            <div class="modal-body">
				<div class='ret'>Тип операции</div>	
                <select class="form-control input-sm" id="m_tp" >
                </select>
				<div class='ret'>Тип объекта</div>	
                <select class="form-control input-sm" id="m_tip" >
                </select>
				<div class='ret'>Район</div>	
                <select class="form-control input-sm" id = "m_rayon">
                </select>
				<div class='ret'>Кол-во комнат</div>	
				<input type="text" class="form-control" id='m_komn'>
				<div class='ret'>Этаж</div>	
				<input type="text" class="form-control" id='m_floor'>
				<div class='ret'>Площадь</div>	
				<input type="text" class="form-control " id='m_plosh'>
				<div class='ret'>Цена</div>	
				<input type="text" class="form-control" id='m_cena'>
				<div class='ret'>Описание</div>	
				<textarea rows="5" class="form-control" id='m_opis'></textarea>
				<input type="checkbox" id="visible_check"> Не отображать на сайте
				<div id="id"></div>
				<div id="vid1"></div>
				<div id="knopki"></div>
				
				<div class="panel panel-default"  id="add_foto">
					<form action="/inc/init.php" method="post" enctype="multipart/form-data" id="f_form">
						<input type="file" id="file" name="myfile"><br>
						<input type="hidden" id="txt_id" name="id"><br>
						<input class="btn" id="btn_f" type="submit" value="Добавить фото">
					</form>			
					<div id="status">
					</div>
					
					
				</div>
				
				
			</div>
            <div class="modal-footer" id="foot">
			
			
			</div>
		</div>	
	</div>
</div>	

<div class="modal fade" id="EditR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	Добавить район	
			</div>
	        <div class="modal-body">
				<div class='ret'>Наименование района</div>	
				<input type="text" class="form-control" id='ray'>
				<br><br>	
				<div class="btn btn-primary" id="ray_exit">Отмена</div>
				<div class="btn btn-primary" id="ray_add">Сохранить</div>
			</div>
	        <div class="modal-footer" id="foot">
			</div>
		</div>	
	</div>
</div>	


<script type="text/javascript">
$(function () {
var Error = 0;	
var status = $('#status');
var kol_objects_na_str=0;
	
////////////////////////////////////////////////////////////////
$('#m_but').click(function(){
	$('#YesNo').modal("hide");
});
////////////////////////////////////////////////////////////////
$('#m_but_del').click(function(){
var act_p = 1;
	if($('#perebor [class = active]').text()!==""){
		var act_p = $('#perebor [class = active]').text();
	}
		
		DelObject($('#id_for_del').val());
		kol_objects_na_str=kol_objects_na_str-1;
		if(kol_objects_na_str==0){
			if(act_p!=1){
				act_p = act_p - 1;
			}
		}
		All_objects(act_p);
		$('#YesNo').modal("hide");
});
////////////////////////////////////////////////////////////////
$('#m_komn').change(function(){
var n = parseInt($('#m_komn').val()); 
if(isNaN(n)){$('#m_komn').css('background-color','red');Error=1;}else{$('#m_komn').css('background-color','');Error = 0;}});
////////////////////////////////////////////////////////////////
$('#m_floor').change(function(){
var n = parseInt($('#m_floor').val()); 
if(isNaN(n)){$('#m_floor').css('background-color','red');Error=1;}else{$('#m_floor').css('background-color','');Error = 0;}});
////////////////////////////////////////////////////////////////
$('#m_plosh').change(function(){
var n = parseFloat($('#m_plosh').val()); 
if(isNaN(n)){$('#m_plosh').css('background-color','red');Error=1;}else{$('#m_plosh').css('background-color','');Error = 0;}});
////////////////////////////////////////////////////////////////
$('#m_cena').change(function(){
var n = parseFloat($('#m_cena').val()); 
if(isNaN(n)){$('#m_cena').css('background-color','red');Error=1;}else{$('#m_cena').css('background-color','');Error = 0;}});
////////////////////////////////////////////////////////////////
$('form').ajaxForm({
    beforeSend: function() {
        status.empty();
    },
    uploadProgress: function(event, position, total, percentComplete) {
		status.append('<img id="load" src="img/ajax-loader.gif" />');
    },
    success: function() {
        status.empty();
    },
	complete: function(xhr) {
		$('#file').val("");
		if((xhr.responseText!=="0") && (xhr.responseText!=="1") && (xhr.responseText!=="2")){
			$('#foot').prepend('<div class="panel panel-default" id="ddd"><img class="img-responsive" id="m_img1" src="'+xhr.responseText+'"></img><button class="btn" id="del_img">Удалить</button></div>');
		}
		else
		{
			if(xhr.responseText=="1"){status.html("Превышено количество фото!");}
			if(xhr.responseText=="0"){status.html("Произошла ошибка на сервере!");}
			if(xhr.responseText=="2"){status.html("Выбран неверный тип файла!");}
		}
	}
}); 	
////////////////////////////////////////////////////////////////
function pager($el){
		$.ajax({
		type:"POST",
		dataType: "json",
		url:"/inc/ind.php",
		data:{param:"4",tp:0,tip:0,rayon:0,p:0},
		success:function(data){
		if(data>1){AddPager(data,$el);}
		},
		error:function(result){
		}
	});	
}
////////////////////////////////////////////////////////////////
function AddPager($col,$el){
	$('#objects').append('<div class="pag"><ul class="pagination pagination-sm" id="perebor">');
	$i = 1;
	while($col>=$i){
		if($el==$i){$('.pagination').append('<li class="active"><a id="pg">'+$i+'</a></li>');}
		else{$('.pagination').append('<li ><a id="pg">'+$i+'</a></li>');}
		$i++;
	}
	$('.pagination').append('</ul></div>');


		$('#perebor a').click(function(){
			var list = $('#perebor').children();
			var ch = $('#perebor [class = active]');
			
			if($(this).parent().attr('id')=="next"){
				if(ch.next().attr('id')=="next"){ch.next().addClass('disabled');}else{ch.removeClass("active");ch.next().addClass("active");}
			}
			else
			{
				ch.removeClass("active");	
				$(this).parent().addClass("active");
				All_objects($(this).text());
			}
		}); 
}
////////////////////////////////////////////////////////////////
function getTdata($s,$tip,$r){
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
					$('#m_tp').html("");
					$('#m_tp').append("<option selected value='0'>-Тип операции-</option>");
						 for(var i = 0;i<data[0].length;i++)
						{
							if(data[0][i]['id']==$s){$('#m_tp').append("<option selected value="+data[0][i]['id']+">"+data[0][i]['name']+"</option>")}else{$('#m_tp').append("<option value="+data[0][i]['id']+">"+data[0][i]['name']+"</option>")};
						}
				}				
				else{
					$('#m_tp').attr('disabled', true);
				}
				if(data[1].length!=0){
					$('#m_tip').html("");
					$('#m_tip').append("<option selected value='0'>-Тип недвижимости-</option>");
					 for(var i = 0;i<data[1].length;i++)
					{
						if(data[1][i]['id']==$tip){$('#m_tip').append("<option selected value="+data[1][i]['id']+">"+data[1][i]['name']+"</option>")}else{$('#m_tip').append("<option value="+data[1][i]['id']+">"+data[1][i]['name']+"</option>")};
					}	
				}
				else{
					$('#m_tip').attr('disabled', true);
				}
				if(data[2].length!=0){
					$('#m_rayon').html("");
					$('#m_rayon').append("<option selected value='0'>-Район недвижимости-</option>");
					 for(var i = 0;i<data[2].length;i++)
					{
						if(data[2][i]['id']==$r){$('#m_rayon').append("<option selected value="+data[2][i]['id']+">"+data[2][i]['name']+"</option>")}else{$('#m_rayon').append("<option value="+data[2][i]['id']+">"+data[2][i]['name']+"</option>")};
					}	
				}
				else{
					$('#m_rayon').attr('disabled', true);
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
function DelObject($rid){
	$.ajax({
		type:"POST",
		dataType: "json",
		url:"/inc/ind.php",
		data:{param:"11",id:$rid},		
		success:function(data){if(data==0){alert("Ошибка на сервере!")}else{}},
		error:function(result){}
	});	
}	
////////////////////////////////////////////////////////////////
function DelZ($rid){
	$.ajax({
		type:"POST",
		dataType: "json",
		url:"/inc/ind.php",
		data:{param:"18",id:$rid},		
		success:function(data){if(data==0){alert("Ошибка на сервере!")}},
		error:function(result){}
	});	
}	
////////////////////////////////////////////////////////////////
function DelRayon($rid){
	$.ajax({
		type:"POST",
		dataType: "json",
		url:"/inc/ind.php",
		data:{param:"19",id:$rid},		
		success:function(data){if(data==0){alert("Невозможно удалить район!")}},
		error:function(result){}
	});	
}	
////////////////////////////////////////////////////////////////
function SelectObject($rid){
	$.ajax({
		type:"POST",
		dataType: "json",
		url:"/inc/ind.php",
		data:{param:"12",id:$rid},		
		success:function(data){
		
			$('#cap').html("");
			$('#cap').append("Изменить объект недвижимости № "+data[0]);
			getTdata(data[1],data[2],data[3]);
			
			$('#file').val("");	$('#status').html("");
			$('#id').val(data[0]);	$('#txt_id').val($('#id').val());
			$('#m_komn').val(data[4]);	
			$('#m_floor').val(data[5]);
			$('#m_plosh').val(data[6]);
			$('#m_cena').val(data[7].replace(/,/g,""));
			$('#m_opis').val(data[8]);
			if(data[9]==1){$('#visible_check').prop("checked",true);}else{$('#visible_check').prop("checked",false);}

			$('#knopki').html("");$('#foot').html("");
			$('#knopki').append("<button class='btn btn-primary' id='exit'>Отмена</button>");
			$('#knopki').append("<button class='btn btn-primary' id='edit'>Изменить</button><br>");
			
			if(data[10].length!=0){
				for(var i = 0;i<data[10].length;i++)
				{
					$('#foot').append('<div class="panel panel-default" id="ddd"><img class="img-responsive" id="m_img1" src="'+data[10][i]+'"></img><button class="btn" id="del_img">Удалить</button></div>');
				}	
			}
				/////////////////////////////////
				$('#edit').click(function(){
					IzmObject();
					$('#EditModal').modal("hide");
				});
				/////////////////////////////////			
				$('#exit').click(function(){
					if($('#perebor [class = active]').text()!==""){All_objects($('#perebor [class = active]').text());}else{All_objects(1);}
					
					$('#EditModal').modal("hide");
				});
				/////////////////////////////////	
			$('#EditModal').modal({keyboard: false,backdrop: 'static'});
			$('#add_foto').show();
			$('#EditModal').modal("show");
		},
		error:function(result){}
	});	
}
////////////////////////////////////////////////////////////////
function All_objects($page){
		$.ajax({
		type:"POST",
		dataType: "json",
		url:"/inc/ind.php",
		data:{param:"3",tp:"0",tip:"0",rayon:"0",page:$page,p:"0"},		
		success:function(data){
            $('#objects').html("");
			$('#objects').append('<table class="table table-hover table-bordered table-condensed"  id="objects_table" ><br>');
			$('#objects_table').append('<thead><tr><th>№</th><th>Тип</th><th>Вид</th><th>Район</th><th>Комнат</th><th>Этаж</th><th>Площадь</th><th>Цена</th><th>Описание</th><th>Фото</th><th>Вид</th><th>---</th></tr></thead><tbody>');
			for(var i = 0;i<data.length;i++)
            {
				vis = "нет";foto = "";
				if(data[i][9]==="0"){vis = "да";}
				if(data[i][10]!==null){foto ="есть";}
				
				$('#objects_table').append("<tr id='curs'>" +
							"<td id='pr'>"+data[i][0]+"</td>" +
							"<td id='pr'>"+data[i][1]+"</td>" +
							"<td id='pr'>"+data[i][2]+"</td>"+
							"<td id='pr'>"+data[i][3]+"</td>"+
							"<td id='pr'>"+data[i][4]+"</td>"+
							"<td id='pr'>"+data[i][5]+"</td>"+
							"<td id='pr'>"+data[i][6]+"</td>"+
							"<td id='pr'>"+data[i][7]+"</td>"+
							"<td id='pr'>"+data[i][8]+"</td>"+
							"<td id='pr'>"+foto+"</td>"+
							"<td id='pr'>"+vis+"</td>"+
							'<td><a id="r_del">Удалить</a></td>'+
							"</tr>");
			}
			kol_objects_na_str = data.length;

			$('#objects').append('</tbody></table><button class="btn btn-primary" id="ssilka">Добавить объект</button>');
						$('#ssilka').click(function(){
							getTdata();
							$('#m_komn').val("");$('#m_plosh').val("");$('#m_cena').val("");$('#m_opis').val("");$('#m_floor').val("");
							$('#cap').html("");
							$('#cap').append("Внести объект недвижимости.");
							$('#visible_check').prop('checked',false);
							$('#EditModal').modal({keyboard: false,backdrop: 'static'});
							$('#EditModal').modal("show");

							$('#knopki').html("");$('#foot').html("");$('#add_foto').hide();
							$('#knopki').append("<button class='btn btn-primary' id='add'>Сохранить</button>");
							$('#knopki').append("<button class='btn btn-primary' id='exit'>Отмена</button>");
								/////////////////////////////////
								$('#exit').click(function(){
									$('#EditModal').modal("hide");
								});
								/////////////////////////////////
								$('#add').click(function(){
								if($('#m_tp').val()!=null && $('#m_tip').val()!=null && $('#m_rayon').val()!=null){
									if($('#m_tp').val()!=0 && $('#m_tip').val()!=0 && $('#m_rayon').val()!=0 && $('#m_komn').val()!=''){
										VnestiObject();
										$('#EditModal').modal("hide");
									}
									else
									{
										alert("Введены не все данные!!!");
									}
								}	
								});
								/////////////////////////////////
						});
				
				$('tr#curs td[id="pr"]').click(function(){
						SelectObject($(this).parent().find("td:eq(0)").text());
					});
				$('a[id="r_del"]').click(function(){
				$('#id_for_del').val($(this).parent().parent().find("td:eq(0)").text());
					$('#YesNo').modal("show");
					if($('#perebor [class = active]').text()!==""){All_objects($('#perebor [class = active]').text());}else{All_objects(1);}
				});
			pager($page);	
		},
		error:function(result){
			alert("error with server!!!");
		}
		});
}
////////////////////////////////////////////////////////////////
function getZayavki(){
	$.ajax({
	type:"POST",
	dataType: "json",
	url:"/inc/ind.php",
	data:{param:"17"},
	success:function(data){
		if(data!=null){
			$('#z_table').html("");

			$('#z_table').append("<tr><th>№</th><th>Имя</th><th>Телефон</th><th>Заявка</th><th>Дата</th></tr>");

			 for(var i = 0;i<data.length;i++)
			{
				$('#z_table').append("<tr>" +
							"<td>"+data[i][0]+"</td>" +
							"<td>"+data[i][1]+"</td>" +
							"<td>"+data[i][2]+"</td>" +
							"<td>"+data[i][3]+"</td>" +
							"<td>"+data[i][4]+"</td>" +
							'<td><a id="z_del">Удалить</a></td>'+
							"</tr>");				
			}

		$('a[id="z_del"]').click(function(){
			DelZ($(this).parent().parent().find("td:eq(0)").text());	
			getZayavki();
		});		
		}
	},
	error:function(result){
		alert("error with server!!!");
	}
	});
}
////////////////////////////////////////////////////////////////
function getRayons(){
	$.ajax({
	type:"POST",
	dataType: "json",
	url:"/inc/ind.php",
	data:{param:"14"},
	success:function(data){
		if(data!=null){
			$('#rayons_table').html("");
			$('#rayons_table').append("<tr><th>№</th><th>Наименование района</th></tr>");

			 for(var i = 0;i<data.length;i++)
			{
				$('#rayons_table').append("<tr>" +
							"<td id='pr'>"+data[i][0]+"</td>" +
							"<td id='pr'>"+data[i][1]+"</td>" +
							'<td><a id="ray_del">Удалить</a></td>'+
							"</tr>");				
			}	
		$('a[id="ray_del"]').click(function(){
			DelRayon($(this).parent().parent().find("td:eq(0)").text());	
			getRayons();
		});		
			
		}
	},
	error:function(result){
		alert("error with server!!!");
	}
	});
}
////////////////////////////////////////////////////////////////
function VnestiObject(){
$visible = 0;
if($('#visible_check').prop('checked')==true){$visible =1;}
	$.ajax({
		type:"POST",
		dataType:"json",
		url:"/inc/ind.php",
		data:{param:"15",s:$('#m_tp').val(),tip:$('#m_tip').val(),rayon:$('#m_rayon').val(),komn:$('#m_komn').val(),floor:$('#m_floor').val(),plosh:$('#m_plosh').val(),cena:$('#m_cena').val(),opis:$('#m_opis').val(),vis:$visible},
		success:function(data){
			All_objects(1);	
		},
		error:function(result){}
	});
}
////////////////////////////////////////////////////////////////
function VnestiRayon(){
	$.ajax({
		type:"POST",
		dataType:"json",
		url:"/inc/ind.php",
		data:{param:"20",rayon:$('#ray').val()},
		success:function(data){
 			if(data!=0){getRayons();}else{alert('Такой район уже существует!')}	
		},
		error:function(result){}
	});
}
////////////////////////////////////////////////////////////////
function IzmObject(){
$visible = 0;
if($('#visible_check').prop('checked')==true){$visible =1;}
	$.ajax({
		type:"POST",
		dataType:"json",
		url:"/inc/ind.php",
		data:{param:"16",id:$('#id').val(),s:$('#m_tp').val(),tip:$('#m_tip').val(),rayon:$('#m_rayon').val(),komn:$('#m_komn').val(),floor:$('#m_floor').val(),plosh:$('#m_plosh').val(),cena:$('#m_cena').val(),opis:$('#m_opis').val(),vis:$visible},
		success:function(data){		
		if(data=="1"){
		if($('#perebor [class = active]').text()!==""){All_objects($('#perebor [class = active]').text());}else{All_objects(1);}
		}else{alert("Произошла ошибка изменения данных!");}
		
		},
		error:function(result){}
	});
}
////////////////////////////////////////////////////////////////
All_objects(1);
$('#ss_r').click(function(){getRayons();});
$('#ss_o').click(function(){All_objects(1);});
$('#ss_z').click(function(){getZayavki();});



////////////////////////////////////////////////////////////////
$('#foot').delegate("#ddd #del_img","click",function(){
	inttt = $(this).parent().find("img").attr("src");
	th = $(this).parent();
	$.ajax({
		type:"POST",
		dataType: "json",
		url:"/inc/init.php",
		data:{init:"1",file:inttt},
		success:function(data){
			th.detach();
							},
		error:function(result){	}
	});
});		
////////////////////////////////////////////////////////////////
$('#add_r').click(function(){
	$('#ray').val('');
	$('#EditR').modal('show');
})
$('#ray_exit').click(function(){
	$('#EditR').modal('hide');
})
$('#ray_add').click(function(){
	VnestiRayon();
	$('#EditR').modal('hide');
})


});
</script>
</body>
</html>
<?}?>