<?php
include_once 'classes/Cliente.php';

$clientes = array(
    new Cliente('Cliente 01', '01.010.101/0001-01', '1111-1111', 'Rua 01'),
    new Cliente('Cliente 02', '02.020.202/0001-02', '2222-2222', 'Rua 02'),
    new Cliente('Cliente 03', '03.030.303/0001-03', '3333-3333', 'Rua 03'),
    new Cliente('Cliente 04', '04.040.404/0001-04', '4444-4444', 'Rua 04'),
    new Cliente('Cliente 05', '05.050.505/0001-05', '5555-5555', 'Rua 05'),
    new Cliente('Cliente 06', '06.060.606/0001-06', '6666-6666', 'Rua 06'),
    new Cliente('Cliente 07', '07.070.707/0001-07', '7777-7777', 'Rua 07'),
    new Cliente('Cliente 08', '08.080.808/0001-08', '8888-8888', 'Rua 08'),
    new Cliente('Cliente 09', '09.090.909/0001-09', '9999-9999', 'Rua 09'),
    new Cliente('Cliente 10', '10.101.010/0001-10', '1010-1010', 'Rua 10')
);

if(isset($_GET['order']) && $_GET['order'] == 'desc'){
    krsort($clientes);
}

$listaClientes = '';
foreach($clientes as $key => $cliente){
    $listaClientes.="
                        <tr>
                            <td>$key</td>
                            <td>".$cliente->getNome()."</td>
                            <td>".$cliente->getTelefone()."</td>
                        </tr>
                    ";
}

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
                <h4 class="modal-title" id="myModalLabel"><?php echo $clientes[$_GET['id']]->getNome();?></h4>
            </div>
            <div class="modal-body">
                <p><strong>Nome: </strong> <?php echo $clientes[$_GET['id']]->getNome();?></p>
                <p><strong>CNPJ: </strong> <?php echo $clientes[$_GET['id']]->getCnpj();?></p>
                <p><strong>Telefone: </strong> <?php echo $clientes[$_GET['id']]->getTelefone();?></p>
                <p><strong>Endereço: </strong> <?php echo $clientes[$_GET['id']]->getEndereco();?></p>
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