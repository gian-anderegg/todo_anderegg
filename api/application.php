<?php

    use Firebase\JWT\JWT;

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

        if (checkRegistration($user) === false) {
            return formatMessage(400, "Username already exists");

        } else {
            $password = $user->password;
            $username = $user->username;

            $hashedPassword = password_hash($checkedPassword, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username' => $username, 'password' => $hashedPassword]);

            if ($stmt->rowCount() > 0) {
                return formatMessage(200, "User registered successfully");
            } else {
                return formatMessage(500, "Registration failed");
            }
        }
    }

    function checkRegistration($user) {
        global $pdo;

        $password = $user->password;
        $username = $user->username;
        $checkedPassword = checkPassword($password); //?
        $checkedUsername = checkUsername($username);

        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $checkedUsername]);

        if ($stmt->rowCount() > 0) {
            return false;
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
        $user = array(
            'id' => 123,
            'username' => 'my_username'
        );

        $jwt = createJWT($user);

        return formatMessage(200, "Login successful: " . $jwt);
    }

    function createJWT($user) {
        $secret_key = JWT_SECRET;

        $payload = array(
            'sub' => $user['id'],
            'username' => $user['username']
        );

        $expiration_time = time() + 3600000;

        $jwt = JWT::encode(
            array(
                'exp' => $expiration_time,
                'iat' => time(),
                'nbf' => time(),
                'data' => $payload
            ),
            $secret_key,
            'HS256'
        );

        return $jwt;
    }

    function checkJWT() {

    }


?>