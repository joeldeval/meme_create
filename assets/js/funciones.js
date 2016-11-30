
	// objeto de TEXTOS crea variables texto, y size
	var Texto = function(){
		this.text = "";
		this.size = 80;
	};
	Texto.prototype = {
		/** ampliar texto dentro de canvas */
		ampliar : function(){
			this.size += 10;
			contenidoCanvas.font = this.size + "pt Impact";
		},
		/** contrae texto dentro de canvas */
		contraer : function(){
			this.size -= 5;
			contenidoCanvas.font = this.size + "pt Impact";
		}
	};

	function actualizaTexto(evento){
		// detecta que elemento activó y asigna texto introducido al texto
		if (evento.target.id == "topLabel"){
			textoSuperior.text = evento.target.value.toUpperCase();
		} else {
			textoInferior.text = evento.target.value.toUpperCase();
		}
		var imagenSeleccionada = document.getElementById('imagenCargada').value;

		if(imagenSeleccionada == ""){

			imagenSeleccionada = "joel.jpg"
		}		
		actualizaMeme(imagenSeleccionada);
	}
	
	function actualizaMeme(imagen){
		contenidoCanvas.clearRect(0, 0, imgCanvas.width, imgCanvas.height);
		cargaImagenMeme("images/" + imagen);
	}
	
	function cargaImagenMeme(rutaImagen){
		img = new Image();
		img.onload = function(){
			contenidoCanvas.drawImage(img, 0, 0, imgCanvas.width, imgCanvas.height);
			cargaTextoMeme();
		};
		img.src = rutaImagen;
	}


	function cargaTextoMeme(){
		//texto superior
		contenidoCanvas.font = textoSuperior.size + "pt Impact";

		// ancho de texto antes de ser escrito en el lienzo
		var anchoTexto = contenidoCanvas.measureText(textoSuperior.text).width; 
		
		// texto demasiado grande debe ser minimisado
		if (anchoTexto >= imgCanvas.width-50 && textoSuperior.size >= 30) {
			textoSuperior.contraer();
		} else if (anchoTexto <= imgCanvas.width/2 && textoSuperior.size <= 50) {
			textoSuperior.ampliar();
		}

		contenidoCanvas.fillText(textoSuperior.text, imgCanvas.width/2, textoSuperior.size+20);
		contenidoCanvas.strokeText(textoSuperior.text, imgCanvas.width/2, textoSuperior.size+20);

		//texto inferior
		contenidoCanvas.font = textoInferior.size + "pt Impact";
		anchoTexto = contenidoCanvas.measureText(textoInferior.text).width;

		// texto demasiado grande debe ser minimisado
		if (anchoTexto >= imgCanvas.width-50 && textoInferior.size >= 30) {
			textoInferior.contraer();
		} else if (anchoTexto <= imgCanvas.width/2 && textoInferior.size <= 50) {
			textoInferior.ampliar();
		}

		contenidoCanvas.fillText(textoInferior.text, imgCanvas.width/2, imgCanvas.height-20);
		contenidoCanvas.strokeText(textoInferior.text, imgCanvas.width/2, imgCanvas.height-20);
	}

	function descargarCanvas(link, canvasId, archivo) {
    	link.href = document.getElementById(canvasId).toDataURL();
	    link.download = archivo;
	}


		/** 
	 * The event handler for the link's onclick event. We give THIS as a
	 * parameter (=the link element), ID of the canvas and a filename.
	*/
	document.getElementById('descargar').addEventListener('click', function() {
		var imagen = $("#imagenCargada").val();

		if(imagen == ""){
			imagen = "joel.jpg"
		}
		var fecha = new Date();

	    descargarCanvas(this, 'imgMemeCanvas', "meme_"+fecha.getDate() + imagen);

	}, false);

	  $(document).ready(function () {
        //se declaran variables
        var imagenCargada = $("#imagenCargada").val();
        // muestra la flecha roja en el paso
        $(".red-arrow:not(.select-producto)").css("visibility", "hidden");

        // detecta si eligió un producto y pinta el marco azul
        if (imagenCargada != "" || imagenCargada != undefined) {
            $(".img-slide").css("background-color", "");
            $("#" + imagenCargada).css("background-color", "#489cdf");
        }

        //slider
        $('.flexslider').flexslider({
            animation: "slide",
            animationLoop: true,
            itemWidth: 110,
            itemMargin: 3,
            slideshow: true,
            controlNav: true,
            directionNav: true
        });
    });

	     // click en algún producto
    $(".img-slide").click(function () {
        //se declaran variables
        var imagen = $(this).attr('id');
        // console.log(imagen)
        actualizaMeme(imagen);
        // pinta el marco azul del producto que eligió
        $("#imagenCargada").val(imagen);
        $(".img-slide").css("background-color", "");
        $(this).css("background-color", "#489cdf");
    });

    $(".mat-input").focus(function(){
	  $(this).parent().addClass("is-active is-completed");
	});

	$(".mat-input").focusout(function(){
	  if($(this).val() === "")
	    $(this).parent().removeClass("is-completed");
	  $(this).parent().removeClass("is-active");
	})