<?php

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "systeminfotest";
 
 $conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 
if(isset($_GET['export'])){
if($_GET['export'] == 'true'){
$query = mysqli_query($conn, 'SELECT MAX(data) AS lastSended, cpf, name, emailCorporativo, patrimonio, loginRede, username, system, model, cpu, serialnumber, os, data 
FROM userpcinfo
GROUP BY cpf, name, emailCorporativo, patrimonio, loginRede, username, system, model, cpu, serialnumber, os
ORDER BY data DESC'); // Get data from Database from demo table
 
 
    $delimiter = ",";
    $filename = "dados" . date('Ymd') . ".csv"; // Create file name
     
    //create a file pointer
    $f = fopen('php://memory', 'w'); 
     
    //set column headers
    $fields = array('ID', 'CPF', 'Nome', 'Email', 'Login','Nome de usuario', 'Sistema', 
    'ModeloPc', 'CPU','SerialNumber', 'SistemaOperacional', 'Data');
    fputcsv($f, $fields, $delimiter);
     
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        
        $lineData = array($row['id'], $row['cpf'], $row['name'], $row['emailCorporativo'], $row['loginRede'],$row['username'],
        $row['system'], $row['model'], $row['cpu'], $row['serialnumber'], $row['os'], $row['data']);
        fputcsv($f, $lineData, $delimiter);
    }
     
    //move back to beginning of file
    fseek($f, 0);
     
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
     
    //output all remaining data on a file pointer
    fpassthru($f);
 
 }
}