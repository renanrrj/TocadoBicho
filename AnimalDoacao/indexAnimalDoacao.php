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
    <form id="form" method="POST" action="insertAnimal.php">
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
        </p>
        <p>
            Nome:
            <input id="ani_Nome" type="text" name="ani_Nome" size="20" style="width:50%">
        </p>
        <p>
            Espécie:
            <input id="ani_Especie" type="text" name="ani_Especie" size="20" style="width:50%">
        </p>
        <p>
            Raça:
            <input id="ani_Raca" type="text" name="ani_Raca" size="20" style="width:50%">
        </p>
        <p>
            Peso (kg):
            <input id="ani_Peso" type="number" name="ani_Peso" size="20">
            
        </p>
        <p>
            Altura (cm):
            <input id="ani_Altura" type="number" name="ani_Altura" size="20">
            
        </p>
        <p>
            Idade:
            <input id="ani_Idade" type="number" name="ani_Idade" size="20" style="width:50%">
        </p>
        <p>
            Endereço:
            <input id="ani_Endereco" type="text" name="ani_Endereco" size="20" style="width:50%">
        </p>
        <p>
            Foto:
            <input id="ani_Foto" type="file" accept="image/png, image/gif, image/jpeg, image/webp" style="width:50%" onchange="getBase64(this.files[0])">
            <input id="ani_Foto_txt" type="text" name="ani_Foto" style="display:none">
        </p>
    </form>

    <input id="btnEnviar" type="button" value="Enviar" onclick="document.getElementById('form').action = './insertAnimalDoacao.php'; document.getElementById('form').submit()">
    <input id="btnDeletar" type="button" value="Deletar" onclick="document.getElementById('form').action = './deleteAnimalDoacao.php'; document.getElementById('form').submit()" disabled>
    <input id="btnAtualizar" type="button" value="Alterar" onclick="document.getElementById('form').action = './updateAnimalDoacao.php'; document.getElementById('form').submit();" disabled>

  

    <?php
        $situacao = isset($_SESSION['situacao']) ? $_SESSION['situacao'] : "";
        $acao = isset($_SESSION['acao']) ? $_SESSION['acao'] : "";

        if($acao != ""){
            if(is_numeric($situacao)){
                if($acao == 'Inserção'){
                    echo "<p style='color: green; font-weight: bold'>Inserido com sucesso</p>";
                }elseif($acao == 'Alteração'){
                    echo "<p style='color: green; font-weight: bold'>Alterado com sucesso</p>";
                }elseif($acao == 'Deleção'){
                    echo "<p style='color: green; font-weight: bold'>Deletado com sucesso</p>";
                }
            }else{
                echo "<p style='color: red; font-weight: bold'>$situacao</p>";
            }
        }
    ?>

      <img id="animal_img"/>


</body>

</html>