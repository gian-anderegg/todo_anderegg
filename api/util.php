<?php

	function formatMessage($status = 200, $data = null) {
		$message = array();
		$message['status'] = $status;
		$message['data'] = $data;
		return $message;
	}

	function sanitize_input($string) {
		$string = trim($string);
		$string = stripslashes($string);
		$string = htmlspecialchars($string);
		return $string;
	}

	function redirect($id = "") {
		if (!empty($id)) $id = "?id=$id";
		header("Location: " . $_SERVER['PHP_SELF'] . $id);
		exit();
	}

	function CheckUsername($value) {

	}

	function CheckPassword($value) {

	}


?>
