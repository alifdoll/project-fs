<?php
require_once('genre.php');

class Movie{
  protected $id;
  protected $title;
  protected $synopsis;
  protected $score;
  protected $res_date;
  protected $image;
  protected $genres;
  protected static $count = 0;

  public function __construct($id, $title, $synopsis, $score, $res_date, $image, $genres){
    $this->id = $id;
    $this->title = $title;
    $this->synopsis = $synopsis;
    $this->score = $score;
    $this->res_date = $res_date;
    $this->image = $image;
    $this->genres = $genres;
    self::$count++;
  }

  public static function getCount() {
      return self::$count;
  }

  public  function getId(){
    return $this->id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getSynopsis() {
    return $this->synopsis;
  }

  public function getScore() {
    return $this->score;
  }

  public function getDate() {
    return $this->res_date;
  }

  public function getImage() {
    return $this->image;
  }

  public function getGenres() {
    return $this->genres;
  }



}

?>