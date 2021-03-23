<?php

require_once ('php_script/class/movies.php');
require_once ('php_script/data/data.php');
require_once ('php_script/data/pagination.php');

#ubah nilai variabel ini untuk mengubah jumlah data tiap halaman.
$dataPerPage = 2;

#variabel untuk mengetahui current page, jangan diubah-ubah.
$currentPage = Pagination::getCurrentPage();

#variabel untuk data diquery mulai dari index berapa, jangan diubah-ubah.
$offSet = Pagination::getOffset($dataPerPage, $currentPage);

$movies = FetchMovie::getData();

$movie_current_page = FetchMovie::getDataLimitted($offSet, $dataPerPage);

$totalData = Pagination::getNumRows($movies);

$totalPage = Pagination::getTotalPage($totalData, $dataPerPage);
$i = 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Source CSS -->
    <link type="text/css" rel="stylesheet" href="css/grid.css">

    <title>ATIGA MOVIE</title>
</head>
<body>
    <section class="container">
        <!-- Area input dan Button -->
        <div class="searchGrouping">
            <div class="space">
                <input type="text" placeholder="     Searching..." class="txt-search">
            </div>
            <div class="space">
                <button type="button" class="btn-search">Search</button>
            </div>
        </div>
        <!-- End Area input dan Button -->
    </section>

    <section class="container">
        
        <div class="content">
            <?php foreach($movie_current_page as $movie):?>
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

    
    <section class="container">
        
        <div class="page-group">

            <div class="page">
            <?php while($i <= $totalPage) :?>
                <!-- code page -->
                <?php if( $i == $currentPage): ?>
                    <a href="?page=<?= $i; ?>" style="font-weight:bold" ><?= $i; $i++; ?></a>
                <?php else: ?>
                    <a href="?page=<?= $i; ?>"><?= $i; $i++; ?></a>
                <?php endif; ?>
            <?php endwhile; ?>
            </div>

        </div>
                    
    </section>
    
</body>
</html>