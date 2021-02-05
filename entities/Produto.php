<?php

    class Produto {
        
        private $codProd;
        private $referencia;
        private $descricao;
        private $custo;
        private $codFamilia;
        private $estoque;
        private $valorEmEstoque;

        function __construct(){
            if($this->estoque != ''){
                $this->valorEmEstoque = $this->estoque * $this->custo;
            }
        }
        
        
        public function getCodProd(){
            return $this->codProd;
        }
        public function setCodProd($codProd){
            $this->codProd = $codProd;
        }


        public function getReferencia(){
            return $this->referencia;
        }
        public function setReferencia($referencia){
            $this->referencia = $referencia;
        }


        public function getDescricao(){
            return $this->descricao;
        }
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }


        public function getCusto(){
            return $this->custo; 
        }
        public function setCusto($custo) {
            $this->custo = $custo;
        }


        public function getCodFamilia(){
            return $this->codFamilia;
        }
        public function setCodFamilia($codFamilia){
            $this->codFamilia = $codFamilia;
        }


        public function getEstoque(){
            return $this->estoque;
        }
        public function setEstoque($estoque){
            $this->estoque = $estoque;
        }


        public function getValorEmEstoque(){
            return $this->valorEmEstoque;
        }



        public function somaValorEstoque($valor){
            $this->valorEmEstoque += $valor;
        }

    }



?>