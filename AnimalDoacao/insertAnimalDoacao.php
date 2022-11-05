<?php
require_once "../mysql.php";

$nomeAnimal = $_POST['ani_Nome'];
$racaAnimal = $_POST['ani_Raca'];
$kgAnimal = $_POST['ani_Peso'];
$cmAnimal = $_POST['ani_Altura'];
$endeAnimal = $_POST['ani_Endereco'];


$sqlAnimal = "SELECT * FROM tb_animal where ani_Nome = '$nomeAnimal'";
$listaAnimal = selectRegistros($sqlAnimal);

$validado = true;

if($listaAnimal != []){
    $validado = false;
    echo 'NÃO foi possível INSERIR';
}

# Geração de ID
$idAnimal =1;
$idAnimalLivre = false;
while ($idAnimalLivre == false){    
    $sqlIdAnimal = "SELECT ani_Id FROM tb_animal WHERE ani_Id = $idAnimal";
    $listaIdAnimal = selectRegistros($sqlIdAnimal);

    if($listaIdAnimal == []){
        $idAnimalLivre = true;
    }else{
        $idAnimal++;
    }
}

#Inserindo o Dado
if($validado){
    $sqlInAnimal = "INSERT INTO `tb_animal`(ani_Id, ani_Nome, ani_Raca, ani_Peso, ani_Altura, ani_Endereco) VALUES ($idAnimal, '$nomeAnimal', '$racaAnimal', $kgAnimal, $cmAnimal, '$endeAnimal')";
    $resultdo = insereRegistro($sqlInAnimal);    
}else{
    echo 'dados inválidos';
}

?>