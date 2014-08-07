<?php

namespace SON\Cliente\Interfaces;

use SON\Cliente\Endereco;

interface ClienteInterface {

        public function setEstrelas($estrelas);
        public function getEstrelas();

        public function setEnderecos(Endereco $endereco);
        public function getEnderecos();

} 