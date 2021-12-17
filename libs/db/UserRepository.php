<?php

class UserRepository {

    public static function insert(User $user): User {

        $conn = (new Db())->getConnection();

        $insertStatement = $conn->prepare("
            INSERT INTO users (email, password)
            VALUES (:email, :password)
        ");

        $hashedPassword = $user->getHashedPassword();
        // inserts the user into the db
        $insertSuccessful = $insertStatement->execute([
            'email' => $user->getEmail(),
            'password' => $hashedPassword,
        ]);

        if ($insertSuccessful) {
            $user->setId($conn->lastInsertId());
            return $user;
        } else {
            throw new RepositoryException($insertStatement->errorInfo()[2]);
        }
    }

    public static function fetchAll(): array {

        $conn = (new Db())->getConnection();

        $sql   = "SELECT * FROM users";

        $query = $conn->query($sql);

        $allUsers = [];
        while ($row = $query->fetch()) {
            $allUsers[] = User::createFromDbResponse($row);
        }

        return $allUsers;
    }

    public static function fetchByEmail(string $email): ?User {

        $conn = (new Db())->getConnection();

        $selectStatement = $conn->prepare("SELECT * FROM users WHERE email = :email");

        $selectStatement->execute(['email' => $email]);

        $userData = $selectStatement->fetch();

        if ($userData) {
            return User::createFromDbResponse($userData);
        }

        return null;
    }

}
