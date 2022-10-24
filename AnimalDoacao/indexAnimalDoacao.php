<?php
require_once '../mysql.php';

$sqlAnimal = "SELECT * FROM tb_animal";
$listaAnimal = selectRegistros($sqlAnimal);

array_unshift($listaAnimal,["ani_Id" => "","ani_Nome" => ""]);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Animal Doação</title>
    <link href="../style.css" rel="Stylesheet"></link>

</head>

<div class="menu">
        <a class="menu_option" href="/index.php">Home</a>
        <a class="menu_option" href="../Clinica/indexClinica.php">Clínica</a>
        <a class="menu_option activated" href="../AnimalDoacao/indexAnimalDoacao.php">Animal Doação</a>
        <a class="menu_option" href="../CategoriaProduto/indexCategoriaProduto.php">Categoria Produto</a>
        <a class="menu_option" href="../Produto/indexProduto.php">Produto</a>
    </div>
<body>
    <h1>Animal Doação</h1>

    <hr>
    <form id="form" method="POST" action="insertAnimal.php" onSubmit="return valida_dados(this)">
        <p>
            Id Animal:
            <select name="idAni" onchange="updateButtons(this)">
            <?php
                foreach ($listaAnimal as $tb_animal){
            ?>
            <option value="<?php echo $tb_animal['ani_Id'] ?>"><?php echo ucfirst(strtolower($tb_animal['ani_Nome'])) ?></option>
            <?php
                }
            ?>
            </select>
            <br>
            <br>
            
            Nome Animal:
            <input type="text" name="nomeAni" size="20">
            <br>
            <br>
            Raça Animal:
            <input type="text" name="racaAni" size="20"> 
            <br>
        <br>
            Peso Animal (kg):
            <input type="number" name="kgAni" size="20"> 
            <br>
        <br>
            Altura Animal (cm):
            <input type="text" name="cmAni" size="20">
            <br>
        <br>
            Data Nasc Animal:
            <input type="date" name="dtnascAni" size="20"> 
        <br>
        <br>
            Endereço Animal:
            <input type="text" name="endeAni" size="20">
        </p>
    </form>

    <input id="btnEnviar" type="button" value="Enviar" onclick="document.getElementById('form').action = './insertAnimalDoacao.php'; document.getElementById('form').submit()">
    <input id="btnDeletar" type="button" value="Deletar" onclick="document.getElementById('form').action = './deleteAnimalDoacao.php'; document.getElementById('form').submit()">
    <input id="btnAlterar" type="button" value="Alterar" onclick="document.getElementById('form').action = './updateAnimalDoacao.php'; document.getElementById('form').submit()">
</body>
</html>
