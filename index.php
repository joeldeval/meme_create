<?php require_once('helper.php'); ?>
<?php
	$arr = array('title'=>'Memes 1.1', 'cssFile'=>'memeStyle.css');
	createTemplate($arr, 'header');
?>
<div class="container">
	<div class="row">

	  <div class="col-md-6">
		<h3><?= $arr['title'] ?></h3>
		<form class="form-horizontal">
			<div class="form-group">
				<h4 style="font-size: 1em;">SELECCIONA UNA IMAGEN</h4>
				<h4 style="font-size: .8em;">y mueve con flechas de teclado</h4>
				<div class="flexslider" style="width: 100%">
                <ul class="slides">
				
				<?php

				function listar_archivos($carpeta){
			   		if(is_dir($carpeta)){
				        if($dir = opendir($carpeta)){
				            while(($archivo = readdir($dir)) !== false){
				                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
				               
				                    echo '<li>
                                        <div style="width:100%; ">
                                        	<div class="img-slide" id="'.$archivo.'" style="width:120px">
                                                <img style="width: 100px; height: 100px;" src="'.$carpeta.'/'.$archivo.'" />
                                            </div>
                                        </div>
                                    </li>';
				                }
				            }
				            closedir($dir);
				        }
				    }
				}
			 
				echo listar_archivos('images/');
				?>
              
                </ul>
            </div>
			</div>
			<div class="form-group">
				<label for="topLabel" class="col-sm-4 control-label">Texto de arriba: </label>
				<div class="col-sm-8">
					<input type="text" id="topLabel" class="form-control" placeholder="Ej. Y si techamos GDL" oninput="textUpdate(event)" />
				</div>
			</div>
			<div class="form-group">
				<label for="bottomLabel" class="col-sm-4 control-label">Texto de abajo: </label>
				<div class="col-sm-8">
					<input type="text" id="bottomLabel" class="form-control" placeholder="Ej. y PUM! wey adios SOL" oninput="textUpdate(event)" />
				</div>
			</div>
		</form>
	  </div>

		<div class="col-md-6 abajo">
	  	
			<canvas id="c" width="460" height="500"></canvas>
			<input type="hidden" id="producto" name="id" />
			
			<a id="descargar" class="btn btn-primary" >Descargar MEME</a>

	  	</div>
		
	</div>

</div>

<script type="text/javascript">
	var canvas = document.querySelector('#c');
	var	context = canvas.getContext('2d');
	context.textAlign = 'center';
	context.fillStyle = 'white';
	context.strokeStyle = 'black';
	var img = new Image();
	//create Text Objects which hold text String, size variable, and any other future value we may decide to add
	var Text = function(){
		this.text = "";
		this.size = 50;
	};
	Text.prototype = {
		/** Dilates (enlarges) text by factor of 10, then sets new text size into canvases context Object */
		dilate : function(){
			this.size += 2;
		context.font = this.size + "pt Impact";
		},
		/** Shrinks text by factor of 10, then sets new text size into canvases context Object */
		shrink : function(){
			this.size -= 2;
			context.font = this.size + "pt Impact";
		}
	};
	var topText = new Text();
	var bottomText = new Text();

	window.onload = function(){ //initial image setup
		updateMeme("joel.jpg");
	};

	function textUpdate(event){
		// find out which element fired event (event.target.id) and assign inputted text with corresponding global text variable (topText / bottomText)
		if (event.target.id == "topLabel"){
			topText.text = event.target.value.toUpperCase();
		} else {
			bottomText.text = event.target.value.toUpperCase();
		}
		var imagenSeleccionada = document.getElementById('producto').value;

		if(imagenSeleccionada == ""){

			imagenSeleccionada = "joel.jpg"
		}		
		updateMeme(imagenSeleccionada);
	}
	
	function updateMeme(imagen){
		context.clearRect(0, 0, canvas.width, canvas.height);
		loadMemeImage("images/" + imagen);
	}
	
	function loadMemeImage(rutaImagen){
		img = new Image();
		img.onload = function(){
			context.drawImage(img, 0, 0, canvas.width, canvas.height);
			loadMemeText();
		};
		img.src = rutaImagen;
	}


	function loadMemeText(){
		//top text
		context.font = topText.size + "pt Impact";
		var textWidth = context.measureText(topText.text).width; // width of text before being written to canvas
		if (textWidth >= canvas.width-50 && topText.size >= 30) { //text too big must be minimised
			topText.shrink();
		} else if (textWidth <= canvas.width/2 && topText.size <= 50) {
			topText.dilate();
		}
		context.fillText(topText.text, canvas.width/2, topText.size+20);
		context.strokeText(topText.text, canvas.width/2, topText.size+20);

		//bottom text
		context.font = bottomText.size + "pt Impact";
		textWidth = context.measureText(bottomText.text).width;
		if (textWidth >= canvas.width-50 && bottomText.size >= 30) { //text too big must be minimised
			bottomText.shrink();
		} else if (textWidth <= canvas.width/2 && bottomText.size <= 50) {
			bottomText.dilate();
		}
		context.fillText(bottomText.text, canvas.width/2, canvas.height-20);
		context.strokeText(bottomText.text, canvas.width/2, canvas.height-20);
	}

	function downloadCanvas(link, canvasId, filename) {
    	link.href = document.getElementById(canvasId).toDataURL();
	    link.download = filename;
	}

	/** 
	 * The event handler for the link's onclick event. We give THIS as a
	 * parameter (=the link element), ID of the canvas and a filename.
	*/
	document.getElementById('descargar').addEventListener('click', function() {
		var imagen = $("#producto").val();
		if(imagen == ""){
			imagen = "joel.jpg"
		}
		var fecha = new Date();

	    downloadCanvas(this, 'c', "meme_"+fecha.getDate() + imagen);
	}, false);

	  $(document).ready(function () {
        //se declaran variables
        var producto = $("#producto").val();
        // muestra la flecha roja en el paso
        $(".red-arrow:not(.select-producto)").css("visibility", "hidden");

        // detecta si eligió un producto y pinta el marco azul
        if (producto != "" || producto != undefined) {
            $(".img-slide").css("background-color", "");
            $("#" + producto).css("background-color", "#185CA6");
        }

        //slider
        $('.flexslider').flexslider({
            animation: "slide",
            animationLoop: false,
            itemWidth: 250,
            itemMargin: 3,
            slideshow: false,
            controlNav: false,
            directionNav: true
        });
    });
	     // click en algún producto
    $(".img-slide").click(function () {
        //se declaran variables
        var imagen = $(this).attr('id');
        // console.log(imagen)
        updateMeme(imagen);
        // pinta el marco azul del producto que eligió
        $("#producto").val(imagen);
        $(".img-slide").css("background-color", "");
        $(this).css("background-color", "#185CA6");
    });


</script>
<?php createTemplate(array(), 'footer'); ?>