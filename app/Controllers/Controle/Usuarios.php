<?php 
namespace App\Controllers\Controle; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\UserModel;

class Usuarios extends BaseController
{
	public function index()	{
		$model = new UserModel();
		
		$data = [
			'title' => 'Usuários',
			'usuarios' => $model->paginate(1),
			'pager' => $model->pager,
			'msg' => ''
		];
		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/usuarios');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

	public function gravar(){

		$model = new UserModel();

		helper('form');

		if($this->validate([
			'user' => ['label' => 'Usuários', 'rules' => 'required|min_length[3]|is_unique[usuarios.user]'],
			'senha' => ['label' => 'Senha', 'rules' => 'required|min_length[5]']
			])){

				$user = $this->request->getVar('user');
				$senha = md5($this->request->getVar('user'));

				$model->save([
					'user' => $user,
					'senha' => $senha
				]);

				$msg = 'Usuário cadastrado!';

			}else {
				$msg = 'Erro ao cadastrar usuário!';
			}

			$data = [
				'title' => 'Usuários',
				'usuarios' => $model->paginate(1),
				'pager' => $model->pager,
				'msg' => $msg
			];

			echo view('backend/templates/html-header', $data);
			echo view('backend/templates/header');
			echo view('backend/pages/usuarios', $data);
			echo view('backend/templates/footer');
			echo view('backend/templates/html-footer');
	}


	public function excluir($id = null){
		$model = new UserModel();

		$model->delete($id);

		return redirect()->to(base_url('controle/usuarios'));
	}

	public function editarSenha(){
		$model = new UserModel();

		$id = $this->request->getVar('id');

		$data = [
			'senha' => md5($this->request->getVar('user'))
		];

		$model->update($id, $data);

		return redirect()->to(base_url('controle/usuarios'));
	}

}
