<?php
/*
    Projeto: Mobshare
    Autor: Leonardo
    Data Criação: 02/04/2019
    Data Modificação: 16/04/2018
    Conteudo Modificação: inserindo as classes DAO
    Autor da Modificação: Emanuelly
    Objetivo da classe: CRUD da classe da marca
*/

//Import do arquivo de constantes
@session_start();
require_once($_SESSION["importInclude"]); 

class marcaDAO{

    private $conex;

    public function __construct(){
        //Import da classe do banco para todos os métodos
        require_once(IMPORT_CONEXAO);

        //Instancia da classe conexão
        $this->conex = new conexaoMySQL();
    }

    //Inserir um registro no banco de dados.
    public function insert(Marca $marca){
        $sql = INSERT . TABELA_MARCA . " 
        (nomeMarca)
        VALUES (
        '".$marca->getNomeMarca()."')";

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //Executa no BD o script Insert e retorna verdadeiro/falso
        if($PDO_conex->query($sql)){
            $erro = false;
        }else{
            $erro = true;
        }
        //Fecha a conexão com o BD
        $this->conex->closeDataBase();
        return $erro;
    }

    //Deletar um registro no banco de dados.
    public function delete($id){
        $sql = DELETE . TABELA_MARCA . " where idMarca =".$id;

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //Executa no BD o script Insert e retorna verdadeiro/falso
        if($PDO_conex->query($sql)){
            $erro = false;
        }else{
            $erro = true;
        }
        //Fecha a conexão com o BD
        $this->conex->closeDataBase();
        return $erro;
    }

    //Atualiza um registro no banco de dados.
    public function update(Marca $marca){
        $sql = UPDATE . TABELA_MARCA . " 
        SET nomeMarca = '".$marca->getNomeMarca()."'
        WHERE idMarca = '".$marca->getIdMarca()."';";
        
        echo($sql);
        
        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //Executa no BD o script Insert e retorna verdadeiro/falso
        if($PDO_conex->query($sql)){
            $erro = false;
        }else{
            $erro = true;
        }
        //Fecha a conexão com o BD
        $this->conex->closeDataBase();
        return $erro;
    }



//seleciona as marcas dos veiculos
    public function selectAll(){
        $sql = 'select * from marca';

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);
        $cont = 0;
        
        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
        while($rsMarcas=$select->fetch(PDO::FETCH_ASSOC)){
            $listMarcas[] = new Marca();
            $listMarcas[$cont]->setIdMarca($rsMarcas["idMarca"]);
            $listMarcas[$cont]->setNomeMarca($rsMarcas["nomeMarca"]);
            
 
            

            
            $cont++;
        }

        $this->conex->closeDataBase();

        return($listMarcas);

    }

    //Seleciona um registro pelo ID.
    public function selectById($id){
        $sql = SELECT . TABELA_MARCA . " WHERE idMarca=".$id;

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);
        
        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
        if($rsMarca=$select->fetch(PDO::FETCH_ASSOC)){
        $marca = new Marca();
        $marca->setIdMarca($rsMarca["idMarca"]);
        $marca->setNomeMarca($rsMarca["nomeMarca"]);
        
        }
       

        $this->conex->closeDataBase();

        return($marca);
    }
}
?>