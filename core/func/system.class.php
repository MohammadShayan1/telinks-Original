<?php
class sql
{
    private $conn;
    private $res;

    public function __construct()
    {
        $this->conn = null;
        $this->res = null;
        $this->connect();
    }

    public function connect()
    {
        if ($this->conn != null) {
            return true;
        }
        global $host, $user, $pass, $db;

        try {
            $this->conn = new \mysqli($host, $user, $pass, $db);
        } catch (Exception $e) {
            exit("<b>Error while connecting to the database server:</b> " . $e->getMessage());
        }
    }

    public function query($str)
    {
        if ($this->conn == null) {
            $this->connect();
        }

        try {
            $this->res = $this->conn->query($str);
            return $this->res;
        } catch (Exception $e) {
            echo "<b>MySQL query failed:</b> " . $this->conn->error;
        }
    }

    public function escape($str)
    {
        return $this->conn->escape_string($str);
    }

    public function insertId()
    {
        return $this->conn->insert_id;
    }

    public function fetch_assoc($result = null)
    {
        if ($result === null) {
            $result = $this->res;
        }
        return $result ? $result->fetch_assoc() : null;
    }

    public function num_rows($result = null)
    {
        if ($result === null) {
            $result = $this->res;
        }
        return $result ? $result->num_rows : 0;
    }

    // Getter method to access the last error
    public function getError()
    {
        return $this->conn ? $this->conn->error : null;
    }

    public function __destruct()
    {
        if ($this->conn != null && !$this->conn->connect_error) {
            $this->conn->close();
        }
    }
}
?>