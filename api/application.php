<?php


	function controller($method, $ressource, $id, $dataFromClient) {
		if ($ressource == 'todo') {
			switch ($method) {
				case 'GET':
					return getTasks();
				case 'POST':
					insertTask($dataFromClient->title);
				case 'PUT':
					return completeTask($id);
				case 'DELETE':
					return formatMessage(405);
				case 'OPTIONS':
					return formatMessage(405);
				default:
					return formatMessage(405);
			}
		} else if ($ressource == 'register') {
			switch ($method) {
				case 'GET':
					return formatMessage(405);
				case 'POST':
					return registerUser($dataFromClient);
				case 'PUT':
					return formatMessage(405);
				case 'DELETE':
					return formatMessage(405);
				case 'OPTIONS':
					return formatMessage(405);
				default:
					return formatMessage(405);
			}
		} else if ($ressource == 'login') {
			switch ($method) {
				case 'GET':
					return formatMessage(405);
				case 'POST':
					return login($dataFromClient);
				case 'PUT':
					return formatMessage(405);
				case 'DELETE':
					return formatMessage(405);
				case 'OPTIONS':
					return formatMessage(405);
				default:
					return formatMessage(405);
			}
		} else {
			return formatMessage(404, "Controller successful accessed");
		}

	}

	function getTasks() {
		return formatMessage(200, db_get_tasks());
	}


	function insertTask($title) {
		$title = sanitize_input($title);
		db_insert_task($title);
		return formatMessage(200);
	}


	function completeTask($id) {
		if ($id) {
			db_complete_task($id);
		} else {

		}
		return formatMessage(200);
	}


	function registerUser($user) {
		return formatMessage(501, "registerUser function is not implemented !!!");
	}

	function login($login) {
		return formatMessage(501, "login function is not implemented !!!");
	}


	function createJWT($user) {
	}

	function checkJWT() {
	}

	function checkRegistration($user) {
	}