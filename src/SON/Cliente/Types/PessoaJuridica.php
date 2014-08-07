<?php
namespace SON\Cliente\Types;

use SON\Cliente\ClienteAbstract;

class PessoaJuridica extends ClienteAbstract {

        private $cnpj;
        private $ie;
        private $razao;


        public function __construct($cnpj, $ie, $razao, $nome, $telefone, $estrelas)
        {
                $this->setCnpj($cnpj)
                     ->setIe($ie)
                     ->setRazao($razao);
                parent::__construct($nome, $telefone, $estrelas, "Pessoa Jurídica");
        }
        /**
         * @param mixed $cnpj
         */
        public function setCnpj($cnpj)
        {
            $this->cnpj = $cnpj;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCnpj()
        {
            return $this->cnpj;
        }

        /**
         * @param mixed $ie
         */
        public function setIe($ie)
        {
            $this->ie = $ie;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getIe()
        {
            return $this->ie;
        }

        /**
         * @param mixed $razao
         */
        public function setRazao($razao)
        {
            $this->razao = $razao;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getRazao()
        {
            return $this->razao;
        }



} 