<?php
require_once "../mysql.php";

$sqlIdCatProduto = "SELECT catpro_Id FROM tb_categoriaproduto";
$sqlCatProduto = "SELECT * FROM tb_categoriaproduto ORDER BY catpro_Nome";    #"SELECT catpro_Nome FROM tb_categoriaproduto";

$listaIdCatProduto = selectRegistros($sqlIdCatProduto);
$listaCatProduto = selectRegistros($sqlCatProduto);

array_unshift($listaCatProduto,["catpro_Id" => "","catpro_Nome" => ""]);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria Produto</title>

    <link href="../style.css" rel="stylesheet"></link>

    <script>function updateButtons(select){ // fora de funcionamento
            const btnEnviar = document.getElementById('btnEnviar')
            const btnAtualizar = document.getElementById('btnAtualizar')
            const btnDeletar = document.getElementById('btnDeletar')

            if(select.value == ""){
                btnEnviar.disabled = true
                btnAtualizar.disabled = false
                btnDeletar.disabled = false
            }else{
                btnEnviar.disabled = false
                btnAtualizar.disabled = true
                btnDeletar.disabled = true
            }
        }
    </script>

</head>

<body>
    <div class="menu">
        <a class="menu_option" href="/index.php">Home</a>
        <a class="menu_option" href="/Clinica/indexClinica.php">Clínica</a>
        <a class="menu_option activated" href="">Categoria Produto</a>
    </div>

    <h1>Categoria Produto</h1>
    <hr>

    <form id="form" method="POST" action="insertCategoriaProduto.php" onSubmit="return valida_dados(this)">
        <p>
            Id Categoria Produto:
            <select name="idCatPro" onchange="updateButtons(this)">
            <?php
                foreach ($listaCatProduto as $tb_categoriaproduto){
            ?>
            <option value="<?php echo $tb_categoriaproduto['catpro_Id'] ?>"><?php echo ucfirst(strtolower($tb_categoriaproduto['catpro_Nome'])) ?></option>
            <?php
                }
            ?>
            </select>

        <br>
        <br>
            Nome Categoria Produto:
            <input type="text" name="nomeCatPro" size="20">           

        </p>
    </form>

 <!-- Botoes -->
    <input id="btnEnviar" type="button" value="Enviar" onclick="document.getElementById('form').action = './insertCategoriaProduto.php'; document.getElementById('form').submit()">
    <input id="btnDeletar" type="button" value="Deletar" onclick="document.getElementById('form').action = './deleteCategoriaProduto.php'; document.getElementById('form').submit()">
    <input id="btnAlterar" type="button" value="Alterar" onclick="document.getElementById('form').action = './updateCategoriaProduto.php'; document.getElementById('form').submit()">
       
</body>
</html>

<br>
<br>
<hr>
# erro ao ativar e desativar teclas de acordo com o select no optionbox 