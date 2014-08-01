<?php

class Endereco {

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