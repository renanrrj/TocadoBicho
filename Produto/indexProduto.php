<?php
require_once "../mysql.php";

$sqlCatProduto = "SELECT * FROM tb_categoriaproduto";
$sqlProduto = "SELECT pro_Id,pro_Nome FROM tb_produto ORDER BY pro_Nome";    #"SELECT catpro_Nome FROM tb_categoriaproduto";

$listaCatProduto = selectRegistros($sqlCatProduto);
$listaProduto = selectRegistros($sqlProduto);

array_unshift($listaProduto, ["pro_Id" => "", "pro_Nome" => ""]);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>

    <link href="../style.css" rel="stylesheet">
    </link>

    <script>
        function updateButtons(select) {
            const btnEnviar = document.getElementById('btnEnviar')
            const btnAtualizar = document.getElementById('btnAtualizar')
            const btnDeletar = document.getElementById('btnDeletar')

            if (select.value != "") {
                btnEnviar.disabled = true
                btnAtualizar.disabled = false
                btnDeletar.disabled = false
            } else {
                btnEnviar.disabled = false
                btnAtualizar.disabled = true
                btnDeletar.disabled = true
            }
        }
    </script>

</head>

<body>
    <div class="menu">
        <a class="menu_option" href="../index.php">Home</a>
        <a class="menu_option" href="../CategoriaProduto/indexCategoriaProduto.php">Categoria Produto</a>
        <a class="menu_option activated" href="">Produto</a>
    </div>

    <h1>Produto</h1>
    <hr>

    <form id="form" method="POST" action="./insertProduto.php" onSubmit="return valida_dados(this)">
        <p>
            Produto:
            <select name="idCatPro" onchange="updateButtons(this)">
                <?php
                foreach ($listaProduto as $tb_produto) {
                ?>
                    <option value="<?php echo $tb_produto['pro_Id'] ?>"><?php echo ucfirst(strtolower($tb_produto['pro_Nome'])) ?></option>
                <?php
                }
                ?>
            </select>
        </p>
        <p>
            Categoria:
            <select name="idCatPro">
                <?php
                foreach ($listaCatProduto as $tb_categoriaproduto) {
                ?>
                    <option value="<?php echo $tb_categoriaproduto['catpro_Id'] ?>"><?php echo ucfirst(strtolower($tb_categoriaproduto['catpro_Nome'])) ?></option>
                <?php
                }
                ?>
            </select>
        </p>
        <p>
            Nome:
            <input type="text" name="nomeCatPro" size="20">
        </p>
        <p>
            Preço:
            <input type="number" name="nomeCatPro" size="20">
        </p>
    </form>

    <!-- Botoes -->
    <input id="btnEnviar" type="button" value="Enviar" onclick="document.getElementById('form').action = './insertCategoriaProduto.php'; document.getElementById('form').submit()">
    <input id="btnDeletar" type="button" value="Deletar" onclick="document.getElementById('form').action = './deleteCategoriaProduto.php'; document.getElementById('form').submit()" disabled>
    <input id="btnAtualizar" type="button" value="Alterar" onclick="document.getElementById('form').action = './updateCategoriaProduto.php'; document.getElementById('form').submit()" disabled>

</body>

</html>

<br>
<br>
<hr>
# erro ao ativar e desativar teclas de acordo com o select no optionbox