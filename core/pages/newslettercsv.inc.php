<?php

global $sql;

if (isset($_GET["download"])) {
    $sql->downloadNewsletterCSV();
}


// // Set headers to force download
// header('Content-Type: text/csv');
// header('Content-Disposition: attachment;filename=newsletter.csv');

// // Use the global sql class object
// global $sql;

// // Query to fetch data
// $query = $sql->query("SELECT n_name, n_email FROM newsletter");

// // Open output stream
// $output = fopen('php://output', 'w');

// // Output CSV headers
// fputcsv($output, ['Name', 'Email']); // Column headers

// // Output data rows
// if ($sql->num_rows($query) > 0) {
//     while ($row = $sql->fetch_assoc($query)) {
//         fputcsv($output, $row);
//     }
// }

// // Close the output stream
// fclose($output);
// exit();
