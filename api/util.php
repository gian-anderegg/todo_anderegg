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

    function checkUsername($value) {
        $pattern = '/^[a-zA-Z0-9_]{5,20}$/';

        if (preg_match($pattern, $value)) {
            return true;
        } else {
            return false;
        }
    }

    function checkPassword($value) {
			$pattern = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/';

			if (preg_match($pattern, $value)) {
				return true;
			} else {
				return false;
			}
    }
?>
