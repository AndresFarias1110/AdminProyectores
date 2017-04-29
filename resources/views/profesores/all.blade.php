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
		  <li role="presentation" class="active"><a href="#">Profesores</a></li>
		  <li role="presentation"><a href="/prestamos/home">Prestamos</a></li>
		  <li role="presentation" ><a href="/proyectores/home">Proyectores</a></li>
		</ul>
		<div class="page-header">
			<h1>Profesores</h1>
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
				   	<td>Profesor</td>
				   	<td>Primer Apellido</td>
				   	<td>Segundo Apellido</td>
				   	<td></td>
				   </thead>
				  	
				   <tbody>
					@foreach($profesores as $profesor)
						  	<tr>
						  		<td>{{$profesor->nombre}}</td>
						  		<td>{{$profesor->app}}</td>
						  		<td>{{$profesor->apm}}</td>
						  		<td><button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="updateid({{$profesor->id}})">Editar</button></td>
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
	        <h4 class="modal-title" id="myModalLabel">Editar Profesor</h4>
	      </div>
	      <div class="modal-body">
	      	<input class="form-control" type="text" id="nombre" placeholder="nombre"></input>
	      </div>
	      <div class="modal-body">
	      	<input class="form-control" type="text" id="app" placeholder="Primer apellido"></input>
	      </div>
	      <div class="modal-body">
	      	<input class="form-control" type="text" id="apm" placeholder="Segundo apellido"></input>
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
	        <h4 class="modal-title" id="myModalLabel">Nuevo Profesor</h4>
	      </div>
	      <div class="modal-body">
	      	<input class="form-control" type="text" id="nom" placeholder="nombre"></input>
	      </div>
	      <div class="modal-body">
	      	<input class="form-control" type="text" id="appa" placeholder="Primer apellido"></input>
	      </div>
	      <div class="modal-body">
	      	<input class="form-control" type="text" id="apma" placeholder="Segundo apellido"></input>
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
			$.ajax({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				url: 'http://localhost:8000/postUpdateProfesor',
				type: 'post',
				data: {
					"id": idp,
					"nombre": $('#nombre').val(),
					"app": $('#app').val(),
					"apm": $('#apm').val()
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
				url: 'http://localhost:8000/postSaveProfesor',
				type: 'post',
				data: {	
					"nombre": $('#nom').val(),
					"app": $('#appa').val(),
					"apm": $('#apma').val()
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
