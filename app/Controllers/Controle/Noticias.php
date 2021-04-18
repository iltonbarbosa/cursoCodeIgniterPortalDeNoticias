<?php 
namespace App\Controllers\Controle; //o CodeIgneter interpretará como um caminho a ser executado, sem precisar criar rotas

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\NoticiaModel;

class Noticias extends BaseController
{
	public function index()	{
		$model = new NoticiaModel();
		$catModel = new CategoriaModel();
		
		$data = [
			'title' => 'Notícias',
			'categorias' => $catModel->getCategoria(),
			'noticias' => $model->paginate(10),
			'pager' => $model->pager,
			'msg' => ''
		];
		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/noticias');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

	public function editar($id = null) {
		$model = new NoticiaModel();
		$catModel = new CategoriaModel();
		
		
		$data = [
			'title' => 'Notícias',
			'categorias' => $catModel->getCategoria(),
			'noticias' => $model->getNoticias($id),
			'msg' => ''
		];

		if(empty($data['noticias']))
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Não foi encontrada a notícia com id: '.$id);

		echo view('backend/templates/html-header', $data);
		echo view('backend/templates/header');
		echo view('backend/pages/noticiaEditar');
		echo view('backend/templates/footer');
		echo view('backend/templates/html-footer');
	}

	public function gravar(){

		$model = new NoticiaModel();
		$catModel = new CategoriaModel();

		$msg = null;

		helper('form');

		if($this->validate([
			'titulo' => ['label' => 'Título', 'rules' => 'required|min_length[3]'],
			'resumo' => ['label' => 'Resumo', 'rules' => 'required|min_length[5]'],
			'conteudo' => ['label' => 'Conteúdo', 'rules' => 'required|min_length[5]'],
			'categoria' => ['label' => 'Categoria', 'rules' => 'required']
			])){
				$id = $this->request->getVar('id');
				$categoria = $this->request->getVar('categoria');
				$destaque = $this->request->getVar('destaque');
				$titulo = $this->request->getVar('titulo');
				$resumo = $this->request->getVar('resumo');
				$conteudo = $this->request->getVar('conteudo');
				$img = $this->request->getFile('img');

				if(!$img->isValid()){

					$model->save([
						'id' => $id,
						'destaque' => $destaque,
						'titulo' => $titulo,
						'cat' => $categoria,
						'resumo' => $resumo,
						'conteudo' => $conteudo,
					]);
	
					$msg = 'Notícia cadastrada!';

				}else{
					$validacaoIMG = $this->validate([
						'img' => [
							'uploaded[img]',
							'mime_in[img, image/jpg,image/jpeg, image/gif, image/png]',
							'max_size[img,4096]'
						]
					]);

					if($validacaoIMG){
						$novoNome = $img->getRandomName();
						$img->move('img/noticias', $novoNome);

						$model->save([
							'id' => $id,
							'destaque' => $destaque,
							'titulo' => $titulo,
							'cat' => $categoria,
							'resumo' => $resumo,
							'conteudo' => $conteudo,
							'img' => $novoNome
						]);

						
					$msg = 'Notícia cadastrada!';

					}
				}

			}else {
				$msg = 'Erro ao cadastrar notícia!';
			}

			
			$data = [
				'title' => 'Notícias',
				'categorias' => $catModel->getCategoria(),
				'noticias' => $model->paginate(10),
				'pager' => $model->pager,
				'msg' => $msg
			];

			echo view('backend/templates/html-header', $data);
			echo view('backend/templates/header');
			echo view('backend/pages/noticias');
			echo view('backend/templates/footer');
			echo view('backend/templates/html-footer');
	}


	public function excluir($id = null){
		$model = new NoticiaModel();

		$model->delete($id);

		return redirect()->to(base_url('controle/noticias'));
	}

}
