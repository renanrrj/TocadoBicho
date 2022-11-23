<?php
require_once "../mysql.php";
session_start();

$sqlCatProduto = "SELECT * FROM tb_categoriaproduto ORDER BY catpro_Nome";
$sqlProduto = "SELECT * FROM tb_produto ORDER BY pro_Nome";

$listaCatProduto = selectRegistros($sqlCatProduto);
$listaProduto = selectRegistros($sqlProduto);

$str_listaProduto = arrayToString($listaProduto);

array_unshift($listaProduto, ["pro_Id" => "", "pro_Nome" => "","pro_Preco"=>"","pro_Id_Categoria"=>1,"pro_Detalhe"=>""]);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>

    <link href="../style.css" rel="stylesheet"></link>
    <script src="./controleProduto.js"></script>
</head>

<body>
    <p id="dadosString" style="max-height:0px; font-size:0px"><?php echo $str_listaProduto ?></p>

    <div class="menu">
    <a class="menu_option" href="../index.php">Home</a>
        <a class="menu_option" href="../Clinica/indexClinica.php">Clínicas</a>
        <a class="menu_option" href="../AnimalDoacao/indexAnimalDoacao.php">Animais para doação</a>
        <a class="menu_option" href="../CategoriaProduto/indexCategoriaProduto.php">Categorias de produto</a>
        <a class="menu_option activated">Produtos</a>
        <a class="menu_option" href="../FormasPagamento/indexFormaPagamento.php">Formas de pagamento</a>
    </div>

    <h1>Produtos</h1>
    <hr>

    <form id="form" method="POST" action="./insertProduto.php">
        <p>
            Produto:
            <select id="pro_Id" name="pro_Id" onchange="updateButtons(this)">
                <?php
                foreach ($listaProduto as $tb_produto) {
                ?>
                    <option value="<?php echo $tb_produto['pro_Id'] ?>"><?php echo $tb_produto['pro_Nome'] ?></option>
                <?php
                }
                ?>
            </select>
        </p>
        <p>
            Categoria:
            <select id="pro_Id_Categoria" name="pro_Id_Categoria">
                <?php
                foreach ($listaCatProduto as $tb_categoriaproduto) {
                ?>
                    <option value="<?php echo $tb_categoriaproduto['catpro_Id'] ?>"><?php echo $tb_categoriaproduto['catpro_Nome'] ?></option>
                <?php
                }
                ?>
            </select>
        </p>
        <p>
            Nome:
            <input id="pro_Nome" type="text" name="pro_Nome" size="20" style="width:50%">
        </p>
        <p style="display:flex;align-items:flex-start">
            Detalhes:
            <textarea id="pro_Detalhe" type="text" name="pro_Detalhe" style="resize:none;width:50%" spellcheck="false"></textarea>
        </p>
        <p>
            Preço:
            <input id="pro_Preco" type="number" name="pro_Preco" size="20" style="width:50%">
        </p>
        <p>
            Foto:
            <input id="pro_Foto" type="file" accept="image/png, image/gif, image/jpeg, image/webp" style="width:50%" onchange="getBase64(this.files[0])">
            <input id="pro_Foto_txt" type="text" name="pro_Foto" style="display:none">
        </p>
    </form>

    <!-- Botoes -->
    <input id="btnEnviar" type="button" value="Enviar" onclick="document.getElementById('form').action = './insertProduto.php'; document.getElementById('form').submit()">
    <input id="btnDeletar" type="button" value="Deletar" onclick="document.getElementById('form').action = './deleteProduto.php'; document.getElementById('form').submit()" disabled>
    <input id="btnAtualizar" type="button" value="Alterar" onclick="document.getElementById('form').action = './updateProduto.php'; document.getElementById('form').submit()" disabled>

    <!-- Mensagem de erro ou sucesso -->
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
        }else{
            echo "<p style='color: red; font-weight: bold'>$situacao</p>";
        }
    ?>

<img id="pro_img"/>
</body>

</html>