<?php 

/**
* 
*/
namespace App\Http\Controllers;

use App\Proyectore;
use App\Profesore;
use App\Prestamo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProyectoresController extends Controller
{
	public function home(){
		$proyectores = Proyectore::all();
		return view('proyectores.all', ['proyectores' => $proyectores]);
	}
	
	public function getProyectores(){
		//getProyectores es el metodo qye apunta
		$proyectores = Proyectore::all();
		// solo hace una consulta para todos los proyectores

		$profesores = Profesore::all();
		// le mando a una vista las variables del resultado de las consultas
		return view('proyectores.home', [
			'proyectores' => $proyectores,
			'profesores' => $profesores
			]);
	}

	public function postPrestar(Request $request){
		//creamos un nuevo prestamo
		$prestamo = new Prestamo;

		$poryector = Proyectore::find($request['proyector']);
		//hace una consulta a la tabla proyectores y busca el id que recibo por post, aqui estamos actualizando el status de un poryector
		//este es un controller
		$poryector->estatus = "2";
		//guardamos el cambio de valor de status
		$poryector->save();
		//damos valores a los campos de la tabla prestamos
		$prestamo->identificacion = $request['identificacion'];
		$prestamo->salon = $request['salon'];
		$prestamo->grupo = $request['grupo'];
		$prestamo->materia = $request['materia'];
		$prestamo->profesores_id = $request['profesor'];
		$prestamo->Proyectores_id = $request['proyector'];
		$prestamo->hentrega = $request['hentrega'];
		$prestamo->hdev = $request['hdev'];
		//guardamos el registro de prestamo
		$prestamo->save();

		return "success";
	}

	public function getPrestamo($id){
		$proyector = Proyectore::find($id);
		$prestamo = $proyector->prestamos->last();
		$profesor = $prestamo->profesor;

		$arr = array($proyector, $prestamo, $profesor);
		return $arr;
	}

	public function postEntregar(Request $request){
		$proyector = Proyectore::find($request['proyector']);

		$proyector->estatus = "1";

		$proyector->save();

		return "success";
	}

	public function delete($id){
		$proyector = Proyectore::find($id);
		$proyector->delete();

		return "success";
	}

	public function profesores(){
		$profesores = Profesore::all();

		return view('profesores.all', ['profesores' => $profesores]);
	}

	public function prestamos(){
		$prestamos = Prestamo::all();
		return view('prestamos.home', [
			'prestamos' => $prestamos
			]);
	}

	public function add(Request $request){
		$proyector = new Proyectore;//::find($request['proyector']);

		$proyector->estatus = $request['status'];
		$proyector->proyector = $request['proyector'];

		$proyector->save();

		return "success";
	}

	public function deletePrestamo(Request $request){
		$prestamo = Prestamo::find($request['id']);

		$prestamo->delete();

		return "delete";
	}

	public function update(Request $request){
		$proyector = Proyectore::find($request['id']);

		$proyector->estatus = $request['status'];

		$proyector->save();
		
		return "update";
	}

	public function updateProfesor(Request $request){
		$profesor = Profesore::find($request['id']);

		$profesor->nombre = $request['nombre'];
		$profesor->app= $request['app'];
		$profesor->apm = $request['apm'];

		$profesor->save();

		return "success";
	}

	public function saveProfesor(Request $request){
		$profesor = new Profesore;

		$profesor->nombre = $request['nombre'];
		$profesor->app = $request['app'];
		$profesor->apm = $request['apm'];
		$profesor->save();

		return "success";
	}

	public function saveProyector(Request $request){
		$proyector = new Proyectore;

		$proyector->proyector = $request['proyector'];
		$proyector->estatus = $request['status'];
		$proyector->save();

		return "success";
	}
}
 ?>