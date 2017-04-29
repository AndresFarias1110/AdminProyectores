{!! Html::style('assets/css/bootstrap.min.css') !!}
{!! Html::style('assets/css/style.css') !!}
{!! Html::script('assets/js/jquery-3.1.1.min.js') !!}
{!! Html::script('assets/js/bootstrap.min.js') !!}
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
{!! Html::script('assets/js/script.js') !!}
<!-- Esta es la vista, donde recibo los proyectores -->
<header>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</header>
<body>
	<div class="container">
		<ul class="nav nav-tabs">
		  <li role="presentation" class="active"><a href="#">Inicio</a></li>
		  <li role="presentation"><a href="/profesores/home">Profesores</a></li>
		  <li role="presentation"><a href="/prestamos/home">Prestamos</a></li>
		  <li role="presentation"><a href="/proyectores/home">Proyectores</a></li>
		</ul>
		<div class="page-header">
			<div class="col-md-6">
				<h1>
					<img src="/assets/img/itma.png" alt="100" width="80" class="img-circle">
					<small>Proyectores ITMA</small>
				</h1>
			</div>
			<div class="col-md-6">
				<div id="clock" class="light">
					<div class="display">
						<div class="weekdays"></div>
						<div class="ampm"></div>
						<div class="alarm"></div>
						<div class="digits"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				{{ csrf_field() }}
				@foreach($proyectores as $proyector)
					@if($proyector->estatus == "1")
						<div onclick="sendDataSave({{$proyector->id}})" class="col-md-3" style="background-color: green; box-shadow: 10px 10px 10px #999; margin: 2%; border-radius: 15px;" data-toggle="modal" data-target="#myModal">

							<h2>{{$proyector->proyector}}</h2><small>Disponible</small>
						</div>
					@else
						<div onclick="getPrestmo({{$proyector->id}})" class="col-md-3" style="background-color: red; margin: 2%; border-radius: 15px;" data-toggle="modal" data-target="#modalEntrega">
							<h2>{{$proyector->proyector}}</h2><small>Ocupado</small>
						</div>	
					@endif
				@endforeach
				
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Prestar Proyector 1</h4>
	      </div>
	      <div class="modal-body">
	      	<select class="form-control" id="prof">
	      		<option>Profesor</option>
	      		
	      		@foreach($profesores as $profesor)
	      			<option value="{{$profesor->id}}">{{$profesor->nombre}} {{$profesor->app}}</option>
	      		@endforeach
	      	</select>
	      	<select class="form-control" id="identificacion">
	      		<option>Identificacion</option>
	      		<option value="ine">INE</option>
	      		<option value="crendencia">Credencial</option>
	      	</select>
	      	<input class="form-control" type="text" id="salon" placeholder="Aula"></input>
	      	<input class="form-control" type="text" id="grupo" placeholder="Grupo"></input>
	      	<input class="form-control" type="text" id="materia" placeholder="Materia"></input>
	      	<label>Hora de Inicio</label>
	      	<input class="form-control" type="time" id="hentrega"></input>
	      	<label>Hora de Devolucion</label>
	      	<input class="form-control" type="time" id="hdev"></input>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-primary" onclick="save()">Prestar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modalEntrega" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Entrega de Proyector</h4>
	      </div>
	      <div class="modal-body">
	        <input class="form-control" id="proyector1" />
	      	<input class="form-control" id="prof1" />
	      	<input class="form-control" id="identificacion1"/>
	      	<input class="form-control" type="text" id="salon1" placeholder="Aula"></input>
	      	<input class="form-control" type="text" id="grupo1" placeholder="Grupo"></input>
	      	<input class="form-control" type="text" id="materia1" placeholder="Materia"></input>
	      	<input class="form-control" type="text" id="hentrega1"></input>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" onclick="clear()">Cancelar</button>
	        <button type="button" class="btn btn-primary" onclick="entregar()">Entregar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript">
		var id = 0;
		function sendDataUpdate(data){
			id = data;
		}
		function sendDataSave(data){
			id = data;
		}

		function clear(){
			location.reload();
		}

		function save(){
			$.ajax({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				url: "http://localhost:8000/postPrestar",
				type: "POST",
				data: {
					"proyector": id,
					"profesor": $('#prof').val(),
					"salon": $('#salon').val(),
					"grupo": $('#grupo').val(),
					"materia": $('#materia').val(),
					"identificacion": $('#identificacion').val(),
					"hentrega": $('#hentrega').val(),
					"hdev": $('#hdev').val()
				},
				success: function(data){
					console.log(data);
					location.reload();
				},
				error: function(err){
					console.log(err);
				}
			});
		}

		function getPrestmo(id){
			console.log('ID ',id);
			$.ajax({
				url: "http://localhost:8000/getPrestamo/" + id,
				type: "GET",
				success: function(proyector){
					
					$('#proyector1').val(proyector[0].id);
					var prestamo = proyector[1];
					var profesor = proyector[2];
					console.log(profesor);
					$('#prof1').val(profesor.nombre);
					$('#salon1').val(prestamo.salon);
					$('#grupo1').val(prestamo.grupo);
					$('#materia1').val(prestamo.materia);
					$('#identificacion1').val(prestamo.identificacion);
					$('#hentrega1').val(prestamo.hentrega);
				},
				error: function(err){
					console.log(err);
				}
			});
		}

		function entregar(){
			$.ajax({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				url: "http://localhost:8000/postEntregar",
				type: "POST",
				data: {
					"proyector": $('#proyector1').val()
				},
				success: function(data){
					console.log(data);
					location.reload();
				},
				error: function(err){
					console.log(err);
				}
			});
		}
	</script>
</body>
