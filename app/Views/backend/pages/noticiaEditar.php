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
					<h6 class="m-0 font-weight-bold text-primary">Editar Notícia</h6>
				</div>
				<div class="card-body">
					<form action="<?= base_url('controle/noticias/gravar') ?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="destaque" class="form-check-label" value="1" 
										<?php if($noticias['destaque'] == 1) echo 'checked'; ?>/> Em Destaque
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="titulo">Título</label>
							<input class="form-control" type="input" name="titulo" value="<?=$noticias['titulo']?>"/>
						</div>

						<div class="form-group">
							<label for="categoria">Categoria</label>
							<div class="form-group">
								<select name="categoria" class="form-control" tabindex="-1" >
									<option value="">Selecione...</option>
									<?php foreach ($categorias as $cat):?>
										<option value="<?=$cat['id']?>" 
											<?php if($cat['id'] == $noticias['cat']) echo 'selected' ?>><?=$cat['titulo']?></option>
									<?php endforeach; ?>	
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="resumo">Resumo</label>
							<input class="form-control" type="input" name="resumo" value="<?=$noticias['resumo']?>"/>
						</div>

						<div class="form-group">
							<label for="conteudo">Conteúdo</label>
							<textarea name="conteudo" rows="10" class="form-control"><?=$noticias['conteudo']?></textarea>
						</div>

						<div class="form-group">
							<label for="img">Imagem</label>
							<input type="file" name="img"/>
						</div>
						
						<input type="hidden" name="id" value="<?=$noticias['id']?>"/>
						<?= csrf_field(); ?>
						<input type="submit" name="submit" class="btn btn-primary" value="Gravar" />
					</form>
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