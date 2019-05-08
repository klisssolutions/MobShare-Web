function chat() {
    $.ajax({
        type: "POST",
        url: "chat.php",
        success: function (dados) {
            $("#mensagens").html(dados);
        }
    });
}


//Essa função pega o controller e o modo e passa o form pro router realizar as acoes de insert e update
function router(controller, modo, id){

    let form = document.getElementById("form");
    let checkForm = form.reportValidity();
    let data = new FormData(form);
    if(checkForm){
        
        $('#form').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                processData: false,
                contentType: false,
                cache: false,
                url: `router.php?controller=${controller}&modo=${modo}&id=${id}`,
                data: data,
                success: function (data) {                    
                    
                    $("#informacao").html(data);
                }
            });
        });
    }
}