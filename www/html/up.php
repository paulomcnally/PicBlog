<?php

require_once 'load.php';





ini_set("file_uploads","On");

ini_set("upload_max_filesize",50);

ini_set("max_execution_time",-1);

ini_set('max_input_time', -1);

ini_set("memory_limit",-1);

ini_set("post_max_size",50);



if (isset( $_POST["aid"] ) )

	{

	$aid = $_POST["aid"];

	}



	$photobucket_api_folder = "picblog";

	$photobucket_folder = $GLOBALS['mysql']->value("SELECT screen_name FROM albums WHERE aid = '".$aid."'");





	$allowedtypes = array("jpg","png");

	

	$c_error = 0;

	$c_valid = 0;

	$message = "";

	$return="";

  	// Edit upload location here

   	$destination_path = getcwd().DIRECTORY_SEPARATOR;

	//Inicializamos El resultado como 0

   	$result = 0;

	//Tamaño maximo de archivo (PESO MAXIMO)

	$max_size = 20971520; //20MB en Byte (http://www.wilkinsonpc.com.co/free/articulos/calculadorabytes.html)

	$max_size_mb = $max_size*(1024/$max_size);

	//Carpeta donde se subira el archivo

	$folder="images/";

	//Variable $filename = al archivo que obtenemos

	$filename = $_FILES['Filedata']['name']; 

	$filesize = $_FILES['Filedata']['size'];

	//Agregamos el ramdom obtenido al nombre de la imagen

	//$filename = date("Y-m-d_H-i-s") . substr($filename,-4,strlen($filename));

	$fileExtension = end( explode( ".", $filename ) );

	$filename = md5($photobucket_folder.date("Y-m-d H:i:s").rand(5,15)).".". $fileExtension;

	//Ruta de subida de la imagen

   	$target_path = $destination_path . $folder . $filename;

	//Ruta para windows

if(isset($allowedtypes))

	{

	$allowed = 0;

	foreach($allowedtypes as $ext)

		{

 		if($fileExtension == $ext)

			{

			//Extención permitida

    		$allowed = 1;

			}

		}

	if($allowed==0)

		{

		//Extención no permitida

		die('File extension not in '.implode(",",$allowedtypes));

		}

		else

			{

			if ($filesize>$max_size)

				{

				die('File size limit is '.$max_size_mb);

				}

				else

					{	

					if(@move_uploaded_file($_FILES['Filedata']['tmp_name'], $target_path))

						{

						require_once 'ftp.php';

						$ftp = new Ftp( "ftp.photobucket.com", "", "" ); // Create pro account on photobucket.com

						if( $ftp->set_chdir( $photobucket_api_folder ) )

							{

							if( $ftp->make_dir( $photobucket_folder ) )

								{

								if( $ftp->set_chdir( $photobucket_folder ) )

									{

									if( $ftp->make_dir( "album" . $aid ) )

										{

										if( $ftp->set_chdir( "album" . $aid ) )

											{

											if( $ftp->put( $target_path ) )

												{

												$short = shorturl( $aid . $ftp->new_file_name );

												$GLOBALS['mysql']->query("CALL SP_ws_add_photo('".$ftp->new_file_name."','".$short."','".$aid."')");

												@unlink($target_path);

												}

											}

										}

									}

								}

							}

						}

						else

							{

							die('Folder require permission 777"');

							}

					}

				

   			sleep(1);	

			}

	}

?>