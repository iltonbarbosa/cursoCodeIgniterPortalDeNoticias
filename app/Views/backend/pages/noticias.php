 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Notícias</h1>

		  <?php if($msg): ?>
			<div class="p-3 my-3 alert-info">
				<?= $msg ?>
			</div>
		  <?php endif;?>

          <div class="p-3 my-3 text-danger">
			<?= \Config\Services::validation()->listErrors(); ?>
		  </div>

		  <div class="row">
		  	<div class="col-md-12">
		  		<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Inserir Notícias</h6>
                </div>
                <div class="card-body">
				<form action="<?= base_url('controle/noticias/gravar') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="destaque" class="form-check-label" value="1"/> Em Destaque
							</label>
						</div>
					</div>
                    <div class="form-group">
						<label for="titulo">Título</label>
				    	<input class="form-control" type="input" name="titulo"/>
					</div>
					
					<div class="form-group">
						<label for="categoria">Categoria</label>
				    	<div class="form-group">
							<select name="categoria" class="form-control" tabindex="-1" >
								<option value="">Selecione...</option>
								<?php foreach ($categorias as $cat):?>
									<option value="<?=$cat['id']?>"><?=$cat['titulo']?></option>
								<?php endforeach; ?>	
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="resumo">Resumo</label>
				    	<input class="form-control" type="input" name="resumo"/>
					</div>

					<div class="form-group">
						<label for="conteudo">Conteúdo</label>
				    	<textarea name="conteudo" rows="10" class="form-control"></textarea>
					</div>

					<div class="form-group">
						<label for="img">Imagem</label>
				    	<input type="file" name="img"/>
					</div>
				    
					<input type="hidden" name="id" value=""/>
                    <?= csrf_field(); ?>
                 	<input type="submit" name="submit" class="btn btn-primary" value="Inserir" />
		</form>
                </div>
          </div>
		  	</div>
		  	<div class="col-md-12">
		  		 <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Notícias Cadastradas</h6>
                </div>
                <div class="card-body">
                  <table class="table table-bordered dataTable table-striped" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                  <thead>
                    <tr role="row">
						<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Imagem</th>
                    	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Notícia</th>
						<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Data</th>
						<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Destaque</th>
                    	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Alterar</th>
                    	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Excluir</th>
                    </tr>
                  </thead>
                  <tbody>
				 <?php foreach($noticias as $n):?>	
                  <tr role="row" class="odd">
					  <td>
					  	<?php if($n['img']):?>
						  <img src="/img/noticias/<?=$n['img']?>" style="width:100px">
						<?php else : ?>  
						  <img src="/img/semfoto.jpg" style="width:100px">
						<?php endif; ?>  
					  </td>	
                      <td class="sorting_1"><?=$n['titulo']?></td>
					  <td><?=date("d-m-Y H:i",strtotime($n['created_at']))?></td>
					  <td>
						<?php if($n['destaque'] == 1):?>
							<span class="text-success">SIM</span>
						<?php else: ?>
							<span class="text-danger">NÃO</span>
						<?php endif;?>
					  </td>
                      <td><a href="/controle/noticias/editar/<?=$n['id']?>"><i class="fas fa-edit"></i> Editar</a></td>
                      <td><a href="/controle/noticias/excluir/<?=$n['id']?>" onclick="return confirm('Confirma exclusão da notícia <?=$n['titulo']?>?');"><i class="fas fa-trash"></i> Excluir</a></td>
                   </tr>

					  <?php endforeach; ?>
                </tbody>
                </table>
				<?= $pager->links(); ?>
                </div>
          </div>
		  	</div>

		  </div>

        </div>
        <!-- /.container-fluid -->

<script src="/js/tinymce/tinymce.min.js"></script>
  <script>
    tinymce.init({ 
        language: 'pt_BR',
        selector:'textarea',
        theme: 'modern',
		plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount   imagetools contextmenu colorpicker textpattern code',
		toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat code',
		image_advtab: true,
		templates: [
			{ title: 'Test template 1', content: 'Test 1' },
			{ title: 'Test template 2', content: 'Test 2' }
		],
		content_css: [
			'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
			'//www.tinymce.com/css/codepen.min.css'
		]
		});
    </script>