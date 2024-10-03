<?php
// Create SQL class instance
$sql = new sql();

if (isset($_GET["download"])) {
    $sql->downloadOlympiadCSV();
}

?>
