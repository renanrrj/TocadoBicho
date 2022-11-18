<?php
require_once "../mysql.php";

$nomeAnimal = $_POST['ani_Nome'];
$racaAnimal = $_POST['ani_Raca'];
$kgAnimal = $_POST['ani_Peso'];
$cmAnimal = $_POST['ani_Altura'];
$endeAnimal = $_POST['ani_Endereco'];
$idadeAnimal = $_POST['ani_Idade'];
$especieAnimal = $_POST['ani_Especie'];
$fotoAnimal = $_POST['ani_Foto'];
$validado = true;
$erro = "";

//* Verifica se existe algum campo obrigatório vazio e ativa o erro "nao foi possivel INSERIR,..."
if(empty($nomeAnimal) || empty($racaAnimal) || empty($kgAnimal) || empty($cmAnimal) || empty($endeAnimal) || empty($idadeAnimal) || empty($especieAnimal) || empty($fotoAnimal)){
    $validado = false;
    $erro = "Não foi possível INSERIR, existem campos obrigatórios em branco<br>";
}

//* Verifica se algum dos campos contém os caracteres '§¬/"
$uniao = $nomeAnimal.$racaAnimal.$kgAnimal.$cmAnimal.$endeAnimal.$idadeAnimal.$especieAnimal.$fotoAnimal;
if(strpos($uniao,"'") || strpos($uniao,"§") || strpos($uniao,"¬") || strpos($uniao,"|") || strpos($uniao,'"')){
    $validado = false;
    $erro = $erro."Não foi possível INSERIR, não são permitidos os caracteres '§¬|".'"'."<br>";
}

//* Substitui , por .
if(strpos($kgAnimal,",") || strpos($cmAnimal,",")){
    $kgAnimal = str_replace(",",".",$kgAnimal);
    $cmAnimal = str_replace(",",".",$cmAnimal);
}

//* Verifica a quilo e altura digitados são válidos
if (!is_numeric($kgAnimal) || $kgAnimal < 1 || !is_numeric($cmAnimal) || $cmAnimal < 1){
    $validado = false;
    $erro = $erro.'Não foi possível INSERIR, altura e peso não podem ser negativos, nem zero e devem ser um número<br>';
}

//* Verifica se a idade é válida
if (!is_numeric($idadeAnimal) || $idadeAnimal < 0){
    $validado = false;
    $erro = $erro.'Não foi possível INSERIR, idade não pode ser negativa e deve ser um número<br>';
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
    echo $erro;
#Inserindo o Dado
if($validado){
    $sqlInAnimal = "INSERT INTO `tb_animal`(ani_Id, ani_Nome, ani_Raca, ani_Peso, ani_Altura, ani_Endereco, ani_Especie, ani_Idade, ani_Foto) VALUES ($idAnimal, '$nomeAnimal', '$racaAnimal', $kgAnimal, $cmAnimal, '$endeAnimal','$especieAnimal', $idadeAnimal, '$fotoAnimal')";
    $resultado = insereRegistro($sqlInAnimal);    

    $_SESSION['situacao'] = $resultado;
    $_SESSION['acao'] = 'Inserção';

    echo "Passou: $resultado";
    // header('Location: ./indexAnimalDoacao.php');
} else {
    $_SESSION['situacao'] = $erro;
    // header('Location: ./indexAnimalDoacao.php');
}

?>
<!-- 62 -->