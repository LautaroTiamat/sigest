<?php
function sessionVerify(){
    if(isset($_SESSION['logged_in'])){
        header('Location: panel/index.php');
        exit;
    }
}

function sessionPanelVerify(){
    if(!isset($_SESSION['logged_in'])){
        header('Location: ../login.php');
        exit;
    }
}

function userRank(){
    if($_SESSION['rank'] < 1){
        header('Location: index.php');
    }
}

function validar_cuil($cuil){
	//$cuil = str_replace('-','',trim($cuil));
	
	if(!is_numeric($cuil) || $cuil == '00000000000' || strlen($cuil) !== 11){
        return false;
    }
	
	$factores = array(5,4,3,2,7,6,5,4,3,2);
	$sumatoria = 0;
	
	for($i=0; $i < strlen($cuil)-1; $i++){
		$sumatoria += (substr($cuil,$i,1) * $factores[$i]);
	}
	
    $resto = $sumatoria % 11;
    // La expresión (A) ? (B) : (C) evalúa a "B" si "A" se evalúa como TRUE y a "C" si "A" se evalúa como FALSE.
	$digitoVerificador = ($resto != 0) ? 11 - $resto : $resto;
	
	return ($digitoVerificador == substr($cuil, strlen($cuil)-1));
}

?>