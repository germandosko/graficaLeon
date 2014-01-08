<?php

class ImageSave {
	public function __construct(){
	}
	public function Save($_POST){
		if(!isset($_POST['x']) || !isset($_POST['y']) || !isset($_POST['w']) || !isset($_POST['h'])){
			throw new Exception('Unable to get image with empty x, y, w and h values');
		}
		$image = new ImageNew($_POST['path']);
		$image->resample($_POST['x'], $_POST['y'], $_POST['w'], $_POST['h'], 75, 75);
		$filePath = str_replace('\\','/',$_POST['pathSave']);
		
		$result = $image->exportTo(ImageNew::MIME_PNG, $filePath,'_a');
	}
	public function Save2($_POST){
		if(!isset($_POST['x']) || !isset($_POST['y']) || !isset($_POST['w']) || !isset($_POST['h'])){
			throw new Exception('Unable to get image with empty x, y, w and h values');
		}
		$width = 1;
		$height = 1;
		$this->calculateSizes($_POST['w'], $_POST['h'], $width, $height);
		if($width == 1 || $height == 1){
			return false;
		} else {			
			$image = new ImageNew($_POST['path']);
			$image->addImageWatermark(new ImageNew('../resources/img/logoColorGris.png'), $position=ImageNew::POSITION_MIDDLE_CENTER, 10);
			//$image->addTextWatermark('MUESTRA', 'PS_7.TTF', 20, 10, array(0,144,144,144), ImageNew::POSITION_MIDDLE_RIGHT);			
			$image->resample($_POST['x'], $_POST['y'], $_POST['w'], $_POST['h'], $width, $height);
			
			//$image->addTextWatermark('MUESTRA', '/fonts/arial.ttf');			

			$filePath = str_replace('\\','/',$_POST['pathSave']);
			$result = $image->exportTo(ImageNew::MIME_PNG, $filePath,'_b');
			return true;
		}
	}
	
	public function calculateSizes($w, $h, &$width, &$height){
		$width = intval($w);
		$height = intval($h);
		
		if ($width > 500 && $height>$width){
			$porc =  ($height/500);
			$height = intval($height/$porc);
			$width = intval($width / $porc);
			if ($width<1){
				$width = 1;
			}  			
		} elseif ($width > 500 && $height<$width){			
  			$porc =  ($width/500);
			$width = intval($width/$porc);			
			$height = intval($height / $porc);
			if ($height<1){
				$height = 1;
			}
		}elseif ($height > 500 && $width < 500){			
			$porc =  ($height/500);
			$height = intval($height/$porc);
			$width = intval($width / $porc);
			if ($width<1){
				$width = 1;
			}  			
		}elseif ($width > 500 && $height < 500){			
			$porc =  ($width/500);
			$width = intval($width/$porc);			
			$height = intval($height / $porc);
			if ($height<1){
				$height = 1;
			}  			
		}elseif ($width < 500 && $height < $width){			
			$porc = (500/$width);
			$width = intval($width * $porc);
			$height = intval($height * $porc);			
		}elseif ($height < 500 && $width < $height){			
			 $porc = (500/$height);
			$height = intval($height * $porc);
			$width = intval($width * $porc);			
		}
	}
}