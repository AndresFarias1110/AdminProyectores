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
		  <li role="presentation" class="active"><a href="#">Prestamos</a></li>
		  <li role="presentation" ><a href="/proyectores/home">Proyectores</a></li>
		</ul>
		<div class="page-header">
			<h1>Prestamos</h1>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				{{ csrf_field() }}
				<table class="table table-hover">
				   <thead>
				   	<td>Prestamo</td>
				   	<td>identificacion</td>
				   	<td>Salon</td>
				   	<td>Grupo</td>
				   	<td>Materia</td>
				   	<td>Profesor</td>
				   	<td>Proyector</td>
				   	<td>Inicio</td>
				   	<td>Devolucion</td>
				   	<td></td>
				   </thead>
				  	
				   <tbody>
					@foreach($prestamos as $prestamo)
						  	<tr>
						  		<td>{{$prestamo->id}}</td>
						  		<td>{{$prestamo->identificacion}}</td>
						  		<td>{{$prestamo->salon}}</td>
						  		<td>{{$prestamo->grupo}}</td>
						  		<td>{{$prestamo->materia}}</td>
						  		<td>{{$prestamo->profesor->nombre}}</td>
						  		<td>{{$prestamo->Proyectores_id}}</td>
						  		<td>{{$prestamo->hentrega}}</td>
						  		<td>{{$prestamo->hdev}}</td>
						  		<td>
						  			<button class="btn btn-warning btn-xs" class="btn btn-warning btn-xs" onclick="deleteP({{$prestamo->id}})">Eliminar</button>
						  		</td>
						  	</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function deleteP(id){
			console.log(id);
			$.ajax({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				url: 'http://localhost:8000/postDeletePrestamo',
				type: 'post',
				data: {
					"id": id 
				},
				success:function(data){
					location.reload();
				},
				error: function(err){
					console.log(err);
				}
			});
		}

	</script>
</body>
