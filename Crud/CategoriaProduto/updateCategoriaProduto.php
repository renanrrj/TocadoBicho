<?php
require_once '../mysql.php';

$idCatProduto = $_POST['idCatPro'];
$nomeCatProduto = $_POST['nomeCatPro'];

$validado = true;

$listaCatPro = [];

# Conferencia: se diferente de numerico validado se torna falso
if(!is_numeric($idCatProduto)){
    $validado = false;
}else{
    $sqlIdCatPro = "SELECT * FROM tb_categoriaproduto WHERE catpro_Id = $idCatProduto";
    $listaCatPro = selectRegistros($sqlIdCatPro);
}

# Verifica se há matéria com esse Id para poder altera-la
if($listaCatPro == []){
    $validado = false;
    echo 'Edição não permitida - ';
}

if($validado){
    $sqlUpCatPro = "UPDATE `tb_categoriaproduto` SET `catpro_Nome` = '$nomeCatProduto' WHERE `catpro_Id` = $idCatProduto";
    $resultado = updateRegistro($sqlUpCatPro);
}

?>
