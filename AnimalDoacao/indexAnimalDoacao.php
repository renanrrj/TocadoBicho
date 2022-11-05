<?php
require_once '../mysql.php';

$sqlAnimal = "SELECT * FROM tb_animal";
$listaAnimal = selectRegistros($sqlAnimal);
$str_listaAnimal = arrayToString($listaAnimal);

array_unshift($listaAnimal, ["ani_Id" => "", "ani_Nome" => ""]);
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Animais para doação</title>
        <link href="../style.css" rel="Stylesheet">
        </link>
        <script src="./controleAnimalDoacao.js"></script>
    </head>

    <div class="menu">
        <a class="menu_option" href="/index.php">Home</a>
        <a class="menu_option" href="../Clinica/indexClinica.php">Clínicas</a>
        <a class="menu_option activated">Animais para doação</a>
        <a class="menu_option" href="../CategoriaProduto/indexCategoriaProduto.php">Categorias de produto</a>
        <a class="menu_option" href="../Produto/indexProduto.php">Produtos</a>
        <a class="menu_option" href="../FormasPagamento/indexFormaPagamento.php">Formas de pagamento</a>
    </div>

    <body>
        <p id="dadosString" style="max-height:0px; font-size:0px"><?php echo $str_listaAnimal ?></p>

        <h1>Animais para doação</h1>

        <hr>
        <form id="form" method="POST" action="insertAnimal.php" onSubmit="return valida_dados(this)">
            <p>
                Animal para doação:
                <select name="idAni" onchange="updateButtons(this)">
                    <?php
                    foreach ($listaAnimal as $tb_animal) {
                    ?>
                        <option value="<?php echo $tb_animal['ani_Id'] ?>"><?php echo ucfirst(strtolower($tb_animal['ani_Nome'])) ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br>
                <br>
                Nome:
                <input id="ani_Nome" type="text" name="ani_Nome" size="20" style="width:50%">
                <br>
                <br>
                Raça:
                <input id="ani_Raca" type="text" name="ani_Raca" size="20" style="width:50%">
                <br>
                <br>
                Peso (kg):
                <input id="ani_Peso" type="number" name="ani_Peso" size="20">
                #Fazer tratativa de só usar . para separar decimal
                <br>
                <br>
                Altura (cm):
                <input id="ani_Altura" type="number" name="ani_Altura" size="20">
                #Fazer tratativa de só usar . para separar decimal
                <br>
                <br>
                Endereço:
                <input id="ani_Endereco" type="text" name="ani_Endereco" size="20" style="width:50%">
                <br>
                <br>
            </p>
        </form>

        <input id="btnEnviar" type="button" value="Enviar" onclick="document.getElementById('form').action = './insertAnimalDoacao.php'; document.getElementById('form').submit()">
        <input id="btnDeletar" type="button" value="Deletar" onclick="document.getElementById('form').action = './deleteAnimalDoacao.php'; document.getElementById('form').submit()" disabled>
        <input id="btnAtualizar" type="button" value="Alterar" onclick="document.getElementById('form').action = './updateAnimalDoacao.php'; document.getElementById('form').submit();" disabled>
    </body>

</html>