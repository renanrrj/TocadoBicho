<?php
require_once "../mysql.php";
session_start();

$sqlFormaPagamento = "SELECT * FROM tb_formapagamento ORDER BY fp_Nome";
$listaFormaPagamento = selectRegistros($sqlFormaPagamento);

$str_listaFormaPagamento = arrayToString($listaFormaPagamento);

array_unshift($listaFormaPagamento, ["fp_Id" => "", "fp_Nome" => "","fp_Parcelavel"=>""]);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formas de pagamento</title>

    <link href="../style.css" rel="stylesheet"></link>
    <script src="./controleFormaPagamento.js"></script>
</head>

<body>
    <p id="dadosString" style="max-height:0px; font-size:0px"><?php echo $str_listaFormaPagamento ?></p>

    <div class="menu">
    <a class="menu_option" href="../index.php">Home</a>
        <a class="menu_option" href="../Clinica/indexClinica.php">Clínicas</a>
        <a class="menu_option" href="../AnimalDoacao/indexAnimalDoacao.php">Animais para doação</a>
        <a class="menu_option" href="../CategoriaProduto/indexCategoriaProduto.php">Categorias de produto</a>
        <a class="menu_option" href="../Produto/indexProduto.php">Produtos</a>
        <a class="menu_option activated">Formas de pagamento</a>
    </div>

    <h1>Formas de pagamento</h1>
    <hr>

    <form id="form" method="POST" action="./insertFormaPagamento.php">
        <p>
            Forma de pagamento:
            <select id="fp_Id" name="fp_Id" onchange="updateButtons(this)">
                <?php
                foreach ($listaFormaPagamento as $tb_FormaPagamento) {
                ?>
                    <option value="<?php echo $tb_FormaPagamento['fp_Id'] ?>"><?php echo $tb_FormaPagamento['fp_Nome'] ?></option>
                <?php
                }
                ?>
            </select>
        </p>
        <p>
            Nome:
            <input id="fp_Nome" type="text" name="fp_Nome" size="20" style="width:50%">
        </p>
        <p>
            Parcelável:
            <input id="fp_Parcelavel_1" type="radio" name="fp_Parcelavel" size="20" value="True">
            Sim
            <input id="fp_Parcelavel_0" type="radio" name="fp_Parcelavel" size="20" value="False" checked>
            Não
        </p>
    </form>

    <!-- Botoes -->
    <input id="btnEnviar" type="button" value="Enviar" onclick="document.getElementById('form').action = './insertFormaPagamento.php'; document.getElementById('form').submit()">
    <input id="btnDeletar" type="button" value="Deletar" onclick="document.getElementById('form').action = './deleteFormaPagamento.php'; document.getElementById('form').submit()" disabled>
    <input id="btnAtualizar" type="button" value="Alterar" onclick="document.getElementById('form').action = './updateFormaPagamento.php'; document.getElementById('form').submit()" disabled>

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
        }
    ?>
</body>

</html>