<?php
/*
    Projeto: Mobshare
    Autor: Igor
    Data Criação: 06/05/2019
    Data Modificação: 
    Conteudo Modificação: 
    Autor da Modificação: 
    Objetivo da classe: CRUD da classe da chat
*/

//Import do arquivo de constantes
@session_start();
require_once($_SESSION["importInclude"]); 

class chatDAO{

    private $conex;

    public function __construct(){
        //Import da classe do banco para todos os métodos
        require_once(IMPORT_CONEXAO);

        //Import da classe
        require_once(IMPORT_CHAT);

        //Instancia da classe conexão
        $this->conex = new conexaoMySQL();
    }

    //Inserir um registro no banco de dados.
    public function insert(Chat $chat){
        $sql = INSERT . TABELA_CHAT . " 
        (idRemetente, idDestinatario, mensagem)
        VALUES (
            '".$chat->getIdRemetente()."',
            '".$chat->getIdDestinatario()."',
            '".$chat->getMensagem()."')";

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
        $idDestinatario = 1;
        $idRemetente = 4;
        $sql = SELECT . TABELA_CHAT;
        $sql = $sql . " WHERE idRemetente = " . $idRemetente . " AND idDestinatario = " . $idDestinatario . " OR idRemetente = " . $idDestinatario . " AND idDestinatario = " . $idRemetente . " order by idMensagem_Chat";
        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);
        $cont = 0;
        
        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
        while($rsChat=$select->fetch(PDO::FETCH_ASSOC)){
            $listChat[] = new Chat();
            $listChat[$cont]->setIdMensagemChat($rsChat["idMensagem_Chat"]);
            $listChat[$cont]->setIdRemetente($rsChat["idRemetente"]);
            $listChat[$cont]->setIdDestinatario($rsChat["idDestinatario"]);
            $listChat[$cont]->setMensagem($rsChat["mensagem"]);
            
            $cont++;
        }

        $this->conex->closeDataBase();

        return($listChat);
    }
}
?>