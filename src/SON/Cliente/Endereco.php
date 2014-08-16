<?php

namespace SON\Cliente;

class Endereco {

        private $id;
        private $clientes_id;
        private $logradouro;
        private $numero;
        private $cidade;
        private $estado;
        private $cep;


        public function __construct($logradouro, $numero, $cidade, $estado, $cep)
        {
                $this->setLogradouro($logradouro)
                    ->setNumero($numero)
                    ->setCidade($cidade)
                    ->setEstado($estado)
                    ->setCep($cep);
        }

        /**
         * @param mixed $clientes_id
         */
        public function setClientesId($clientes_id)
        {
            $this->clientes_id = $clientes_id;
        }

        /**
         * @return mixed
         */
        public function getClientesId()
        {
            return $this->clientes_id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $cep
         */
        public function setCep($cep)
        {
            $this->cep = $cep;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCep()
        {
            return $this->cep;
        }

        /**
         * @param mixed $cidade
         */
        public function setCidade($cidade)
        {
            $this->cidade = $cidade;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCidade()
        {
            return $this->cidade;
        }

        /**
         * @param mixed $estado
         */
        public function setEstado($estado)
        {
            $this->estado = $estado;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getEstado()
        {
            return $this->estado;
        }

        /**
         * @param mixed $logradouro
         */
        public function setLogradouro($logradouro)
        {
            $this->logradouro = $logradouro;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getLogradouro()
        {
            return $this->logradouro;
        }

        /**
         * @param mixed $numero
         */
        public function setNumero($numero)
        {
            $this->numero = $numero;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getNumero()
        {
            return $this->numero;
        }


} 