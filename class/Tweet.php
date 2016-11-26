<?php


class Tweet
{
    private $id;
    private $userID;
    private $text;
    private $date;
    private $insertUser;

    function __construct()
    {
        $this->id = -1;
        $this->userID = "";
        $this->text = "";
        $this->date = "";
        $this->insertUser = "";
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
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param string $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param string $insertUser
     */
    public function setInsertUser($insertUser)
    {
        $this->insertUser = $insertUser;
    }

    /**
     * @return string
     */
    public function getInsertUser()
    {
        return $this->insertUser;
    }


    public function saveToDB(mysqli $connection)
    {
        //jeżeli user nie istnieje
        if ($this->id == -1) {
            $sql = "INSERT INTO tweet (userID, text, date, insertUser) VALUES ('$this->userID','$this->text', '$this->date','$this->insertUser')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }

        }
        return false;
    }

    static public function loadTweetByUser(mysqli $connection, $userID)
    {
        $sql = "SELECT * FROM tweet WHERE userID = '$userID'";
        $tweets = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userID = $row['userID'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->date = $row['date'];
                $loadedTweet->insertUser= $row['insertUser'];
                $tweets[] = $loadedTweet;
            }
        }
        return $tweets;
    }

    static public function deleteTweet(mysqli $connection, $id)
    {
            $sql = "DELETE  FROM tweet WHERE tweet.id = $id";


    }


}