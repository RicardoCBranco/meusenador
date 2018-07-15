<?php
namespace Ufrpe\Senadores\Modules\Extractor\Model;

class Extractor{
    private $senador;

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
     * Cria o insert dos gastos
     */
    public function insertGastos($ano){
        $i = 0;

        echo "Inicio de gastos".\date("H:i:s")."<br>";

        foreach($this->getGastos($ano) as $linha){

            if(\mb_strtoupper($this->senador[1]) 
            !== \utf8_encode($linha[2]) || !isset($this->senador)){
                $this->senador = \Ufrpe\Senadores\Modules\Senador\Model\SenadorTable::
                search(\utf8_encode($linha[2]));
            }
            $sql = "INSERT INTO gastos(`codigo_parlamentar`,`ano`,`mes`,`senador`,`tipo_despesa`,`cnpj_cpf`,
                `fornecedor`,`documento`,`data`,`detalhamento`,`valor_reembolsado`) VALUES";
            $codigo = ($this->senador !== FALSE)? $this->senador[0]:0;
            $sql .= "(";
            $sql .= "'".$codigo."',";
            $sql .= "'".$linha[0]."',";
            $sql .= "'".$linha[1]."',";
            $sql .= "'".\utf8_encode($linha[2])."',";
            $sql .= "'".\str_replace("'","",\utf8_encode($linha[3]))."',";
            $sql .= "'".$linha[4]."',";
            $sql .= "'".\str_replace("'","",\utf8_encode($linha[5]))."',";
            $sql .= "'".$linha[6]."',";
            //Criando data
            $data = \DateTime::createFromFormat("d/m/Y",$linha[7]);
            $sql .= "'".$data->format("Y-m-d")."',";
            $sql .= "'".\str_replace(["'",'"'],"",\utf8_encode($linha[8]))."',";
            $sql .= "'".\str_replace(",",".",$linha[9])."'";
            $sql .= ");";
            $this->executeComando($sql);
            $i++;
            if($i % 100 == 0){
                echo "estou na linha $i<br>";
            } 
        }
        echo date("H:i:s")."Fim de gastos $ano<hr>";
    }

    public function deleteGastos(){
        $sql = "DELETE FROM gastos;";
        $this->executeComando($sql);
    }

    /**
     * Insere os dados sobre gastos dos parlamentares em uma tabela no banco de dados
     * @param $ano inteiro contendo o ano procurado
     */
    private function getGastos($ano){
        $csv = fopen("http://www.senado.gov.br/transparencia/LAI/verba/$ano.csv",'r');
        $array = [];
        while (($lin = fgetcsv($csv,4096,";")) !== FALSE){
            if(count($lin) == 10)  {
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
        }catch(\mysqli_sql_exception $e){
            die($e->getMessage());
        }
    }

    /**
     * Cria no banco de dados a tabela de gastos
     */
    private function criarTabelaGastos(){
        $sql = "CREATE TABLE IF NOT EXISTS gastos(";
        $sql .= "codigo_parlamentar int null,";
        $sql .= "senador varchar(150),";
        $sql .= "ano int,";
        $sql .= "mes int,";
        $sql .= "categoria_gastos int,";
        $sql .= "tipo_despesa longtext,";
        $sql .= "cnpj_cpf varchar(20),";
        $sql .= "fornecedor varchar(150),";
        $sql .= "documento varchar(50) NULL,";
        $sql .= "data date,";
        $sql .= "detalhamento longtext,";
        $sql .= "valor_reembolsado float(7,2)";
        $sql .= ");";
        $this->executeComando($sql);
    }

    /**
     * Cria no banco de dados a tabela de senadores
     */
    private function criarTabelaSenadores(){
        $sql = "CREATE TABLE IF NOT EXISTS senadores(";
        $sql .= "codigo_parlamentar int NOT NULL PRIMARY KEY,";
        $sql .= "nome_parlamentar varchar(250),";
        $sql .= "nome_completo_parlamentar varchar(250),";
        $sql .= "url_foto_parlamentar varchar(250),";
        $sql .= "url_pagina_parlamentar varchar(250),";
        $sql .= "email_parlamentar varchar(250),";
        $sql .= "sigla_partido_parlamentar varchar(50),";
        $sql .= "uf_parlamentar varchar(2),";
        $sql .= "sexo_parlamentar varchar(10)";
        $sql .= ");";
        $this->executeComando($sql);
    }

    private function criarTabelaPremiacao(){
        $sql = "CREATE TABLE IF NOT EXISTS `premiacao` (
            `codigo_parlamentar` int(11) DEFAULT NULL,
            `categoria_gastos` int(11) DEFAULT NULL,
            `colocacao` int(11) DEFAULT NULL,
            `img` varchar(50) DEFAULT NULL,
            KEY `FK_premiacao_senadores` (`codigo_parlamentar`),
            KEY `FK_premiacao_categorias` (`categoria_gastos`),
            CONSTRAINT `FK_premiacao_categorias` FOREIGN KEY (`categoria_gastos`) REFERENCES `categorias` (`idcategoria`),
            CONSTRAINT `FK_premiacao_senadores` FOREIGN KEY (`codigo_parlamentar`) REFERENCES `senadores` (`codigo_parlamentar`)
          );";
          $this->executeComando($sql);
    }

    public function criarTabelaCategorias(){
         $create = "CREATE TABLE IF NOT EXISTS categorias(".
                 "idcategoria INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
                 "tipo_despesa longtext,
                 titulo varchar(50))";
        $this->executeComando($create);

        $sql = "SELECT DISTINCT tipo_despesa FROM gastos;";

        $con = \Ufrpe\Senadores\Data\Connection::getInstance();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        foreach($rs as $ln){
            $cmd = "INSERT INTO categorias(tipo_despesa) VALUES (?)";
            $st = $con->prepare($cmd);
            $st->execute([$ln['tipo_despesa']]);
        }
    }

    public function atualizaTabelaGastos(){

        $con = \Ufrpe\Senadores\Data\Connection::getInstance();
        $stmt = $con->prepare("SELECT * FROM categorias");
        $stmt->execute();
        $categorias = $stmt->fetchAll();
        foreach($categorias as $cat){
            $upd = "UPDATE gastos SET categoria_gastos=".$cat['idcategoria'].
                   " WHERE tipo_despesa LIKE '".$cat['tipo_despesa']."';";
            $this->executeComando($upd);
        }
    }

    public function classificaPremiacoes(){
        
    }
}