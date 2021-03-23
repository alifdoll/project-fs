<?php

#$currentPage = if(isset($_GET['page']));

class Pagination{

	public static function getNumRows($movies){
		return count($movies);
	}

	public static function getTotalPage($totalData, $dataPerPage){
		$pageCount = ceil($totalData / $dataPerPage);
		return $pageCount;
	}

	public static function getCurrentPage(){
		$currentPage = (isset($_GET['page']) ) ? $_GET['page'] : 1;
		return $currentPage;
	}

	#Method untuk query data dimulai dari index ke-berapa.
	public static function getOffset($dataPerPage, $currentPage){
		$offset = ($dataPerPage * $currentPage) - $dataPerPage;
		return $offset;
	}
}


?>