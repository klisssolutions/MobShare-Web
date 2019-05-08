<?php
/*
    Projeto: MobShare
    Autor: igor
    Data Criação: 06/05/2019
    Data Modificação:
    Conteudo Modificação:
    Autor da Modificação:
    Objetivo da classe: Classe de chat
*/
class Chat{
    private $idMensagemChat;
    private $idRemetente;
    private $idDestinatario;
    private $mensagem;

    public function __construct(){    
    }
    
    //------------Começo dos GETTERS e SETTERS------------
    public function getIdMensagemChat(){
        return $this->idMensagemChat;
    }

    public function setIdMensagemChat($idMensagemChat){
        $this->idMensagemChat = $idMensagemChat;
    }

    public function getIdRemetente(){
        return $this->idRemetente;
    }

    public function setIdRemetente($idRemetente){
        $this->idRemetente = $idRemetente;
    }

    public function getIdDestinatario(){
        return $this->idDestinatario;
    }

    public function setIdDestinatario($idDestinatario){
        $this->idDestinatario = $idDestinatario;
    }

    public function getMensagem(){
        return $this->mensagem;
    }

    public function setMensagem($mensagem){
        $this->mensagem = $mensagem;
    }
    //------------Fim dos GETTERS e SETTERS------------

    //Funções para converter o objeto em um formato compatível com JSON
    public function getProperties(){
        return get_object_vars($this);
    }

    public function _toJson(){
        $properties = $this->getProperties();
        $object = new StdClass();
        foreach ($properties as $name => $value) {
            $object->$name = $value;
        }
        return $object;
    }
}
?>