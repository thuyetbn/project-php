<?php 
	
	function _select($table){
		global $con_db;
		$sql = "SELECT * FROM $table Order By id ASC";
		$query = $con_db->query($sql);
		return $query;
	}

	function _find($table){
		global $con_db;
		$id = !empty($_GET['id']) ? (Int)$_GET['id'] : 0;
		$sql = "SELECT * FROM $table where id = $id ";
		$query = $con_db->query($sql);
		return $query;
	}
	//"UPDATE category SET name = '$name', status = '$status' WHERE id = $id"
	//"INSERT INTO category SET name = '$name', status = '$status'"
	function _add($table,$data,$index){
		global $con_db;
		$set = '';
		if(is_array($data)){
			$i = 0;
			foreach ($data as $key=>$value) {
				$set .= $key.'="'. $value.'"';
				if($i < count($data)){
					$set .= ','; 
				}
				$i++;
			}
		}
		$set = rtrim($set, ',');
		$sql = "INSERT INTO $table SET $set";
		if ($con_db->query($sql)) {
		header('location:'.$index);
		}else{
		echo $con_db->error;
		}
		return $sql;
	}

	function _update($table,$data,$id,$index){
		global $con_db;
		$set = '';
		if(is_array($data)){
			$i = 0;
			foreach ($data as $key=>$value) {
				$set .= $key.'="'. $value.'"';
				if($i < count($data)){
					$set .= ','; 
				}
				$i++;
			}
		}
		$set = rtrim($set, ',');
		$sql = "UPDATE $table SET $set WHERE id = $id";
		if ($con_db->query($sql)) {
		header('location:'.$index);
		}else{
		echo $con_db->error;
		}
		return $sql;
	}

	function _delete($table,$index){
		global $con_db;
		$id = !empty($_GET['id']) ? (Int)$_GET['id'] : 0;
		$sql = "DELETE FROM $table WHERE id = $id";
		if ($con_db->query($sql)) {
		header('location:'.$index);
		}else{
		echo $con_db->error();
		}
	}
 ?>