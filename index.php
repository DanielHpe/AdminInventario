<?php 

    require_once('fragments\header.php'); 
    require_once('conexao\conexao.php');

    $conexao = new Conexao();

    $query = "SELECT MAX(data) AS lastSended, cpf, name, emailCorporativo, patrimonio, loginRede, username, system, model, cpu, serialnumber, os, data 
        FROM userpcinfo
        GROUP BY cpf, name, emailCorporativo, patrimonio, loginRede, username, system, model, cpu, serialnumber, os
        ORDER BY data DESC";

    $result = $conexao->selectAll($query, 0);

?>
<body>
    <div class="container table-show">
        <h1 style="margin-top:50px" class="text-center">Controle de Inventário</h1>
        <table id="table-server" class="display nowrap" style="width:100%">
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
                        <td><?php echo $row['lastSended']; ?></td>
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
    </div>

<?php require_once('fragments\footer.php'); ?>