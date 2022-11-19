<?php
  require_once('../Crud/mysql.php');

  $sqlCatProduto = "SELECT * FROM tb_categoriaproduto ORDER BY catpro_Nome";
  $sqlProduto = "SELECT * FROM tb_produto ORDER BY pro_Nome";

  $listaCatProduto = selectRegistros($sqlCatProduto);
  $listaProduto = selectRegistros($sqlProduto);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/Produtos.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/swiper.css" />
    <title>Document</title>
</head>

<body>
    <?php
    require_once('header.php');
    ?>

    <section style="height:84px;">
        <div class="swiper mySwiper" style="margin-top: 150px;">
            <div class="swiper-button-prev"></div>
            <div class="swiper-wrapper content meio">
                <div class="swiper-slide card">
                    <div class="card-content">
                        <div class="image" style="margin-left:50px;width:120px;height:120px;">
                            <img src="https://img.elo7.com.br/product/original/22A89BB/comedouro-cachorro-pote-de-racao-rosa-comedouro.jpg" alt="" style="width:100%;height:100%;border:2px solid black;border-radius:10px;">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide card">
                    <div class="card-content">
                        <div class="image" style="margin-left:50px;width:120px;height:120px;">
                            <img src="https://www.plasvale.com.br/wp-content/uploads/2021/04/Brinquedo-Osso-De-Borracha-Para-Cachorro-imagem.png" alt="" style="width:100%;height:100%;border:2px solid black;border-radius:10px;object-fit:cover">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide card">
                    <div class="card-content">
                        <div class="image" style="margin-left:50px;width:120px;height:120px;">
                            <img src="https://cobasi.vteximg.com.br/arquivos/ids/711719/Antipulgas-e-Carrapatos-NexGard-Spectra-para-Caes-7-6-a-15-kg-3992658-LADO.jpg?v=637584032749500000" alt="" style="width:100%;height:100%;border:2px solid black;border-radius:10px;">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide card">
                    <div class="card-content">
                        <div class="image" style="margin-left:50px;width:120px;height:120px;">
                            <img src="https://images.tcdn.com.br/img/img_prod/742943/casinha_de_madeira_pinus_cachorro_2041_1_20200707100354.jpg" alt="" style="width:100%;height:100%;border:2px solid black;border-radius:10px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
        </div>

        <!-- <div class="swiper-pagination" style="position:relative"></div> -->

        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 9,
                // spaceBetween: 30,
                slidesPerGroup: 9,
                loop: true,
                loopFillGroupWithBlank: true,
                // pagination: {
                //     el: ".swiper-pagination",
                //     clickable: true,
                // },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                }

            })
        </script>
    </section>


    <section class="cards" style="margin-top:232px">
        <article>
            <img class="article-img" src="https://a-static.mlcdn.com.br/800x560/racao-special-dog-junior-premium-carne-para-caes-filhotes-specialdog/petben/8ba7a95a2ac311edb2394201ac185019/770b4d512a7ca417fa30c46e592e0441.jpeg" alt=" " style="width:200px; height:200px; object-fit:cover"/>
            <h1 class="article-title">
                SpecialDog 500g
            </h1>
        </article>
        <article>
            <img class="article-img" src="https://images.tcdn.com.br/img/img_prod/742943/casinha_de_madeira_pinus_cachorro_2041_1_20200707100354.jpg" alt=" " style="width:200px; height:200px; object-fit:cover"/>
            <h1 class="article-title">
                Casinha de madeira G
            </h1>
        </article>
        <article>
            <img class="article-img" src="https://www.plasvale.com.br/wp-content/uploads/2021/04/Brinquedo-Osso-De-Borracha-Para-Cachorro-imagem.png" alt=" " style="width:200px; height:200px; object-fit:cover"/>
            <h1 class="article-title">
                Mordedor
            </h1>
        </article>
        <article>
            <img class="article-img" src="http://placekitten.com/280/250" alt=" " style="width:200px; height:200px; object-fit:cover"/>
            <h1 class="article-title">
              Nexgard
            </h1>
        </article>
        <article>
            <img class="article-img" src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcS7BlT2SWPk8Ec1w7_FtkX4Dc_2VH1heJ7T1kvQboYWNK51mqGnxTbZXIH8gmMUN949h2Qc3faT0co8WFaOPIyDzZ8rqLXKCe7sLAr0-lvx0_cjp9cXyZFw4A&usqp=CAE" alt=" " style="width:200px; height:200px; object-fit:cover"/>
            <h1 class="article-title">
              Pote de ração
            </h1>
        </article>
    </section>


    <?php
    require_once('footer.php')
    ?>
</body>

</html>