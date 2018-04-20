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
        if (!($userStatus && $rolStatus)) {
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
     * @return User[]
     */
    public static function all()
    {
        $stmt = MySQL::getConnection()->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    /**
     * @param $id
     * @param $username
     * @param $email
     * @param $adres
     * @param $plaats
     * @param $postcode
     * @return bool
     */
    public static function updateUser($id, $username, $email, $adres, $plaats, $postcode, $rol)
    {
        $stmt = MySQL::getConnection()->prepare("UPDATE users SET username = :username, email = :email, adres = :adres, plaats = :plaats, postcode = :postcode WHERE id = :id");
        $usersTabelStatus = $stmt->execute([
            'username' => $username,
            'email' => $email,
            'adres' => $adres,
            'plaats' => $plaats,
            'postcode' => $postcode,
            'id' => $id
        ]);
        $stmt = MySQL::getConnection()->prepare("UPDATE rollen SET level = ? WHERE userid = ?");
        $rolTabelStatus = $stmt->execute([
            $rol,
            $id
        ]);
        return $usersTabelStatus && $rolTabelStatus;
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

    /**
     * @param $email
     * @param $wachtwoord
     * @return bool|User
     */
    public static function login($email, $wachtwoord)
    {
        $stmt = MySQL::getConnection()->prepare("SELECT id,username,wachtwoord,email FROM users WHERE email = :email");
        $stmt->execute([
            'email' => $email,
        ]);
        $user = $stmt->fetchObject();
        if (password_verify($wachtwoord, $user->wachtwoord)) {
            return self::getUserByEmail($email);
        } else {
            return false;
        }
    }

    public static function isLoggedin()
    {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;
    }
}