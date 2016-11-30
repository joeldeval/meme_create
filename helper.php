<?php

	/**
	 * "Spews" out header code from header.php file
	 * @param $arr An array which holds such information as page title, css files etc..
	 * @param $file Name of file from which code should be spued from
	 */
	function crearTemplate($arr = array(), $file){
		extract($arr); // takes array and creates global variables out of array data. Variable name: array key, Variable value: corresponding array value
		require($file . '.php'); // "spits" out the code found in 'header.php'. Has access to global variables created from extract($arr)
	}

	function listarArchivos($carpeta){
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

?>