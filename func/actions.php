<?php
	include "dbconnection.php";

	class DataOperation extends Database
	{
		/* Functions to display all records */
		public function fetch_record($table){
			$sql = "SELECT * FROM ".$table;
			$array = array();
			$query = mysqli_query($this->strConn,$sql);
			while($row = mysqli_fetch_assoc($query)){
				$array[] = $row;
			}
			return $array;
		}
		/* Insert Record Function */
		public function insert_record(){

		}
		/* Delete Record Function */
		public function delete_record(){

		} 
		/* Delete Record Function */
		public function update_record(){
			
		}
		/* Select record with JOIN statement */
		public function join_fetch_record($table){
			$sql="SELECT movies.movie_id, movies.movie_name, movies.release_year, movies.director, sum(ratings.rating) FROM ".$table." INNER JOIN ratings ON movies.movie_id = ratings.movie_id GROUP BY movies.movie_id";
			$array = array();
			$query = mysqli_query($this->strConn,$sql);
			while($row = mysqli_fetch_assoc($query)){
				$array[] = $row;
			}
			return $array;
		}
		/* Search Movies */
		public function searchMovie($table,$keyword){
			$sql = "SELECT movies.movie_id, movies.movie_name, movies.release_year, movies.director, sum(ratings.rating) FROM ".$table." INNER JOIN ratings ON movies.movie_id = ratings.movie_id WHERE movies.movie_name like '%".$keywords."%' GROUP BY movies.movie_id";
			$query = mysqli_query($this->strConn,$sql);
			$array = array();
			while($row = mysqli_fetch_assoc($query)){
				$array[] = $row;
			}
			return $arrray;
		}
	}
	$obj = new DataOperation;

?>