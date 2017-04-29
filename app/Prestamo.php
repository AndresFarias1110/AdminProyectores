<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model {
	//esta es el modelo de la tabla prestamos
	// estamos creando la relaciones de prestamos a proyector
	public function proyector(){
		return $this->belongsTo('App\Proyectore', 'Proyectores_id', 'id');
	}
	// estamos creando la relaciones de prestamos a profesor
	public function profesor(){
		return $this->belongsTo('App\Profesore', 'profesores_id', 'id');
	}
}

?>