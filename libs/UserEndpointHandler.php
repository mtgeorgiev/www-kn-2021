<?php

declare(strict_types=1);

class UserEndpointHandler {

    /**
     * Registers a new user to the system
     * 
     * @return newly created user
     */
    public static function create(): User {

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $user = new User($data['email'], $data['password']);

        // check if the user is valid

        return (new UserRepository())->insert($user);
    }

    public static function getOne(): User {
        
    }

    
    public static function getAll(): array {
        // TODO move to UserRepository    
        $conn  = new PDO('mysql:host=localhost;dbname=www_kn_2021', 'root', '');

        $sql   = "SELECT * FROM users";

        $query = $conn->query($sql);

        $allUsers = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $allUsers[] = User::createFromDbResponse($row);
        }

        return $allUsers;
    }

    public static function update(): User {

    }

    public static function delete(): void {
        
    }

}
