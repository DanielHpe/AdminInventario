<?php

    class ExportData{

        private $result;

        public function __construct($result){
            $this->result = $result;
        }

        public function exportData(){
            $delimiter = ",";
            $filename = "dados" . date('Ymd') . ".csv"; // Create file name
             
            $f = fopen('php://memory', 'w'); 
             
            $fields = array('ID', 'CPF', 'Nome', 'Email', 'Login','Nome de usuario', 'Sistema', 
            'ModeloPc', 'CPU','SerialNumber', 'SistemaOperacional', 'Data');
            fputcsv($f, $fields, $delimiter);
             
            while($row = $this->result->fetch(PDO::FETCH_ASSOC)){     
                $lineData = array($row['id'], $row['cpf'], $row['name'], $row['emailCorporativo'], $row['loginRede'],$row['username'],
                $row['system'], $row['model'], $row['cpu'], $row['serialnumber'], $row['os'], $row['data']);
                fputcsv($f, $lineData, $delimiter);
            }
             
            fseek($f, 0);
        
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
        
            fpassthru($f);        
        }

    }

    require_once('..\conexao\conexao.php');

    $conexao = new Conexao();
    $query = "SELECT MAX(data) AS lastSended, id, cpf, name, emailCorporativo, patrimonio, loginRede, username, system, model, cpu, serialnumber, os, data 
        FROM userpcinfo
        GROUP BY cpf, name, emailCorporativo, patrimonio, loginRede, username, system, model, cpu, serialnumber, os
        ORDER BY data DESC";

    if(isset($_GET['export'])){
        $result = $conexao->selectAll($query, 0);
    }

    $exportData = new ExportData($result);
    $exportData->exportData();
    
?>