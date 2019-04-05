<?php

    class ExportData{

        private $result;

        public function __construct($result){
            $this->result = $result;
        }

        public function exportData(){
            $delimiter = ",";
            $filename = "dados" . date('Ymd') . ".csv"; 
             
            $f = fopen('php://memory', 'w'); 
             
            $fields = array('ID', 'CPF', 'Nome', 'Email', 'Login', 'Patrimônio','Nome de usuario', 'Sistema', 
            'ModeloPc', 'CPU','SerialNumber', 'SistemaOperacional', 'Data');
            fputcsv($f, $fields, $delimiter);
             
            while($row = $this->result->fetch(PDO::FETCH_ASSOC)){     
                $lineData = array($row['id'], $row['cpf'], $row['name'], $row['emailCorporativo'], $row['loginRede'],
                $row['patrimonio'], $row['username'], $row['system'], $row['model'], $row['cpu'], $row['serialnumber'], $row['os'], $row['data']);
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

    $query = "SELECT * FROM userpcinfo a JOIN (SELECT cpf, MAX(data) data from userpcinfo a GROUP BY cpf) b
    ON a.cpf = b.cpf and a.data = b.data ORDER BY a.data DESC";

    if(isset($_GET['export'])){
        $result = $conexao->selectAll($query, 0);
    }

    $exportData = new ExportData($result);
    $exportData->exportData();
    
?>