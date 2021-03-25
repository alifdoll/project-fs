<?php
require_once ('php_script/database/db.php');
require_once ('php_script/class/movies.php');



class FetchMovie{
	public static function getAllData(){
		$conn = Connection::getConnection();
		
		$sql = "SELECT * FROM movies;";
		$run = mysqli_query($conn, $sql);
		$movies = [];
		while ($rows = mysqli_fetch_array($run)){
			$id = $rows['id'];
			$title = $rows['title'];
			$synopsis = $rows['synopsis'];
			$score = $rows['score'];
			$res_date = $rows['release'];
			$image = $rows['extension'];

			$genres = [];

			$sql_genre = "SELECT genre.name FROM `genre_movie` INNER JOIN genre ON genre_movie.genre_id = genre.id WHERE movies_id = $id;";

			$run_genre = mysqli_query($conn, $sql_genre);

			while($row_genre = mysqli_fetch_array($run_genre)){
				$name = new Genre($row_genre['name']);
				$genres[] = $name;
			}

			$movie = new Movie($id, $title, $synopsis, $score, $res_date, $image, $genres);
			$movies[] = $movie;
		}

		$conn->close();
		return $movies;
	}

	public static function getDataById($id_movie){
		$conn = Connection::getConnection();

		$sql = "SELECT * FROM movies WHERE id = ? ;";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i",$id_movie);
		$stmt->execute();

		$result = $stmt->get_result();

		$movies = new stdClass();
		while ($rows = $result->fetch_assoc()){
			$id = $rows['id'];
			$title = $rows['title'];
			$synopsis = $rows['synopsis'];
			$score = $rows['score'];
			$res_date = $rows['release'];
			$image = $rows['extension'];

			$genres = [];

			$sql_genre = "SELECT genre.name FROM `genre_movie` INNER JOIN genre ON genre_movie.genre_id = genre.id WHERE movies_id = ?;";

			$stmt_genre = $conn->prepare($sql_genre);
			$stmt_genre->bind_param("i", $id);
			$stmt_genre->execute();

			$result_genre = $stmt_genre->get_result();

			while($row_genre = $result_genre->fetch_assoc()){
				$name = new Genre($row_genre['name']);
				$genres[] = $name;
			}

			$movies = new Movie($id, $title, $synopsis, $score, $res_date, $image, $genres);
		}

		$stmt->close();
		$conn->close();
		return $movies;
	}

	public static function getMovieBy($criteria){
		$conn = Connection::getConnection();

		$sql = "SELECT * FROM movies 
				WHERE 
			title LIKE '%$criteria%' OR
			id LIKE '%$criteria%' OR 
			score LIKE '%$criteria%'";
		
		$run = mysqli_query($conn, $sql);
		$movies = [];
		while ($rows = mysqli_fetch_assoc($run)){
			$id = $rows['id'];
			$title = $rows['title'];
			$synopsis = $rows['synopsis'];
			$score = $rows['score'];
			$res_date = $rows['release'];
			$image = $rows['extension'];

			$genres = [];

			$sql_genre = "SELECT genre.name FROM `genre_movie` INNER JOIN genre ON genre_movie.genre_id = genre.id WHERE movies_id = $id;";

			$run_genre = mysqli_query($conn, $sql_genre);

			while($row_genre = mysqli_fetch_assoc($run_genre)){
				$name = new Genre($row_genre['name']);
				$genres[] = $name;
			}

			$movie = new Movie($id, $title, $synopsis, $score, $res_date, $image, $genres);
			$movies[] = $movie;
		}
	
		$conn->close();
		return $movies;
	}

	public static function getDataLimitted($data, $limit){
		$conn = Connection::getConnection();
		$sql = "SELECT * FROM movies LIMIT ?,?;";

		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ii", $data, $limit);
		$stmt->execute();

		$result = $stmt->get_result();
		
		$movies = new stdClass();
		$movies = [];
		
		while ($rows = $result->fetch_assoc()){
			$id = $rows['id'];
			$title = $rows['title'];
			$synopsis = $rows['synopsis'];
			$score = $rows['score'];
			$res_date = $rows['release'];
			$image = $rows['extension'];

			$genres = [];

			$sql_genre = "SELECT genre.name FROM `genre_movie` INNER JOIN genre ON genre_movie.genre_id = genre.id WHERE movies_id = ?;";

			$stmt_genre = $conn->prepare($sql_genre);
			$stmt_genre->bind_param("i", $id);
			$stmt_genre->execute();

			$result_genre = $stmt_genre->get_result();

			while($row_genre = $result_genre->fetch_assoc()){
				$name = new Genre($row_genre['name']);
				$genres[] = $name;
			}

			$movie = new Movie($id, $title, $synopsis, $score, $res_date, $image, $genres);
			$movies[] = $movie;
		}

		$stmt->close();
		$conn->close();
		return $movies;
	}

	public static function getDataLimittedSearch($data, $limit, $criteria){
		$conn = Connection::getConnection();

		$sql = "SELECT * FROM movies 
			WHERE 
			title LIKE '%$criteria%' OR
			id LIKE '%$criteria%' OR 
			score LIKE '%$criteria%'
			LIMIT $data, $limit;";
		
		$run = mysqli_query($conn, $sql);
		$movies = [];
		while ($rows = mysqli_fetch_assoc($run)){
			$id = $rows['id'];
			$title = $rows['title'];
			$synopsis = $rows['synopsis'];
			$score = $rows['score'];
			$res_date = $rows['release'];
			$image = $rows['extension'];

			$genres = [];

			$sql_genre = "SELECT genre.name FROM `genre_movie` INNER JOIN genre ON genre_movie.genre_id = genre.id WHERE movies_id = $id;";

			$run_genre = mysqli_query($conn, $sql_genre);

			while($row_genre = mysqli_fetch_assoc($run_genre)){
				$name = new Genre($row_genre['name']);
				$genres[] = $name;
			}

			$movie = new Movie($id, $title, $synopsis, $score, $res_date, $image, $genres);
			$movies[] = $movie;
		}
	
		$conn->close();
		return $movies;
	}

}


?>