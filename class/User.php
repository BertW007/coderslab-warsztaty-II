<?php

class User
{
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct()
    {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->password = "";


    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($newpassword)
    {
        $this->password = $newpassword;
    }


    //zapisywanie do bazy danych

    public function saveToDB(mysqli $connection)
    {
        //jeżeli user nie istnieje
        if ($this->id == -1) {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$this->username' ,'$this->email', '$this->password')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }

        }
        return false;
    }

    static public function loadUserbyID(mysqli $connection, $id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedUser = new User();
            $loadedUser->id = $row["id"];
            $loadedUser->username = $row ["username"];
            $loadedUser->password = $row ["password"];
            $loadedUser->email = $row ["email"];

            return $loadedUser;
        }
        return null;
    }

    static public function loadAllUsers(mysqli $connection)
    {
        $sql = "SELECT * FROM users";
        $ret = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->password = $row['password'];
                $loadedUser->email = $row['email'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

    public function delete(mysqli $connection)
    {
        if ($this->id != -1) {
            $sql = "DELETE FROM users WHERE id = $this->id";
            if ($result == true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

    static public function loadUserbyEmail(mysqli $connection, $email)
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedUser = new User();
            $loadedUser->id = $row["id"];
            $loadedUser->username = $row ["username"];
            $loadedUser->password = $row ["password"];
            $loadedUser->email = $row ["email"];

            return $loadedUser;
        }
        return false;
    }

    static public function searchUser(mysqli $connection, $search)
    {
        $sql = "SELECT * FROM users WHERE username LIKE ".$search;

        $result = $connection->query($sql);

        $ret = [];
        $result = $connection->query($sql);
        if ($result == true ) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

    static public function getUserNameByID(mysqli $connection, $id)
    {
        $sql = "SELECT * FROM users WHERE id = ".$id;

        $result = $connection->query($sql);


        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $name = $row["username"];
            }
        }
        return $name;
    }
}