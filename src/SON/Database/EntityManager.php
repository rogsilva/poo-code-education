<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 13/08/14
 * Time: 23:03
 */

namespace SON\Database;

use \SON\Cliente\ClienteAbstract;
use SON\Cliente\Types\PessoaFisica;



class EntityManager {

    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function persist(ClienteAbstract $cliente)
    {
        try{

            $this->db->beginTransaction();

            if( $cliente instanceof PessoaFisica){

                $stmt = $this->db->prepare("INSERT INTO clientes (nome, telefone, estrelas, tipo, cpf) VALUES (:nome, :telefone, :estrelas, :tipo, :cpf)");
                $stmt->bindValue('nome', $cliente->getNome());
                $stmt->bindValue(':telefone', $cliente->getTelefone());
                $stmt->bindValue(':estrelas', $cliente->getEstrelas());
                $stmt->bindValue(':tipo', $cliente->getTipo());
                $stmt->bindValue(':cpf', $cliente->getCpf());
                $stmt->execute();

            }else{

                $stmt = $this->db->prepare("INSERT INTO clientes (nome, telefone, estrelas, tipo, cnpj, ie, razao) VALUES (:nome, :telefone, :estrelas, :tipo, :cnpj, :ie, :razao)");
                $stmt->bindValue(':nome', $cliente->getNome());
                $stmt->bindValue(':telefone', $cliente->getTelefone());
                $stmt->bindValue(':estrelas', $cliente->getEstrelas());
                $stmt->bindValue(':tipo', $cliente->getTipo());
                $stmt->bindValue(':cnpj', $cliente->getCnpj());
                $stmt->bindValue(':ie', $cliente->getIe());
                $stmt->bindValue(':razao', $cliente->getRazao());
                $stmt->execute();

            }

            $cliente->setId($this->db->lastInsertId());

            if( count($cliente->getEnderecos()) > 0 ){

                foreach($cliente->getEnderecos() as $endereco){

                    $stmt = $this->db->prepare("INSERT INTO enderecos (clientes_id, logradouro, numero, cidade, estado, cep) VALUES (:clientes_id, :logradouro, :numero, :cidade, :estado, :cep)");
                    $stmt->bindValue(':clientes_id', $cliente->getId());
                    $stmt->bindValue(':logradouro', $endereco->getLogradouro());
                    $stmt->bindValue(':numero', $endereco->getNumero());
                    $stmt->bindValue(':cidade', $endereco->getCidade());
                    $stmt->bindValue(':estado', $endereco->getEstado());
                    $stmt->bindValue(':cep', $endereco->getCep());

                    $stmt->execute();
                }

            }

        }
        catch(\PDOException $e){
            $this->db->rollBack();
            die("Erro: " . $e->getMessage());
        }
    }

    public function flush()
    {
        try {
            $this->db->commit();
        } catch (\PDOException $e) {
            die("Erro: " . $e->getMessage());
        }

        return true;
    }
} 