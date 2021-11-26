<?php

class UserRepository {

    public function insert(User $user): User {

        // inserts the user into the db
        $id = 12;
        $user->setId($id);

        // throw new RepositoryException("testing exception 2");

        return $user;
    }

}