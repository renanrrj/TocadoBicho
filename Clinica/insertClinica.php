<?php
require_once "../mysql.php";

$nomeClinica = $_POST['nomeClin'];
$telClinica = $_POST['telClin'];
$endeClinica = $_POST['endeClin'];

$sqlClinica = "SELECT * FROM tb_clinica where clin_Nome = '$nomeClinica'"; # Verifica se em catpro_Nome já existe o digitado em nomeCatProduto
$listaClinica = selectRegistros($sqlClinica);

$validado = true;

if($listaClinica != []){
    $validado = false;
    echo 'NÃO foi possível INSERIR';
}

# Geração de ID
$idClinica =1;
$idClinicaLivre = false;
while ($idClinicaLivre == false){    
    $sqlIdClinica = "SELECT clin_Id FROM tb_clinica WHERE clin_Id = $idClinica";
    $listaIdClinica = selectRegistros($sqlIdClinica);

    if($listaIdClinica == []){
        $idClinicaLivre = true;
    }else{
        $idClinica++;
    }
}

#Inserindo o Dado
if($validado){
    $sqlInClinica = "INSERT INTO `tb_clinica`(clin_Id, clin_Nome, clin_Telefone, clin_Endereco) VALUES ($idClinica, '$nomeClinica', '$telClinica', '$endeClinica')";
    $resultdo = insereRegistro($sqlInClinica);    
}else{
    echo 'dados inválidos';
}

?>