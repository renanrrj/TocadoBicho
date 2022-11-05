<?php
require_once '../mysql.php';

$nomeAnimal = $_POST['ani_Nome'];
$racaAnimal = $_POST['ani_Raca'];
$kgAnimal = $_POST['ani_Peso'];
$cmAnimal = $_POST['ani_Altura'];
$endeAnimal = $_POST['ani_Endereco'];
$idAnimal = $_POST['idAni'];


$validado = true;

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
    echo 'Edição não permitida - ';
}

if($validado){
    $sqlUpAnimalDoacao = "UPDATE `tb_Animal` SET `ani_Nome` = '$nomeAnimal', `ani_Raca` ='$racaAnimal', `ani_Peso` = '$kgAnimal', `ani_Altura` = '$cmAnimal', `ani_Endereco` = '$endeAnimal'  WHERE `ani_Id` = $idAnimal";
    $resultado = updateRegistro($sqlUpAnimalDoacao);
    
}

?>


<!-- <script>   --Screito para redirecionamento após as ações
        function redireciona(){
            var valor_busca = document.getElementById(form).action;
                location.href="/index.php";
                }
</script> 


Removi campo "ani_Especie" do banco e do crud pois ja tinha o campo "ani_raca".




-->