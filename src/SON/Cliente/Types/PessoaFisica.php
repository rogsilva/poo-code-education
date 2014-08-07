<?php

namespace SON\Cliente\Types;

use SON\Cliente\ClienteAbstract;

class PessoaFisica extends ClienteAbstract {

        private $cpf;


        public function __construct($cpf, $nome, $telefone, $estrelas)
        {
                $this->setCpf($cpf);
                parent::__construct($nome, $telefone, $estrelas, "Pessoa Física");
        }
        /**
         * @param mixed $cpf
         */
        public function setCpf($cpf)
        {
            $this->cpf = $cpf;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCpf()
        {
            return $this->cpf;
        }


} 