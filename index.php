<?php require_once('helper.php'); ?>
<?php
	$template = array('title'=>'Memes 2.0', 'cssFile'=>'assets/css/memeStyle.css', 'cssSlider' => 'assets/css/flexslider.css', 'jsSlider' => 'assets/js/jquery.flexslider.js', 'jsInicio' => 'assets/js/inicio.js');
	crearTemplate($template, 'header');
?>
<div class="container">
	<div class="row">

	  <div class="col-md-6 fondo abajo">

		<h3><?= $template['title'] ?></h3>

		<form class="form-horizontal">

			<div class="form-group">
				<h4 style="font-size: 1em;">SELECCIONA UNA IMAGEN DEL CATÁLOGO</h4>
				<div class="flexslider" style="width: 100%">
	                <ul class="slides">
					
					<?php echo listarArchivos('images/'); ?>
	              
	                </ul>
	            </div>
				<h4 style="font-size: 1em;">O SELECCIONA UNA PROPIA</h4>
				<h4 style="font-size: .7em;">ÉSTA IMAGEN NO SE GUARDA EN EL CATÁLOGO</h4>
				
				<div class="container-fluid">
					<input type="file" id="imgSubir" name="imagenSeleccionada" class="form-control padding" />
				</div>

			</div>
			
			<div class="form-group">
				<div class="wrap">
					<div class="col-sm-10 mat-div">
						<label for="topLabel" class="mat-label">TEXTO SUPERIOR: </label>
						<input type="text" id="topLabel" class="mat-input " oninput="actualizaTexto(event)" />
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="wrap">
					<div class="col-sm-10 mat-div">
						<label for="bottomLabel" class="mat-label">TEXTO INFERIOR: </label>
						<input type="text" id="bottomLabel" class="mat-input" oninput="actualizaTexto(event)" />
					</div>
				</div>
			</div>

		</form>
	  </div>

		<div class="col-md-6 abajo">
	  	
			<canvas id="imgMemeCanvas" width="460" height="500"></canvas>
			<input type="hidden" id="imagenCargada" name="id" />

			<a id="descargar" download-button class="btn btn-success form-control" >Descargar MEME</a>

			
	  	</div>
		
	</div>
</div>


<?php crearTemplate(array(), 'footer'); ?>