 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Categorias</h1>

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
                  <h6 class="m-0 font-weight-bold text-primary">Editar Categorais</h6>
                </div>
                <div class="card-body">
				<form action="<?= base_url('controle/categorias/gravar') ?>" method="post">

                    <div class="form-group">
						<label for="titulo">Título</label>
				    	<input class="form-control" type="input" name="titulo" value="<?=$categorias['titulo']?>"/>
					</div>

					<div class="form-group">
						<label for="resumo">Resumo</label>
				    	<input class="form-control" type="input" name="resumo" value="<?=$categorias['resumo']?>"/>
					</div>
				    
					<input type="hidden" name="id" value="<?=$categorias['id']?>"/>
                    <?= csrf_field(); ?>
                 	<input type="submit" name="submit" class="btn btn-primary" value="Gravar" />
		</form>
                </div>
          </div>
		  	</div>


		  </div>

        </div>
        <!-- /.container-fluid -->