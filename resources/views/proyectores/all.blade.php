{!! Html::style('assets/css/bootstrap.min.css') !!}
{!! Html::script('assets/js/jquery-3.1.1.min.js') !!}
{!! Html::script('assets/js/bootstrap.min.js') !!}
<header>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</header>
<body>
	<div class="container">
		<ul class="nav nav-tabs">
		  <li role="presentation" ><a href="/itma-proyectores/home">Inicio</a></li>
		  <li role="presentation"><a href="/profesores/home">Profesores</a></li>
		  <li role="presentation"><a href="/prestamos/home">Prestamos</a></li>
		  <li role="presentation" class="active"><a href="#">Proyectores</a></li>
		</ul>
		<div class="page-header">
			<h1>Proyectores</h1>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-md-12">
					<div class="col-md-3 col-md-offset-9">
					  <button  data-toggle="modal" data-target="#modalSave">
					  	<img src="/assets/img/add-icon.png" alt="40" width="40" class="img-circle">
					  </button>
						
					</div> 
				</div>
				{{ csrf_field() }}
				<table class="table table-hover">
				   <thead>
				   	<td>Proyector</td><td>status</td><td></td>
				   </thead>
				  	
				   <tbody>
					@foreach($proyectores as $proyector)
						  	<tr>
						  		<td>{{$proyector->proyector}}</td>
						  		<td>{{$proyector->estatus}}</td>
						  		<td><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="updateid({{$proyector->id}})">Editar</button></td>
						  	</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Editar Prestamo</h4>
	      </div>
	      <div class="modal-body">
	      	<input class="form-control" type="text" id="status" placeholder="Estado"></input>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-primary" onclick="update()">Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="modalSave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Nuevo Proyector</h4>
	      </div>
	      <div class="modal-body">
	      	<input class="form-control" type="text" id="pro" placeholder="nombre"></input>
	      </div>
	      <div class="modal-body">
	      	<input class="form-control" type="text" id="stat" placeholder="status"></input>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-primary" onclick="save()">Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>


	<script type="text/javascript">
		var idp = 0;
		function updateid(id){
			idp = id;
		}
		function update(){

			//estas son peticiones ajax
			$.ajax({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				url: 'http://localhost:8000/postUpdateProyector',
				type: 'post',
				data: {
					"id": idp,
					"status": $('#status').val()
				},
				success:function(data){
					location.reload();
				},
				error: function(err){

				}
			});
		}


		function save(){
			$.ajax({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				url: 'http://localhost:8000/postSaveProyector',
				type: 'post',
				data: {	
					"proyector": $('#pro').val(),
					"status": $('#stat').val()
				},
				success:function(data){
					location.reload();
				},
				error: function(err){

				}
			});
		}

	</script>

</body>
