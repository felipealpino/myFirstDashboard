<?php
require '../php_controller/dataAccessObject.php';
class ProducaoDaoODBC{

    public function __construct(){

    }


    public function getPesoPorDia($mes, $ano){
        // Manipulando valores $mes e $ano caso passados pelo form
        // Obtendo peso por dia e adicionando em um array
        if ($mes && $ano) {
            $dados = producaoAccessData($mes, $ano);

            /**
             * Declarando array $pesoDia de [0] até [30]
             */
            $pesoDia = array_fill(0, 31, 0);


            /**
             * TIPOMOV = 11 = ENTRADA ACABADO
             * CODPROD = 000880 = QUILO ISOFTALICO BRANCO
             * CODPROD = 000383 = QUILO ISOFTALICO 
             */
            while (odbc_fetch_row($dados)) {
                $arrayData = explode("-", odbc_result($dados, "DT_MOVIMENTO"));
                if (
                    odbc_result($dados, "TIPOMOV") == "11"
                    && (odbc_result($dados, "CODPROD") == "000880"
                        || odbc_result($dados, "CODPROD") == "000383")
                ) {

                    $dia = substr(($arrayData[2]), 0, 2);
                    $quant = odbc_result($dados, "QUANTIDADE");

                    /**
                     * Se o dia é 1, soma quantidade no $pesoDia[0]
                     * Se o dia é 2, soma quantidade no $pesoDia[1] ...... 
                     */
                    $pesoDia[$dia - 1] += $quant;
                }
            }
        }

        return $pesoDia;
    }


    public function getDiasProduzidos($pesoDia){
        /**
         * Descobrindo quantos dias da semana tiveram 0kg produzidos
         * Esse valor armazenado em $z será util para fazer a média do mês
         */
        $z = 0;
        for ($contador = 0; $contador < count($pesoDia); $contador++) {
            if ($pesoDia[$contador] !== 0) {
                $z += 1;
            }
        }
        return $z;
    }



    public function getMediaKgProdPorDia($pesoDia, $diasProduzido){
    
        /**
         * Descobrindo média produzia no mês
         */
        $pesoTotal = array_sum($pesoDia);
        if ($diasProduzido !== 0) {
            $mediaMes = ($pesoTotal / $diasProduzido);
        } else {
            $mediaMes = 0;
        }
        return $mediaMes;
    }



    public function getPesoPorDiaUltimosAnos($mes, $ano){
        // Manipulando valores $mes e $ano caso passados pelo form
        // Obtendo peso por dia e adicionando em um array
        $arrayPesoDia = array();
        $qtAnosConsiderados = 3; 
        $ano = $ano - $qtAnosConsiderados;
        for ($i=$qtAnosConsiderados; $i>=0; $i--){
            $pesoDia = $this->getPesoPorDia($mes, $ano);
            array_push($arrayPesoDia, array_sum($pesoDia));
            $ano++;
        }
        return $arrayPesoDia;

    }


}
