<?php 
namespace App\Controllers\Controle; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class Categorias extends BaseController
{
	public function index()	{
		$model = new CategoriaModel();
		
		$data = [
			'title' => 'Categorias',
			'categorias' => $model->paginate(10),
			'pager' => $model->pager,
			'msg' => ''
		];
		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/categorias');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

	public function editar($id = null) {
		$model = new CategoriaModel();
		
		$data = [
			'title' => 'Editar Categorias',
			'categorias' => $model->getCategoria($id),
			'msg' => ''
		];

		if(empty($data['categorias']))
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Não foi encontrada a categoria com id: '.$id);

		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/categoriasEditar');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

	public function gravar(){

		$model = new CategoriaModel();

		helper('form');

		if($this->validate([
			'titulo' => ['label' => 'Título', 'rules' => 'required|min_length[3]'],
			'resumo' => ['label' => 'Resumo', 'rules' => 'required|min_length[5]']
			])){
				$id = $this->request->getVar('id');
				$titulo = $this->request->getVar('titulo');
				$resumo = $this->request->getVar('resumo');

				$model->save([
					'titulo' => $titulo,
					'resumo' => $resumo
				]);

				$msg = 'Categoria cadastrada!';

			}else {
				$msg = 'Erro ao cadastrar categoria!';
			}

			$data = [
				'title' => 'Categorias',
				'categorias' => $model->paginate(1),
				'pager' => $model->pager,
				'msg' => $msg
			];

			echo view('backend/templates/html-header', $data);
			echo view('backend/templates/header');
			echo view('backend/pages/categorias');
			echo view('backend/templates/footer');
			echo view('backend/templates/html-footer');
	}


	public function excluir($id = null){
		$model = new CategoriaModel();

		$model->delete($id);

		return redirect()->to(base_url('controle/categorias'));
	}

}
