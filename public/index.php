<?php
//Chamada do autoload
require_once "../autoload.php";

$conn = new \SON\Database\Connection('localhost', 'poo', 'root', 'root');
$db = $conn->connect();

$fixture = new \SON\Fixtures\Cliente\Fixture($db);
$fixture->createTables();
$fixture->insert();


$stmt = $db->prepare("SELECT * FROM clientes ORDER BY id ASC ");
$stmt->execute();

$clientes = $stmt->fetchAll(PDO::FETCH_OBJ);



if(isset($_GET['order']) && $_GET['order'] == 'desc'){
    krsort($clientes);
}

$listaClientes = '';
foreach($clientes as $cliente){
    $estrelas = "";
    for($i = 0; $i < $cliente->estrelas; $i++){
        $estrelas.="<i class=\"glyphicon glyphicon-star\"></i>";
    }
    $listaClientes.="
                        <tr>
                            <td>$cliente->id</td>
                            <td>".$cliente->nome."</td>
                            <td>".$cliente->telefone."</td>
                            <td>$estrelas</td>
                            <td>".$cliente->tipo."</td>
                        </tr>
                    ";
}


if(isset($_GET['id'])){
    $stmt = $db->prepare("SELECT * FROM clientes WHERE id = :id ORDER BY id ASC ");
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();

    $cli = $stmt->fetch(PDO::FETCH_OBJ);

    $stmt = $db->prepare("SELECT * FROM enderecos WHERE clientes_id = :id ORDER BY id ASC ");
    $stmt->bindValue(':id', $cli->id);
    $stmt->execute();

    $arrayEnderecos = $stmt->fetchAll(PDO::FETCH_OBJ);


}


$fixture->dropTables();
$conn->disconnect()
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aula Code Education - Foundation">
    <meta name="author" content="Rogério SIlva">

    <title>Code Education - POO</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo "http://".$_SERVER['HTTP_HOST']?>/css/bootstrap.css" rel="stylesheet">


    <!-- JavaScript -->
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST']?>/js/jquery-1.10.2.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST']?>/js/bootstrap.js"></script>
</head>

<body>


<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">POO</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a>
                </li>
            </ul>

        </div>
        <!-- /.navbar-collapse -->

    </div>
    <!-- /.container -->
</nav>

<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1>Lista de Clientes</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <a href="index.php?order=asc" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-arrow-down"></i></a>
                            <a href="index.php?order=desc" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-arrow-up"></i></a>
                        </th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Qualificação</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $listaClientes;?>
                </tbody>
            </table>
        </div>
    </div>



    <footer class="navbar-fixed-bottom ">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>Todos os direitos reservados - <?php echo date('Y');?></p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<?php if(isset($_GET['id'])):?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $cli->nome;?></h4>
            </div>
            <div class="modal-body">
                <?php if ($cli->tipo == "Pessoa Física"){?>
                    <p><strong>Tipo: </strong> <?php echo $cli->tipo;?></p>
                    <p><strong>Nome: </strong> <?php echo $cli->nome;?></p>
                    <p><strong>CPF: </strong> <?php echo $cli->cpf;?></p>
                    <p><strong>Telefone: </strong> <?php echo $cli->telefone;?></p>
                    <?php
                        $estrelas = "";
                        for($i = 0; $i < $cli->estrelas; $i++){
                            $estrelas.="<i class=\"glyphicon glyphicon-star\"></i>";
                        }
                    ?>
                    <p><strong>Qualificação: </strong> <?php echo $estrelas;?></p>
                    <p><strong>Endereço(s):</strong></p>
                    <?php
                        $enderecos = "";
                        foreach($arrayEnderecos as $endereco){
                            $enderecos.="<p>".$endereco->logradouro. ", " . $endereco->numero. ", " . $endereco->cidade. " - " . $endereco->estado ."</p>";
                        }

                        echo $enderecos;
                    ?>
                <?php }else{?>

                    <p><strong>Tipo: </strong> <?php echo $cli->tipo;?></p>
                    <p><strong>Nome: </strong> <?php echo $cli->nome;?></p>
                    <p><strong>Razão Social: </strong> <?php echo $cli->razao;?></p>
                    <p><strong>CNPJ: </strong> <?php echo $cli->cnpj;?></p>
                    <p><strong>Inscrição Estadual: </strong> <?php echo $cli->ie;?></p>
                    <p><strong>Telefone: </strong> <?php echo $cli->telefone;?></p>
                    <?php
                    $estrelas = "";
                    for($i = 0; $i < $cli->estrelas; $i++){
                        $estrelas.="<i class=\"glyphicon glyphicon-star\"></i>";
                    }
                    ?>
                    <p><strong>Qualificação: </strong> <?php echo $estrelas;?></p>
                    <p><strong>Endereço(s):</strong></p>
                    <?php
                    $enderecos = "";
                    foreach($arrayEnderecos as $endereco){
                        $enderecos.="<p>".$endereco->logradouro. ", " . $endereco->numero. ", " . $endereco->cidade. " - " . $endereco->estado ."</p>";
                    }

                    echo $enderecos;
                    ?>

                <?php }?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<?php endif;?>

<script>
    $(document).ready(function(){
        <?php if(isset($_GET['id'])):?>
            $('#myModal').modal('show');
        <?php endif;?>
        $('.table tbody tr').css('cursor', 'pointer');
        $('.table tbody tr').click(function(){
            location.href='index.php?order=' + <?php echo (isset($_GET['order']))? "\"{$_GET['order']}\"" : "\"asc\""?> + '&id=' + $('td:first-child',this).text();
        });

    });
</script>
</body>

</html>