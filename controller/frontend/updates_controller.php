<?php

if($_FILES["fileToUpload"]["name"]) {

    $file = $_FILES["fileToUpload"];
    $filename = $file["name"];
    $tmp_name = $file["tmp_name"];
    $type = $file["type"];

    $name = explode(".", $filename);
    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');

    if(in_array($type,$accepted_types)) { //If it is Zipped/compressed File
        $okay = true;
    }

    $continue = strtolower($name[1]) == 'zip' ? true : false; //Checking the file Extension

    if(!$continue) {
        $message = "The file you are trying to upload is not a .zip file. Please try again.";
    }

        $ran = $name[0];
        $targetdir = SERVER_ROOT.'/uploads/'.$ran;
        $targetzip = SERVER_ROOT.'/uploads/'.$ran.".zip";

        if(move_uploaded_file($tmp_name, $targetzip)) { //Uploading the Zip File

        /* Extracting Zip File */

        $zip = new ZipArchive();
        $x = $zip->open($targetzip);  // open the zip file to extract
        if ($x === true) {
            $zip->extractTo($targetdir); // place in the directory with same name
            $zip->close();

            unlink($targetzip); //Deleting the Zipped file
        }


        $getfile = $targetdir.'/upgrade.json';
        if(file_exists($getfile))
        $resultjson = file_get_contents($getfile);
        $jsonarray = json_decode($resultjson, true);

        /* echo "<pre>";
         print_r($jsonarray);
         echo "</pre>";*/
        if (is_array($jsonarray)){
         foreach ($jsonarray as $key=>$valv){

         	$file_name= $targetdir.'/'.$key;
            $path= SERVER_ROOT.'/'.$valv.$key;

         	if(file_exists($path))
         	{
         		unlink($path);
         		file_put_contents($path, '');
         		copy($file_name, $path);

         		$display_msg='<div class="alert alert-success">
				<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>
         				"Your <strong>{$ran}.zip</strong> file was uploaded and unpacked.You should Logout to restore settings."
				</div>';
         	}
         	else
         	{
		           file_put_contents($path, '');
		           copy($file_name, $path);

		           $display_msg='<div class="alert alert-success">
				<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>
         				"Your <strong>{$ran}.zip</strong> file was uploaded and unpacked.You should Logout to restore settings"
				</div>';
         	}
         }}

 } else {
 	          $display_msg='<div class="alert alert-danger">
				<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>
         				"There was a problem with the upload. Please try again."
				</div>';

    }
}


?>