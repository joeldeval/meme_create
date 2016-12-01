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

				<input type="file" id="imgSubir" name="imagenSeleccionada" class="form-control" />

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
<output id="list"></output>

<script>

  function subirImagen(evt) {
    var imagenes = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = imagenes[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
      	alert("El archivo no se cargará porque no es una imagen.");
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          cargaImagenMeme(e.target.result);
          document.getElementById('imagenCargada').value = e.target.result;
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('imgSubir').addEventListener('change', subirImagen, false);
</script>


</div>


<?php crearTemplate(array(), 'footer'); ?>