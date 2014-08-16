<?php

namespace SON\Fixtures\Cliente;

use SON\Database\EntityManager;

class Fixture {

    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }


    public function createTables()
    {
        try{
            $this->db->exec("
                CREATE TABLE IF NOT EXISTS clientes (
                id INT NOT NULL AUTO_INCREMENT,
                nome VARCHAR(255) NULL,
                razao VARCHAR(45) NULL,
                telefone VARCHAR(45) NULL,
                estrelas INT NULL,
                tipo VARCHAR(45) NULL,
                cpf VARCHAR(45) NULL,
                cnpj VARCHAR(45) NULL,
                ie VARCHAR(45) NULL,
                PRIMARY KEY (`id`))
            ");

            $this->db->exec("
                CREATE TABLE IF NOT EXISTS enderecos (
                id INT NOT NULL AUTO_INCREMENT,
                clientes_id INT NOT NULL,
                logradouro VARCHAR(255) NULL,
                numero INT NULL,
                cidade VARCHAR(255) NULL,
                estado VARCHAR(255) NULL,
                cep VARCHAR(45) NULL,
                PRIMARY KEY (`id`))
            ");
        }
        catch(\PDOException $e){
            die('Erro: '. $e->getMessage());
        }
    }

    public function dropTables()
    {
        try{
            $this->db->exec("DROP TABLE enderecos");
            $this->db->exec("DROP TABLE clientes");
        }
        catch(\PDOException $e){
            die('Erro: '. $e->getMessage());
        }
    }

    public function insert(){
        $em = new EntityManager($this->db);

        $cliente1 = new \SON\Cliente\Types\PessoaFisica("333.333.333-12", "José Silva", "011 4444-5555", 3);
        $cliente1->setEnderecos(new \SON\Cliente\Endereco("Rua Benedito Barbosa", 1200, "São Bernardo do Campo", "SP", "33333-333"))
            ->setEnderecos(new \SON\Cliente\Endereco("Rua Benedito Barbosa", 1252, "São Bernardo do Campo", "SP", "33333-333"));
        $em->persist($cliente1);
        $em->flush();

        $cliente2 = new \SON\Cliente\Types\PessoaFisica("444.333.444-12", "Paulo Ferraz", "011 99999-4444", 4);
        $cliente2->setEnderecos(new \SON\Cliente\Endereco("Avenida Pereira Barreto", 1395, "Santo André", "SP", "45455-222"));
        $em->persist($cliente2);
        $em->flush();

        $cliente3 = new \SON\Cliente\Types\PessoaJuridica("33.555.555/0001-01", "111.222.333.444", "Empresa 1 Ltda", "Empresa 1", "011 5555-5555", 2);
        $cliente3->setEnderecos(new \SON\Cliente\Endereco("Avenida Paulista", 1100, "São Paulo", "SP", "45455-222"));
        $em->persist($cliente3);
        $em->flush();

        $cliente4 = new \SON\Cliente\Types\PessoaJuridica("33.444.777/0001-01", "555.222.888.444", "Empresa 2 S/A", "Empresa 2", "011 7777-5555", 5);
        $cliente4->setEnderecos(new \SON\Cliente\Endereco("Rua Augusta", 800, "São Paulo", "SP", "78787-354"))
            ->setEnderecos(new \SON\Cliente\Endereco("Avenida Paulista", 1200, "São Paulo", "SP", "78787-458"));
        $em->persist($cliente4);
        $em->flush();
    }
} 