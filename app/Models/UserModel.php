<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{

	protected $table = 'usuarios';
	protected $allowedFields = ['user', 'senha'];

	public function getUser($user, $senha){

		return $this->asArray()
				->where(['user' => $user, 'senha' => md5($senha)])
				->first();
	}

}