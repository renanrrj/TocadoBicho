<?php
require_once "../mysql.php";

$nomeAnimal = $_POST['nomeAni'];
$racaAnimal = $_POST['racaAni'];
$kgAnimal = $_POST['kgAni'];
$cmAnimal = $_POST['cmAni'];
$endeAnimal = $_POST['endeAni'];
$idadeAnimal = $_POST['idadeAni'];


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
    $sqlInAnimal = "INSERT INTO `tb_animal`(ani_Id, ani_Nome, ani_Raca, ani_Peso, ani_Altura, ani_Endereco, ani_Idade) VALUES ($idAnimal, '$nomeAnimal', '$racaAnimal', $kgAnimal, $cmAnimal, '$endeAnimal', $idadeAnimal)";
    $resultdo = insereRegistro($sqlInAnimal);    
}else{
    echo 'dados inválidos';
}

?>