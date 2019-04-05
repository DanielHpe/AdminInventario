<?php 

    require_once('fragments\header.php'); 
    require_once('conexao\conexao.php');

    $conexao = new Conexao();

    $query = "SELECT * FROM userpcinfo a JOIN (SELECT cpf, MAX(data) data from userpcinfo a GROUP BY cpf) b
    ON a.cpf = b.cpf and a.data = b.data";

    $result = $conexao->selectAll($query, 0);

?>
<body>
<<<<<<< HEAD
    <div class="header">
        <img style="width: 200px; height: 200px; margin-top: -70px; margin-bottom: -50px; margin-left: 150px; position: absolute;" src="view/img/logo_stefanini.png" alt="logo" />
        <h2 style="margin-top:20px; margin-bottom:50px" class="text-center">Controle de Inventário</h2>
=======
    <div class="container">
        <div class="header" style="font-family: Cambria">
            <img style="width: 200px; height: 200px; margin-bottom:-50px; margin-top:-50px;" src="view/img/logo_stefanini.png" alt="logo" />
            <!-- <h2  class="text-center">Controle de Inventário</h2> -->
        </div>
>>>>>>> 7d12157a22c89e888fd4575912ff460473724067
    </div>
    <div class="container">
        <div class="jumbotron">
            <table id="table-server" class="display nowrap" style="width:100%">
                <div class="container">
                    <p id="date_filter">
                        <span id="date-label-from" class="date-label">From:<input class="date_range_filter date" type="date" id="dateFrom" />
                        <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="date" id="dateTo" />
                    </p>
                </div>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Enviado às: </th>
                        <th scope="col">CPF: </th>
                        <th scope="col">Nome: </th>
                        <th scope="col">Email: </th>
                        <th scope="col">Login: </th>
                        <th scope="col">Patrimonio: </th>
                        <th scope="col">Usuário: </th>
                        <th scope="col">Sistema: </th>
                        <th scope="col">Modelo: </th>
                        <th scope="col">CPU: </th>
                        <th scope="col">Número de Série: </th>
                        <th scope="col">Sistema Operacional: </th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?>
                        <tr>
                            <td><?php echo $row['data']; ?></td>
                            <td><?php echo $row['cpf']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['emailCorporativo']; ?></td>
                            <td><?php echo $row['loginRede']; ?></td>
                            <td><?php echo $row['patrimonio']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['system']; ?></td>
                            <td><?php echo $row['model']; ?></td>
                            <td><?php echo $row['cpu']; ?></td>
                            <td><?php echo $row['serialnumber']; ?></td>
                            <td><?php echo $row['os']; ?></td>                  
                        </tr>
                    <?php } ?>
                </tbody>     
            </table>
            <a href="exportcsv\exportarcsv.php?export=true" class="btn btn-success pull-right">Exportar como CSV</a>
        </div>
       
    </div>
    <div style="margin-bottom: 30px;" class="margin"></div>
<?php require_once('fragments\footer.php'); ?>