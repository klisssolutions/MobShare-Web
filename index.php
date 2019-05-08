<?php
@session_start();
$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";

//Require das constantes
require_once($_SESSION["importInclude"]); 

?>
<style>
    .chat{
        overflow: auto;
        width: 700px;
        height: 500px;
        background-color: green;
    }

    .mensagem{
        width: 100%;
        height: 20px;
        margin-top: 20px;
    }

    .locatario{
        width: 300px;
        height: auto;
        background-color: white;
        float: left;
        margin-left: 20px;
    }

    .locador{
        width: 300px;
        height: auto;
        background-color: white;
        float: right;
        margin-right: 20px;
    }
</style>
<script src="jquery.js"></script>
<script src="ajax.js"></script>
<div class="chat" id="mensagens">

</div>
<div class="input" id="texto"></div>
<script>
    tempo = 0;
    atualizacao = 5;
    chat();
    setInterval(function(){
        chat();
        texto.innerText = tempo;
        tempo += atualizacao;
    }, atualizacao * 1000);
</script>