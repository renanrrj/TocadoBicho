<?php
require_once '../mysql.php';

$idClinica = $_POST['idClin'];

$validado = true;

$listaClinica = [];

# Conferencia: se diferente de numerico validado se torna falso
if(!is_numeric($idClinica)){
    $validado = false;
}else{
    $sqlIdClin = "SELECT * FROM tb_clinica WHERE clin_Id = $idClinica";
    $listaClinica = selectRegistros($sqlIdClin);
}

# Verifica se há matéria com esse Id para poder deleta-la
if($listaClinica=[]){
    $validado = false;
    echo "Deleção NÃO permitida, Id não encontrado";
}
if($validado){
    $sqlDelClinica = "DELETE FROM `tb_clinica` WHERE `clin_Id` = $idClinica";
    $resultado = deleteRegistro($sqlDelClinica);
}

?>