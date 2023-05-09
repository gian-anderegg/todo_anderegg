<?php
	include_once("config.php");


	function db_insert_task($title) {
		global $pdo;
		$sql = "insert into task (title) values (?)";
		$pdo->prepare($sql)->execute([$title]);
	}

	function db_get_tasks() {
		global $pdo;
		$stmt = $pdo->prepare("select * from task where completed = 0 order by id asc");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function db_complete_task($id) {
		global $pdo;
		$sql = "update task set completed = 1 where id = ?";
		$pdo->prepare($sql)->execute([$id]);
	}


?>
