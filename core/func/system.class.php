<?php
    class sql
    {
        private
            $conn,
            $res
        ;

        public function __construct()
        {
            $this->conn = null;
            $this->res = null;

            $this->connect();
        }

        public function connect()
        {
            if($this->conn != null)
            {
                return true;
            }
            global 
                $host,
                $user,
                $pass,
                $db
            ;

            try
            {
                $this->conn = new \mysqli($host, $user, $pass, $db);
            }
            catch(Exception $e)
            {
                exit("<b>Error while connecting to the database server</b>");
            }
        }

        public function query($str)
        {
            if($this->conn == null)
            {
                $this->connect();
            }

            try
            {
                $this->res = $this->conn->query($str);
                return $this->res;
            }
            catch(Exception $e)
            {
                global $debug;
                if($this->conn->error)
                {
                    if($debug)
                    {
					    echo("MySQL query failed:<br /><b><{$this->conn->errno}></b> {$this->conn->error}");
                    }
                    else echo("<b>Failed to execute query</b>");
                }
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

        public function __destruct()
        {
            if($this->conn != null && $this->conn->connect_error)
            {
                $this->conn->close();
            }
        }
    }
?>