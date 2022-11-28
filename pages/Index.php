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
    <link rel="stylesheet" href="../assets/Index.css">
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
                <?php
                    foreach($listaCatProduto as $categoria){
                ?>
                <div class="swiper-slide card">
                    <div class="card-content">
                        <div class="categoria_image">
                            <img class="categoria_img" src="<?php echo $categoria['catpro_Foto'] ?>" alt="">
                            <p class="categoira_label"><?php echo $categoria['catpro_Nome']?></p>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
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


    <section class="container-cartoes">
        <?php
          foreach($listaProduto as $produto){ 
        ?>
        <article class="cartao">
            <img class="article-img" src="<?php echo $produto['pro_Foto']?>" />
            <p class="article-title">
                <?php echo $produto['pro_Nome']?>
            </p>
            <p class="article-price">
                <?php echo "R$ ".str_replace(".",",",number_format($produto['pro_Preco'],2))?>
            </p>
        </article>
        <?php
          }
        ?>
    </section>


    <?php
    require_once('footer.php')
    ?>
</body>

</html>