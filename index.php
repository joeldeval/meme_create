<?php require_once('helper.php'); ?>
<?php
	$template = array('title'=>'Memes 2.0', 'cssFile'=>'assets/css/memeStyle.css', 'cssSlider' => 'assets/css/flexslider.css', 'jsSlider' => 'assets/js/jquery.flexslider.js', 'jsInicio' => 'assets/js/inicio.js');
	crearTemplate($template, 'header');
?>

<div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?= $template['title'] ?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Meme generator</a></li>
              <li><a href="http://www.jvaldivia.org/">Regresar al blog</a></li>
              <li><a href="http://www.jvaldivia.org/cursos">Cursos</a></li>
             
            </ul>
           
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="row">

		  <div class="col-md-6 fondo abajo">

			<form class="form-horizontal">

				<!-- <div class="form-group"> -->
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

				<!-- </div> -->
				
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

    </div> <!-- /container -->

  <!--   
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
</div> -->


<?php crearTemplate(array(), 'footer'); ?>