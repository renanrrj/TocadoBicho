<?php
require_once "../mysql.php";

$nomeCatProduto = $_POST['nomeCatPro'];

$sqlNomeCatProduto = "SELECT * FROM tb_categoriaproduto where catpro_Nome = '$nomeCatProduto'"; # Verifica se em catpro_Nome já existe o digitado em nomeCatProduto
$listaNomeCatProduto = selectRegistros($sqlNomeCatProduto);

$validado = true;

if($listaNomeCatProduto != []){
    $validado = false;
    echo 'NÃO foi possível INSERIR';
}

# Geração de ID
$idCatPro =1;
$idCatProLivre = false;
while ($idCatProLivre == false){    
    $sqlIdCatProduto = "SELECT catpro_Id FROM tb_categoriaproduto WHERE catpro_Id = $idCatPro";
    $listaIdCatProduto = selectRegistros($sqlIdCatProduto);

    if($listaIdCatProduto == []){
        $idCatProLivre = true;
    }else{
        $idCatPro++;
    }
}

#Inserindo o Dado
if($validado){
    $sqlInCatPro = "INSERT INTO `tb_categoriaproduto`(catpro_Id, catpro_Nome) VALUES ($idCatPro, '$nomeCatProduto')";
    $resultdo = insereRegistro($sqlInCatPro);    
}else{
    echo 'dados inválidos';
}

?>
