<?php
require_once 'ClienteInterface.php';

class Cliente implements ClienteInterface {

    protected $nome;
    protected $telefone;
    protected $enderecos;
    protected $estrelas;
    protected $tipo;

    public function __construct($nome, $telefone, $estrelas, $tipo){

        $this->setNome($nome)
             ->setTelefone($telefone)
             ->setEstrelas($estrelas)
             ->setTipo($tipo);

    }

    public function setEnderecos(Endereco $enderecos)
    {
        $this->enderecos[] = $enderecos;
        return $this;
    }

    public function getEnderecos()
    {
        return $this->enderecos;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
        return $this;
    }

    public function setEstrelas($estrelas)
    {
        $this->estrelas = $estrelas;
        return $this;
    }

    public function getEstrelas()
    {
        return $this->estrelas;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }


} 