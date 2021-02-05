<?php 

    class VendaFactory{
        
        private $listVendedor = array();


        function __construct(){
            
        }


        public function getListVendedor(){
            return $this->listVendedor;
        }


        public function thisExists($codVendedor, $valorVenda){
            if(count($this->listVendedor) === 0){
                $vendaVendedor =  new VendaVendedor();
                    $vendaVendedor->setCodVendedor($codVendedor);
                    $vendaVendedor->setNomeVendedor($codVendedor);
                    $vendaVendedor->addSubTotal($valorVenda);
                array_push($this->listVendedor, $vendaVendedor);
                return true;
            } else {
                for($i=0; $i<count($this->listVendedor); $i++){
                    if($codVendedor == $this->listVendedor[$i]->getCodVendedor()){
                        $this->listVendedor[$i]->addSubTotal($valorVenda);
                        return true;
                    }
                }

                $vendaVendedor = new VendaVendedor();
                    $vendaVendedor->setCodVendedor($codVendedor);
                    $vendaVendedor->setNomeVendedor($codVendedor);
                    $vendaVendedor->addSubTotal($valorVenda);
                array_push($this->listVendedor, $vendaVendedor);

            }
        }


        public function totalVendasVendedores(){
            if(count($this->listVendedor) > 0){
                $sum = 0;
                for($i=0; $i<count($this->listVendedor); $i++){
                    $sum += $this->listVendedor[$i]->getSubTotal();
                }
            }
            return $sum;
        }


        public function vendasPorAno($anoVenda, $valorVenda){
            if(count($this->listVendedor) == 0){
                $venda = new VendaVendedor();
                    $venda->setDataVenda($anoVenda);
                    $venda->addSubTotal($valorVenda);
                array_push($this->listVendedor, $venda);
            } else {
                for($i=0; $i<count($this->listVendedor); $i++){
                    if($this->listVendedor[$i]->getDataVenda() === $anoVenda){
                        $this->listVendedor[$i]->addSubTotal($valorVenda);
                        return true;
                    }
                }
    
                $venda = new VendaVendedor();
                    $venda->setDataVenda($anoVenda);
                    $venda->addSubTotal($valorVenda);
                array_push($this->listVendedor, $venda);
            }
        }


        
    }

?>