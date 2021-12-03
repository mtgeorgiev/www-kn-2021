<?php

class UserRepository {

    public function insert(User $user): User {

        $conn = (new Db())->getConnection();

        $insertStatement = $conn->prepare("
            INSERT INTO users (email, password)
            VALUES (:email, :password)
        ");

        // inserts the user into the db
        $insertSuccessful = $insertStatement->execute([
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]);

        if ($insertSuccessful) {
            $user->setId($conn->lastInsertId());
            return $user;
        } else {
            throw new RepositoryException($insertStatement->errorInfo()[2]);
        }

    }

}
