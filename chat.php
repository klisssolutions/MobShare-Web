<?php
@session_start();
$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";

//Require das constantes
require_once($_SESSION["importInclude"]); 

require_once(IMPORT_CHAT);
require_once(IMPORT_CHAT_DAO);

$chat = new chatDAO();
$mensagens[] = new Chat(); 
$mensagens = $chat->selectAll();
$idRemetente = 1;
$idDestinatario = 4;

?>
    <?php foreach($mensagens as $mensagem):?>
        <?php if($mensagem->getIdRemetente() == $idDestinatario):?>
            <div class="mensagem">
                <div class="locador"><?php echo($mensagem->getMensagem()); ?></div>
            </div>
        <?php else:?>
            <div class="mensagem">
                <div class="locatario"><?php echo($mensagem->getMensagem()); ?></div>
            </div>
        <?php endif;?>
    <?php endforeach;?>