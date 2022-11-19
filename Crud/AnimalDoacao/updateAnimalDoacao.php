<?php
require_once '../mysql.php';
session_start();

$nomeAnimal = $_POST['ani_Nome'];
$racaAnimal = $_POST['ani_Raca'];
$kgAnimal = $_POST['ani_Peso'];
$cmAnimal = $_POST['ani_Altura'];
$endeAnimal = $_POST['ani_Endereco'];
$idadeAnimal = $_POST['ani_Idade'];
$especieAnimal = $_POST['ani_Especie'];
$fotoAnimal = $_POST['ani_Foto'];
$idAnimal = $_POST ['ani_Id'];
$validado = true;

//* Verifica se existe algum campo obrigatório vazio e ativa o erro "nao foi possivel INSERIR,..."
if(empty($idadeAnimal) ||empty($especieAnimal) ||empty($fotoAnimal) ||empty($nomeAnimal) || empty($racaAnimal) || empty($kgAnimal) || empty($cmAnimal) || empty($endeAnimal) || empty($idadeAnimal) || empty($especieAnimal) || empty($fotoAnimal)){
    $validado = false;
    $erro = "Não foi possível ALTERAR, existem campos obrigatórios em branco<br>";
}

//* Verifica se algum dos campos contém os caracteres '§¬/"
$uniao = $nomeAnimal.$racaAnimal.$kgAnimal.$cmAnimal.$endeAnimal.$idadeAnimal.$especieAnimal.$fotoAnimal;
if(strpos($uniao,"'") || strpos($uniao,"§") || strpos($uniao,"¬") || strpos($uniao,"|") || strpos($uniao,'"')){
    $validado = false;
    $erro = $erro."Não foi possível ALTERAR, não são permitidos os caracteres '§¬|".'"'."<br>";
}

//* Substitui , por .
if(strpos($kgAnimal,",") || strpos($cmAnimal,",")){
    $kgAnimal = str_replace(",",".",$kgAnimal);
    $cmAnimal = str_replace(",",".",$cmAnimal);
}

//* Verifica a quilo e altura digitados são válidos
if (!is_numeric($kgAnimal) || $kgAnimal < 1 || !is_numeric($cmAnimal) || $cmAnimal < 1){
    $validado = false;
    $erro = $erro.'Não foi possível ALTERAR, altura e peso não podem ser negativos, nem zero e devem ser um número<br>';
}

//* Verifica se a idade é válida
if (!is_numeric($idadeAnimal) || $idadeAnimal < 0){
    $validado = false;
    $erro = $erro.'Não foi possível ALTERAR, idade não pode ser negativa e deve ser um número<br>';
}

$listaAnimalDoacao = [];

# Conferencia: se diferente de numerico validado se torna falso
if(!is_numeric($idAnimal)){
    $validado = false;
}else{
    $sqlIdAnimalDoacao = "SELECT * FROM tb_animal WHERE ani_Id = $idAnimal";
    $listaAnimalDoacao = selectRegistros($sqlIdAnimalDoacao);
}

# Verifica se há matéria com esse Id para poder altera-la
if($listaAnimalDoacao == []){
    $validado = false;
     $erro = $erro.'Edição não permitida - <br>';
}

//* Alterando o Dado
if ($validado) {
    $sqlUpAni = "UPDATE `tb_animal` SET `ani_Nome` = '$nomeAnimal', `ani_Raca` = '$racaAnimal', `ani_Peso` = $kgAnimal, `ani_Altura` = $cmAnimal, `ani_Endereco` = '$endeAnimal', `ani_Idade` = $idadeAnimal, `ani_Especie` = '$especieAnimal', `ani_Foto` = '$fotoAnimal' WHERE `ani_Id` = $idAnimal";
    $resultado = updateRegistro($sqlUpAni);

    echo $resultado;

    $_SESSION['situacao'] = $resultado;
    $_SESSION['acao'] = 'Alteração';

    echo "Passou: $resultado";
    header('Location: ./indexAnimalDoacao.php');
} else {
    $_SESSION['situacao'] = $erro;
    header('Location: ./indexAnimalDoacao.php');
}

?>