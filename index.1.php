<?php
	header("Content-Type: image/jpeg" ); 

	$im=imagecreatefromjpeg("./tdb.jpg");
	
	//imagepng($im);
	
	//var_dump(getimagesize("./Desert.jpg"));
	
	//var_dump(imagesx($im));
	
	//var_dump(imagesy($im));
	
	$dst=imagecreatetruecolor(512,384);
	
	$green=imagecolorallocate($dst,0,255,0);
	
	imagefilledrectangle($dst,0,0,532,404,$green);
	
	imagecopyresampled($dst,$im,10,10,0,0,512,384,1024,1024);
	
	
	$txtSize=imagettfbbox(20,0,"./police.ttf","Je suis Musique");
	
	imagettftext($dst,20,0,((532- $txtSize[2] - 2) / 2),200,$green,"./police.ttf","Chibron \r\n Chibron \r\n Chibron");
	
	imagedestroy($im);
	
	imagejpeg($dst);
?>