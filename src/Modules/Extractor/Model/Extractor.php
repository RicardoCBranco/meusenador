<?php
namespace Ufrpe\Senadores\Modules\Extractor\Model;

class Extractor{
    public function __construct(){}

    public function insertSenadores(){
        /**
         * Variáveis auxiliares da função
         */
        $array = array();
        $i = 0;
        /**
         * Cria a tabela de senadores caso não exista
         */
        $this->criarTabelaSenadores();
        /**
         * Imprime o horário de inicio do processamento
         */
        echo "senadores:".date("H:i:s")."<br>";
        /**
         * Recupera os dados no site do senado
         */
        try {
            $file = simplexml_load_file("http://legis.senado.leg.br/dadosabertos/senador/lista/atual");
        } catch (\Exception $e) {
            throw new \RuntimeException($e);
        }
        $lista = $file->Parlamentares;

        /**
         * Criar um insert com os dados recolhidos no site do senado
         */
        $sql = "INSERT INTO senadores (codigo_parlamentar,nome_parlamentar,nome_completo_parlamentar,
        url_foto_parlamentar,url_pagina_parlamentar,email_parlamentar,sigla_partido_parlamentar,
        uf_parlamentar,sexo_parlamentar) VALUES ";
        foreach ($lista->Parlamentar as $xml) {
            $i++;
            $sql .= "(";
            $sql .= "'".$xml->IdentificacaoParlamentar->CodigoParlamentar."',";
            $sql .= "'".$xml->IdentificacaoParlamentar->NomeParlamentar."',";
            $sql .= "'".$xml->IdentificacaoParlamentar->NomeCompletoParlamentar."',";
            $sql .= "'".$xml->IdentificacaoParlamentar->UrlFotoParlamentar."',";
            $sql .= "'".$xml->IdentificacaoParlamentar->UrlPaginaParlamentar."',";
            $sql .= "'".$xml->IdentificacaoParlamentar->EmailParlamentar."',";
            $sql .= "'".$xml->IdentificacaoParlamentar->SiglaPartidoParlamentar."',";
            $sql .= "'".$xml->IdentificacaoParlamentar->UfParlamentar."',";
            $sql .= "'".$xml->IdentificacaoParlamentar->SexoParlamentar."'";
            $sql .= "),";
            if($i%10 == 0){
                echo "Estou na linha $i <br>";
            }
        }
        $sql = substr($sql,0,-1).";";
        /**
         * Inser os dados na tabela
         */
        $this->executeComando($sql);
        echo date("H:i:s")."fim senadores <hr>";
    }

    /**
     * Insere os dados sobre gastos dos parlamentares em uma tabela no banco de dados
     * @param $ano inteiro contendo o ano procurado
     */
    private function insertGastos($ano){
        $csv = fopen("http://www.senado.gov.br/transparencia/LAI/verba/2018.csv",'r');
        $array = [];
        while (($lin = fgetcsv($csv,4096,";")) !== FALSE){
            if(count($lin) == 10 && mb_strtoupper(utf8_encode($lin[2])) == mb_strtoupper($nome))  {
                $array[] = $lin;
            }
        }
        fclose($csv);
        array_shift($array);
        return $array;
    }

    /**
     * Executa o comando sql recebido de outras funções da classe
     * @param $sql string contendo o comando SQL a ser executado.
     */
    private function executeComando($sql){
        try{
            $con = \Ufrpe\Senadores\Data\Connection::getInstance();
            $stmt = $con->prepare($sql);
            $stmt->execute();
        }catch(\PDOException $e){
            throw new \Exception($e);
        }
    }

    /**
     * Cria no banco de dados a tabela de gastos
     */
    private function criarTabelaGastos(){
        $sql = "CREATE TABLE gastos(";
        $sql .= "codigo_parlamentar int null,";
        $sql .= "senador varchar(150),";
        $sql .= "ano int,";
        $sql .= "mes int,";
        $sql .= "tipo_despesa varchar(250),";
        $sql .= "cnpj_cpf varchar(20),";
        $sql .= "fornecedor varchar(150),";
        $sql .= "documento varchar(50) NULL,";
        $sql .= "data date,";
        $sql .= "detalhamento varchar(150),";
        $sql .= "valor_reembolsado float(7,2)";
        $sql .= ");";
        $this->executeComando();
    }

    /**
     * Cria no banco de dados a tabela de senadores
     */
    private function criarTabelaSenadores(){
        $sql = "CREATE TABLE senadores(";
        $sql .= "codigo_parlamentar int NOT NULL PRIMARY KEY,";
        $sql .= "nome_parlamentar varchar(150),";
        $sql .= "nome_completo_parlamentar varchar(250),";
        $sql .= "url_foto_parlamentar varchar(250),";
        $sql .= "url_pagina_parlamentar varchar(250),";
        $sql .= "email_parlamentar varchar(250),";
        $sql .= "sigla_partido_parlamentar varchar(250),";
        $sql .= "uf_parlamentar varchar(2),";
        $sql .= "sexo_parlamentar varchar(10)";
        $sql .= ");";
        $this->executeComando($sql);
    }
}