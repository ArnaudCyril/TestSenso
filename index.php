<?php
	header("Content-Type: image/jpeg" ); 

	$sourceImg=$_GET['src'].".jpg";

	$im=imagecreatefromjpeg($sourceImg);
	
	$dst=imagecreatetruecolor(500,300);
	
	$blue=imagecolorallocate($dst,0,0,255);
	
	$red=imagecolorallocate($dst,255,0,0);

	$width=getimagesize($sourceImg)[0];
	$height=getimagesize($sourceImg)[1];
	
	
	imagefilledrectangle($dst,0,0,500,300,$blue);
	
	$margeLargeur=25;
	$margeHauteuR=25;

	/*bool imagecopyresampled ( resource $dst_image , resource $src_image , 
	int $dst_x , int $dst_y , int $src_x , int $src_y , 
	int $dst_w , int $dst_h , int $src_w , int $src_h )*/
	
	

	
	if($width<=$height) // si l'image est un portrait
	{
		$hauteurPtitCarre=(300-$margeHauteuR*3)/2;
		$largeurPtitCarre=$hauteurPtitCarre/$height*$width;
		
	}
	else
	{
		$largeurPtitCarre=(500-$margeLargeur*3);
		
		if($largeurPtitCarre>(500-$margeLargeur*3)/2)
		{
			$largeurPtitCarre=$largeurPtitCarre/2;
		}
		
		$hauteurPtitCarre=$largeurPtitCarre/$width*$height;
	}
	if($hauteurPtitCarre>(300-$margeHauteuR*3)/2)
	{
		$hauteurPtitCarre=$hauteurPtitCarre/2;
	}
	
	//echo "<br>".$largeurPtitCarre." ".$hauteurPtitCarre;
	

	imagecopyresampled($dst, $im, $margeLargeur, $margeHauteuR, 0, 0, $largeurPtitCarre, $hauteurPtitCarre,$width/2,$height/2);
	
	imagecopyresampled($dst, $im,500-$margeLargeur-$largeurPtitCarre, $margeHauteuR,$width/2,0,$largeurPtitCarre,$hauteurPtitCarre,$width/2,$height/2);
	
	imagecopyresampled($dst, $im, $margeLargeur,300-$margeLargeur-$hauteurPtitCarre, 0,$height/2,$largeurPtitCarre,$hauteurPtitCarre,$width/2,$height/2);
	
	imagecopyresampled($dst, $im, 500-$margeLargeur-$largeurPtitCarre, 300-$margeLargeur-$hauteurPtitCarre,$width/2,$height/2, $largeurPtitCarre,$hauteurPtitCarre,$width/2,$height/2);
	
	
	
	$txtSize=imagettfbbox(20,0,"./police.ttf","Test");
	
imagettftext($dst,30,0,20,165,$red,"./police.ttf","Je suis TDB");
	
	//imagedestroy($im);
	    
  imagejpeg($dst);
?>