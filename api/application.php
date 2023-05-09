<?php

    $secretKey = "eyJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMTIzNDU2Nzg5MCIsInVzZXJuYW1lIjoiZ2lhbl9hbmRlcmVnZyJ9.fsjRzusU9JtE1FjJH9jEPTi5VJ3ARPqvT133scP178c";

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
        global $pdo;

        $username = $user->username;
        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);

        if ($stmt->rowCount() > 0) {
            return formatMessage(400, "Username already exists");
        }

        $password = $user->password;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $hashedPassword]);

        if ($stmt->rowCount() > 0) {
            return formatMessage(200, "User registered successfully");
        } else {
            return formatMessage(500, "Registration failed");
        }

    }


    function login($login) {
        global $pdo;
        $username = $login->username;
        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);

        if ($stmt->rowCount() == 0) {
            return formatMessage(400, "Username does not exist");
        }

        $row = $stmt->fetch();
        $hashedPassword = $row['password'];

        $password = $login->password;
        if (!password_verify($password, $hashedPassword)) {
            return formatMessage(401, "Incorrect password");
        }

        // Generate a JWT token


        return formatMessage(200, "Login successful");
    }

    function createJWT($user) {

    }

    function checkJWT() {
    }

    function checkRegistration($user) {
    }

?>