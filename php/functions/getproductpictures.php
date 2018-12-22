<?php
function getProductPictures($index){
	$images=array();
	
	for($i=0;$i<10;$i++){
		$filename=$index."-".$i.".jpg";
		$filepath = "assets/images/$filename";
		
		if (file_exists($filepath)){
			$images[]=$filename;
		}
	}
	
	return $images;
}