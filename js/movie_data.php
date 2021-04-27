<?php

require_once('../php_script/data/data.php');
// require_once('../php_script/class/movies.php');

$movies = FetchMovie::getAllData();



?>

<section class="container">
        <div class="content">
            <?php foreach($movies as $movie):?>
            <!-- Area Grid Movie -->
            <div class="box">
                <img class="img-selector" src="<?php echo $movie->getImage();?>" alt="">
                <div class="caption">
                    <h3><?php echo $movie->getTitle(); ?></h3>
                    <hr>
                    <p><?php echo $movie->getSynopsis(); ?> </p>
                </div>
                 <a style="text-decoration: none;" href="detail.php?id=<?php echo $movie->getId(); ?>"><button type="button" class="btn-detail">Detail</button></a>
            </div>
            <!-- End Area Grid Movie -->
            <?php endforeach ?>
        </div>
    </section>