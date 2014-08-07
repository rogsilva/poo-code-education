<?php
require_once "../autoload.php";


$cliente1 = new \SON\Cliente\Types\PessoaFisica("333.333.333-12", "José Silva", "011 4444-5555", 3);
$cliente1->setEnderecos(new \SON\Cliente\Endereco("Rua Benedito Barbosa", 1200, "São Bernardo do Campo", "SP", "33333-333"))
        ->setEnderecos(new \SON\Cliente\Endereco("Rua Benedito Barbosa", 1252, "São Bernardo do Campo", "SP", "33333-333"));

$cliente2 = new \SON\Cliente\Types\PessoaFisica("444.333.444-12", "Paulo Ferraz", "011 99999-4444", 4);
$cliente2->setEnderecos(new \SON\Cliente\Endereco("Avenida Pereira Barreto", 1395, "Santo André", "SP", "45455-222"));

$cliente3 = new \SON\Cliente\Types\PessoaJuridica("33.555.555/0001-01", "111.222.333.444", "Empresa 1 Ltda", "Empresa 1", "011 5555-5555", 2);
$cliente3->setEnderecos(new \SON\Cliente\Endereco("Avenida Paulista", 1100, "São Paulo", "SP", "45455-222"));

$cliente4 = new \SON\Cliente\Types\PessoaJuridica("33.444.777/0001-01", "555.222.888.444", "Empresa 2 S/A", "Empresa 2", "011 7777-5555", 5);
$cliente4->setEnderecos(new \SON\Cliente\Endereco("Rua Augusta", 800, "São Paulo", "SP", "78787-354"))
        ->setEnderecos(new \SON\Cliente\Endereco("Avenida Paulista", 1200, "São Paulo", "SP", "78787-458"));


$clientes = array($cliente1, $cliente2, $cliente3, $cliente4);

if(isset($_GET['order']) && $_GET['order'] == 'desc'){
    krsort($clientes);
}

$listaClientes = '';
foreach($clientes as $key => $cliente){
    $estrelas = "";
    for($i = 0; $i < $cliente->getEstrelas(); $i++){
        $estrelas.="<i class=\"glyphicon glyphicon-star\"></i>";
    }
    $listaClientes.="
                        <tr>
                            <td>$key</td>
                            <td>".$cliente->getNome()."</td>
                            <td>".$cliente->getTelefone()."</td>
                            <td>$estrelas</td>
                            <td>".$cliente->getTipo()."</td>
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
                <h4 class="modal-title" id="myModalLabel"><?php echo $clientes[$_GET['id']]->getNome();?></h4>
            </div>
            <div class="modal-body">
                <?php if ($clientes[$_GET['id']]->getTipo() == "Pessoa Física"){?>
                    <p><strong>Tipo: </strong> <?php echo $clientes[$_GET['id']]->getTipo();?></p>
                    <p><strong>Nome: </strong> <?php echo $clientes[$_GET['id']]->getNome();?></p>
                    <p><strong>CPF: </strong> <?php echo $clientes[$_GET['id']]->getCpf();?></p>
                    <p><strong>Telefone: </strong> <?php echo $clientes[$_GET['id']]->getTelefone();?></p>
                    <?php
                        $estrelas = "";
                        for($i = 0; $i < $clientes[$_GET['id']]->getEstrelas(); $i++){
                            $estrelas.="<i class=\"glyphicon glyphicon-star\"></i>";
                        }
                    ?>
                    <p><strong>Qualificação: </strong> <?php echo $estrelas;?></p>
                    <p><strong>Endereço(s):</strong></p>
                    <?php
                        $enderecos = "";
                        foreach($clientes[$_GET['id']]->getEnderecos() as $endereco){
                            $enderecos.="<p>".$endereco->getLogradouro(). ", " . $endereco->getNumero(). ", " . $endereco->getCidade(). " - " . $endereco->getEstado() ."</p>";
                        }

                        echo $enderecos;
                    ?>
                <?php }else{?>

                    <p><strong>Tipo: </strong> <?php echo $clientes[$_GET['id']]->getTipo();?></p>
                    <p><strong>Nome: </strong> <?php echo $clientes[$_GET['id']]->getNome();?></p>
                    <p><strong>Razão Social: </strong> <?php echo $clientes[$_GET['id']]->getRazao();?></p>
                    <p><strong>CNPJ: </strong> <?php echo $clientes[$_GET['id']]->getCnpj();?></p>
                    <p><strong>Inscrição Estadual: </strong> <?php echo $clientes[$_GET['id']]->getIe();?></p>
                    <p><strong>Telefone: </strong> <?php echo $clientes[$_GET['id']]->getTelefone();?></p>
                    <?php
                    $estrelas = "";
                    for($i = 0; $i < $clientes[$_GET['id']]->getEstrelas(); $i++){
                        $estrelas.="<i class=\"glyphicon glyphicon-star\"></i>";
                    }
                    ?>
                    <p><strong>Qualificação: </strong> <?php echo $estrelas;?></p>
                    <p><strong>Endereço(s):</strong></p>
                    <?php
                    $enderecos = "";
                    foreach($clientes[$_GET['id']]->getEnderecos() as $endereco){
                        $enderecos.="<p>".$endereco->getLogradouro(). ", " . $endereco->getNumero(). ", " . $endereco->getCidade(). " - " . $endereco->getEstado() ."</p>";
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