<?php

/**
 * Created by PhpStorm.
 * User: porad
 * Date: 25.11.2016
 * Time: 09:53
 */
class Message
{
    private $id;
    private $senderId;
    private $receiverId;
    private $date;
    private $text;

    public function __construct()
    {
        $this->id = -1;
        $this->receiverId = "";
        $this->senderId = "";
        $this->date = "";
        $this->text = "";
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
    public function getSenderId()
    {
        return $this->senderId;
    }

    /**
     * @param string $senderId
     */
    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }

    /**
     * @return string
     */
    public function getReceiverId()
    {
        return $this->receiverId;
    }

    /**
     * @param string $receiverId
     */
    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
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


    public function sendMessage(mysqli $connection)
    {

        if ($this->id == -1) {

            $sql = "INSERT INTO message (senderID, receiverID, text, date) VALUES ('$this->senderId', '$this->receiverId',
                   '$this->text','$this->date')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;

            }
        }
        return false;
    }

    static public function loadReceivedMessages(mysqli $connection, $receiverID)
    {
        $sql = "SELECT * FROM message where receiverID = $receiverID";
        $ret = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $receivedMessage = new Message();
                $receivedMessage->id = $row['id'];
                $receivedMessage->receiverId = $row['receiverID'];
                $receivedMessage->senderId = $row['senderID'];
                $receivedMessage->text = $row['text'];
                $receivedMessage->date = $row['date'];

                $ret[] = $receivedMessage;
            }
        }
        return $ret;
    }

    static public function loadSendMessages(mysqli $connection, $senderID)
    {
        $sql = "SELECT * FROM message where senderID = $senderID";
        $ret = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $sendedMessage = new Message();
                $sendedMessage->id = $row['id'];
                $sendedMessage->receiverId = $row['receiverID'];
                $sendedMessage->senderId = $row['senderID'];
                $sendedMessage->text = $row['text'];
                $sendedMessage->date = $row['date'];

                $ret[] = $sendedMessage;
            }
        }
        return $ret;
    }

}