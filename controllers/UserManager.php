<?php
require_once "User.php";
require_once __DIR__ . "/../connection/MySQL.php";

class UserManager
{
    /**
     * @param $username
     * @param $adres
     * @param $postcode
     * @param $plaats
     * @param $email
     * @param $wachtwoord
     * @return bool
     */
    public static function createUser($username, $adres, $postcode, $plaats, $email, $wachtwoord)
    {
        $connection = MySQL::getConnection();
        $stmt = $connection->prepare("INSERT INTO users (username, adres, postcode, plaats, email, wachtwoord) VALUES (:username, :adres, :postcode, :plaats, :email, :wachtwoord)");
        $userStatus = $stmt->execute([
            'username' => $username,
            'adres' => $adres,
            'postcode' => $postcode,
            'plaats' => $plaats,
            'email' => $email,
            'wachtwoord' => password_hash($wachtwoord, PASSWORD_BCRYPT)
        ]);
        $stmt = $connection->prepare("INSERT INTO rollen (userid) VALUES (?)");
        $rolStatus = $stmt->execute([$connection->lastInsertId()]);
        if ($userStatus && $rolStatus) {
            $connection->rollBack();
            die(500);
        }
        return $userStatus && $rolStatus;
    }

    /**
     * @param $email
     * @return User
     */
    public static function getUserByEmail($email)
    {
        $stmt = MySQL::getConnection()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([
            $email
        ]);
        return $stmt->fetchObject('User');
    }

    /**
     * @param $id
     * @return User
     */
    public static function getUserById($id)
    {
        $stmt = MySQL::getConnection()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject('User');
    }

    /**
     * @return array
     */
    public static function all()
    {
        $stmt = MySQL::getConnection()->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    /**
     * @param $user User
     * @return bool
     */
    public static function updateUser($user)
    {
        $stmt = MySQL::getConnection()->prepare("UPDATE users SET username = :username, email = :email, adres = :adres, plaats = :plaats, postcode = :postcode WHERE id = :id");
        return $stmt->execute([
            'username' => $user->username,
            'email' => $user->email,
            'adres' => $user->adres,
            'plaats' => $user->adres,
            'postcode' => $user->postcode,
            'id' => $user->id
        ]);
    }

    /**
     * @param $id
     * @return bool
     */
    public static function deleteUser($id)
    {
        $stmt = MySQL::getConnection()->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute([
            'id' => $id
        ]);
    }

    public static function login($email, $wachtwoord)
    {
        $stmt = MySQL::getConnection()->prepare("SELECT id,username,wachtwoord,email FROM users WHERE email = :email");
        $stmt->execute([
            'email' => $_POST['email'],
        ]);
    }
}