<?php

    class Produto {
        
        private $codProd;
        private $referencia;
        private $descricao;
        private $custo;

        function __construct(){
            
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

    }



?>