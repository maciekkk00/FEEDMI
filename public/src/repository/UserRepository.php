<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u LEFT JOIN users_details ud 
            ON u.id_user = ud.id_user WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname']
        );
    }

    public function addUser(User $user): void
    {
        $stmt = $this->database->connect()->prepare('
            call addUser(?, ?, ?, ?);
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getName(),
            $user->getSurname()

        ]);
    }

    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users_details WHERE name = ? AND surname = ? 
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname()
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id_user'];
    }

    public function creatSession(User $user): string
    {
        $stmt = $this->database->connect()->prepare('
            select session_start(?);
        ');

        $stmt->execute([
            $user->getEmail()
        ]);


        $idSession= $stmt->fetch(PDO::FETCH_ASSOC)['session_start'];
        return $idSession;
    }

    public function getUserSession(string $id_session): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users JOIN session on users.id_user=session.id_user 
                JOIN users_details on users.id_user=users_details.id_user WHERE id_session=?;
        ');

        $stmt->execute([
            $id_session
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
        );
    }

    public function isValidSession(string $id_session): bool
    {
        return !(is_null($this->getUserSession($id_session)));
    }

    public function deleteSession(string $id_session): void
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM session WHERE id_session = ?
        ');
        $stmt->execute([
            $id_session
        ]);
    }

}