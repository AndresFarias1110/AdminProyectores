<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectore extends Model {
	
	public function prestamos(){
		return $this->hasMany('App\Prestamo', 'Proyectores_id', 'id');
	}
}

 ?>