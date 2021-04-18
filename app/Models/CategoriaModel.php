<?php
namespace App\Models;
use CodeIgniter\Model;

class CategoriaModel extends Model{

	protected $table = 'categoria';
	protected $allowedFields = ['titulo', 'resumo'];
	protected $primaryKey = 'id';

	protected $useSoftDeletes = true;
	protected $useTimestamps = true;
	protected $dateFormat = 'datetime';
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';

	public function getCategoria($id = false){

		if($id == false){
			return $this->findAll();
		}

		return $this->asArray()
				->where(['id' => $id])
				->first();
	}

}