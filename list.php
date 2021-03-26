<?php
require_once ('php_script/class/movies.php');
require_once ('php_script/data/data.php');
require_once ('php_script/data/pagination.php');

session_start();

if(isset($_POST['btn-search'])){
    $criteria = $_POST['search'];
    $_SESSION['search'] = $criteria;
}
else{
    $criteria = isset($_SESSION['search']) ? $_SESSION['search'] : " ";
}

#ubah nilai variabel ini untuk mengubah jumlah data tiap halaman.
$dataPerPage = 2;

#variabel untuk mengetahui current page, jangan diubah-ubah.
$currentPage = Pagination::getCurrentPage();

#variabel untuk data diquery mulai dari index berapa, jangan diubah-ubah.
$offSet = Pagination::getOffset($dataPerPage, $currentPage);

$movies = FetchMovie::getMovieBy($criteria);

$totalData = Movie::getCount();

$movie_current_page = FetchMovie::getDataLimittedSearch($offSet, $dataPerPage, $criteria);
$totalPage = Pagination::getTotalPage($totalData, $dataPerPage);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Source CSS -->
    <link type="text/css" rel="stylesheet" href="css/list.css">

   

    <title>ATIGA MOVIES</title>
</head>
<body>
    <section class="container">
        <!-- Area input dan Button -->
        <form action="list.php" method="post">
        <div class="searchGrouping">
        <a href="grid.php"><img src="https://img.icons8.com/metro/26/000000/activity-grid-2.png" class="img-place"></a>
            <div class="space">
                <!-- cek apakah session ada atau tidak -->
                <?php if (isset($_SESSION['search'])) : ?>
                     <input type="text" placeholder="   Searching..." class="txt-search" name="search" id="search" value="<?php echo $_SESSION['search']?>">
                <?php else:?>
                    <input type="text" placeholder="   Searching..." class="txt-search" name="search" id="search">
                <?php endif;?>
            </div>

            <div class="space">
                <button type="submit" class="btn-search" name="btn-search" id="btn-search" >Search</button>
            </div>
        </div>
        </form>
        <!-- End Area input dan Button -->
    </section>

    <section class="container">

        <div class="item" id="item-movie">

        <!-- CEK APAKAH MOVIE ADA -->
        <?php if(count($movies) > 0): ?>
            <!-- KODE APABILA MOVIE ADA -->
            <?php foreach ($movie_current_page as $movie): ?>
            <div class="list-item">
                <img src="<?=  $movie->getImage();?>" alt="" class="img-select">
                <div class="deskripsi">
                    <div class="caption">
                        <h3><?=  $movie->getTitle(); ?></h3>
                        <hr>
                        <p><?=  $movie->getSynopsis(); ?> </p>
                    </div>
                    <a style="text-decoration: none;" href="detail.php?id=<?=  $movie->getId(); ?>"><button type="button" class="btn-detail">Detail</button></a>
                    
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- KODE APABILA MOVIE TIDAK DITEMUKAN -->
            <p>TIDAK DITEMUKAN MOVIES</p>
        <?php endif; ?>
        </div>

    </section>

    <!-- code page --->
    <section class="container">

        <div class="page">     

            <?php for($i = 1; $i <= $totalPage; $i++) :?>    
               
                <?php if( $i == $currentPage): ?>
                    <a href="?page=<?= $i; ?>" style="font-weight:bold" ><?= $i; ?></a>
                <?php else: ?>
                    <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            
        </div>
        
    </section>

</body>
</html>