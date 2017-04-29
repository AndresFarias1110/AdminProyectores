<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesore extends Model {
	// estamos creando la relaciones de  profesor a prestamos
	public function prestamos(){
		return $this->hasMany('App\Prestamo', 'profesores_id', 'id');
	}
}

?>