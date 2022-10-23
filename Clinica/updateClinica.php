<?php
require_once '../mysql.php';

$idClinica = $_POST['idClin'];
$nomeClinica = $_POST['nomeClin'];
$telClinica = $_POST['telClin'];
$endeClinica = $_POST['endeClin'];


$validado = true;

$listaClinica = [];

# Conferencia: se diferente de numerico validado se torna falso
if(!is_numeric($idClinica)){
    $validado = false;
}else{
    $sqlIdClinica = "SELECT * FROM tb_clinica WHERE clin_Id = $idClinica";
    $listaClinica = selectRegistros($sqlIdClinica);
}

# Verifica se há matéria com esse Id para poder altera-la
if($listaClinica == []){
    $validado = false;
    echo 'Edição não permitida - ';
}

if($validado){
    $sqlUpClinica = "UPDATE `tb_clinica` SET `clin_Nome` = '$nomeClinica', `clin_Telefone` ='$telClinica', `clin_Endereco` = '$endeClinica'  WHERE `clin_Id` = $idClinica";
    $resultado = updateRegistro($sqlUpClinica);
}

?>