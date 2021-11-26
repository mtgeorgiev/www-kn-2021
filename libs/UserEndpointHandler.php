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

    public static function get() {
        
    }

    public static function update() {
        
    }

    public static function delete() {
        
    }

}