<?php
namespace App\Models;
use CodeIgniter\Model;

class NoticiaModel extends Model{

	protected $table = 'noticias';
	protected $allowedFields = ['cat','titulo', 'resumo','conteudo','destaque','img'];
	protected $primaryKey = 'id';

	protected $useSoftDeletes = true;
	protected $useTimestamps = true;
	protected $dateFormat = 'datetime';
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';

	public function getNoticias($id = false){

		if($id == false){
			return $this->findAll();
		}

		return $this->asArray()
				->where(['id' => $id])
				->first();
	}

}