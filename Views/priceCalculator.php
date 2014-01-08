<?php

class priceCalculator {
	
	public static function Calculator($params){
		$allTerminationPrice = self::getTerminationsSelected($params);
		$finishPrice = 0;
		$cmHojaA4 = 630;
		$ganancia = 1.5;
		$fijoNegro = 25;
		$fijo1color = 40;
		$fijo2colores = 80;
		$height = '';
		$width = '';
		$width = '';
		$amount = $params['amount'];
		$height = $params['height'];
		$width = $params['width'];
		$paper = PaperModel::FindById($params['paper']);
		$paperPrice = $paper->getValue();
		$machinePrint = MachineModel::FindById($params['print']);
		$machinePrintPrice = self::getDiscountPrice($amount, $height, $width, $machinePrint);
		if($params['type'] == 'Frente'){
			$typePrint = 1;
		} else {
			$typePrint = 1.7;
		}
		$design = DesignModel::FindById($params['design']);
		$designPrice = $design->getValue();		
		$cut= CutModel::FindById($params['cut']);
		$cutPrice = $cut->getValue();							
		if ($machinePrint->getName() == 'Offset B/N'){
				$price = (($amount * $height * $width) * (($paperPrice + ($machinePrintPrice * $typePrint) + $allTerminationPrice) / $cmHojaA4)) + $designPrice + $cutPrice + $fijoNegro;
			} elseif($machinePrint->getName() == 'Offset 1 Color'){
				$price = (($amount * $height * $width) * (($paperPrice + ($machinePrintPrice * $typePrint) + $allTerminationPrice) / $cmHojaA4)) + $designPrice + $cutPrice + $fijo1color;
			} elseif($machinePrint->getName() == 'Offset 2 Colores'){
				$price = (($amount * $height * $width) * (($paperPrice + ($machinePrintPrice * $typePrint) + $allTerminationPrice) / $cmHojaA4)) + $designPrice + $cutPrice + $fijo2colores;
			} else { $price = (($amount * $height * $width) * (($paperPrice + ($machinePrintPrice * $typePrint) + $allTerminationPrice) / $cmHojaA4)) + $designPrice + $cutPrice;}
		return $price*$ganancia;	
	}
	
	public static function getTerminationsSelected($array){
		$terminations = TerminationModel::FetchAll();
		if(!empty($array)){
			$terminationPrice = 0;
			foreach($array as $property=>$value){
				foreach($terminations as $termination){		
					if ($termination->getName() == $property){
						$terminationPrice += $value; 
					}
				}
			}
		}
		return $terminationPrice;
	}
	
	public static function getDiscountPrice($amount, $height, $width, $machine){
		$finalPrice	= $machine->getValue();
		if($machine->getName() == 'Offset B/N' || $machine->getName() == 'Offset 1 Color'){
			if(($amount*$height*$width) >= 748100 && ($amount*$height*$width) <= 2244000){
				$finalPrice = 0.042; 
			} elseif(($amount*$height*$width) >= 2244001){
				$finalPrice = 0.036; 
			} 
		}
		if($machine->getName() == 'Offset 2 Colores'){
			if(($amount*$height*$width) >= 748100 && ($amount*$height*$width) <= 2244000){
				$finalPrice = 0.084; 
			} elseif(($amount*$height*$width) >= 2244001){
				$finalPrice = 0.072; 
			} 
		}
		if($machine->getName() == 'Duplicacion'){
			if(($amount*$height*$width) >= 748100 && ($amount*$height*$width) <= 2244000){
				$finalPrice = $finalPrice * 0.8; 
			} elseif(($amount*$height*$width) >= 2244001){
				$finalPrice = $finalPrice * 0.6;
			} 
		}
		if($machine->getName() == 'Laser Color'){
			if(($amount*$height*$width) >= 31500 && ($amount*$height*$width) <= 73000){
				$finalPrice = $finalPrice * 0.85; 
			} elseif(($amount*$height*$width) >= 73001){
				$finalPrice = $finalPrice * 0.65;
			} 
		}
		if($machine->getName() == 'Laser Color'){
			if(($amount*$height*$width) >= 31500 && ($amount*$height*$width) <= 73000){
				$finalPrice = $finalPrice * 0.85; 
			} elseif(($amount*$height*$width) >= 73001){
				$finalPrice = $finalPrice * 0.65;
			} 
		}
		return $finalPrice;
	}
}
