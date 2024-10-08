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

    // Adding the prepare method
    public function prepare($query)
    {
        if ($this->conn == null) {
            $this->connect();
        }

        return $this->conn->prepare($query);
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
    function downloadNewsletterCSV()
    {
        // Set headers to force the download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="newsletter.csv"');

        // Query to fetch data
        $query = $this->query("SELECT n_name, n_email FROM newsletter");

        // Open output stream for writing
        $output = fopen('php://output', 'w');

        // Output the CSV column headers
        fputcsv($output, ['Name', 'Email']);

        // Output data rows
        if ($this->num_rows($query) > 0) {
            while ($row = $this->fetch_assoc($query)) {
                fputcsv($output, $row);
            }
        }

        // Close output stream
        fclose($output);

        // Terminate script execution after the file download
        exit();
    }

    function downloadOlympiadCSV()
    {
        // Set headers to force the download of CSV file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="olympiad_registrations.csv"');

        // Query to fetch data from the olympiad_registrations table
        $query = $this->query("SELECT name, roll_no, department, email, contact_no, gender, interest, experience, id_card, merch, commitment, rules FROM olympiad_registrations");

        // Open output stream for writing the CSV data
        $output = fopen('php://output', 'w');

        // Output the CSV column headers
        fputcsv($output, ['Name', 'Roll No', 'Department', 'Email', 'Contact No', 'Gender', 'Interest', 'Experience', 'ID Card', 'Merch', 'Commitment', 'Acknowledgement']);

        // Output data rows if there are any results
        if ($this->num_rows($query) > 0) {
            while ($row = $this->fetch_assoc($query)) {
                fputcsv($output, $row); // Writing each row to CSV
            }
        }

        // Close output stream
        fclose($output);

        // Terminate script execution after file download
        exit();
    }

    public function __destruct()
    {
        if ($this->conn != null && !$this->conn->connect_error) {
            $this->conn->close();
        }
    }
}
?>
