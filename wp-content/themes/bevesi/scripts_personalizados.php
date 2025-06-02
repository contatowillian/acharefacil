

<?php if(isset($_GET['etapa_cadastro'])){ ?>

<script>





jQuery( document ).ready(function( $ ) {

    $(".campo_telefone input").mask('(00) 00000-0009', {clearIfNotMatch: true});
    $(".horario_atendimento input").mask('00:00', {clearIfNotMatch: true});

    <?php if($_GET['etapa_cadastro']==2){ ?>
        $("#afreg_additional_3224").on("keyup change", function(e) {

            let valor = $(this).val();
            $("#account_first_name").val(valor);
            $("#account_last_name").val(valor);
        })
    <?php } ?>


    <?php if($_GET['etapa_cadastro']==3){ ?>

        
        cria_preenche_horario_funcionamento(3246,3263,'Segunda-Feira');
        cria_preenche_horario_funcionamento(3248,3264,'Terça-Feira');
        cria_preenche_horario_funcionamento(3249,3266,'Quarta-Feira');
        cria_preenche_horario_funcionamento(3250,3267,'Quinta-Feira');
        cria_preenche_horario_funcionamento(3247,3268 ,'Sexta-Feira');
        cria_preenche_horario_funcionamento(3252,3270,'Sabado');
        cria_preenche_horario_funcionamento(3251,3272,'Domingo');

        $("#afreg_additional_3255").on("keyup change", function(e) {
            jQuery('.horario_atendimento').hide();
            jQuery('.horario_atendimento label').hide();
        }) 

        $("#afreg_additional_3216").on("keyup change", function(e) {
            jQuery('.horario_atendimento').hide();
            jQuery('.horario_atendimento label').hide();
        })

        $("#afreg_additional_3217").on("keyup change", function(e) {
            jQuery('.horario_atendimento').hide();
            jQuery('.horario_atendimento label').hide();
        })

        $("#afreg_additional_3217").on("keyup change", function(e) {
            jQuery('.horario_atendimento').hide();
            jQuery('.horario_atendimento label').hide();
        })
        $("#afreg_additional_3234").on("keyup change", function(e) {
            jQuery('.horario_atendimento').hide();
            jQuery('.horario_atendimento label').hide();
        })

        
       
    <?php } ?>



        function cria_preenche_horario_funcionamento(id_campo,id_campo_2,dia){

            $('#afreg_additionalshowhide_'+id_campo).before('<div class="clear campo_escolhe_horaio_dia_semana" id="'+id_campo+'__'+id_campo_2+'"  ><p class="af-dependable-field form-row  form-row-wide" >'+
                                                    '<div ><input type="checkbox"></i></div> <label for="afreg_additional_'+id_campo+'">'+
                                                    'Preencher horário de Funcionamento - '+dia+							
                                                    '</label>'+
                                                    '</p><br></div>');

            $('#afreg_additionalshowhide_'+id_campo).hide();
            $('#afreg_additionalshowhide_'+id_campo_2).hide();

            $(".campo_escolhe_horaio_dia_semana").on("click", function(e) {
               console.log(this.id);

               var id_div = this.id;

               const pega_ids_campos_horarios = id_div.split("__");

                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[0]).show();
                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[0]+' label').show();
                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[0]+' input').show();
                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[1]).show();
                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[1]+' label').show();
                $('#afreg_additionalshowhide_'+pega_ids_campos_horarios[1]+' input').show();
            })
                                                    
        }

       


});


function abre_dia_semana(id_campo,id_campo_2){

    document.getElementById("afreg_additionalshowhide_"+id_campo).style.display = 'grid';
    document.getElementById("afreg_additionalshowhide_"+id_campo_2).style.display = 'grid';
}

function limpa_campos_etapa(numero_etapa){
    var divsToHide = document.getElementsByClassName("cadastro-etapa-"+numero_etapa); //divsToHide is an array
    for(var i = 0; i < divsToHide.length; i++){
        divsToHide[i].style.display = "none"; // depending on what you're doing
    }

    if(numero_etapa==2){
               
    }
}


window.onload = function() {
    document.getElementById("form_cadastro_anterior").style.display = 'none';
    document.getElementById("botao_salvar").style.display = 'none';
    document.getElementById("controle_wizard").style.display = 'block';

    var divsToHide = document.getElementsByClassName("cadastro-etapa-1"); //divsToHide is an array
    for(var i = 0; i < divsToHide.length; i++){
        divsToHide[i].style.display = "none"; // depending on what you're doing
    }

    <?php if($_GET['etapa_cadastro']==2){ ?>

    document.getElementById("afreg_additional_3239").required = true;
    document.getElementById("afreg_additional_3224").required = true;
    document.getElementById("afreg_additional_3224").setAttribute('maxlength',30);

    document.getElementById("afreg_additional_3213").required = true;
    document.getElementById("afreg_additional_3214").required = true;
    document.getElementById("afreg_additional_3226").required = true;

    document.getElementById("afreg_additional_3240").required = true;
    document.getElementById("afreg_additional_3243").required = true;
    document.getElementById("afreg_additional_3244").required = true;
    document.getElementById("afreg_additional_3245").required = true;
    document.getElementById("afreg_additional_3218").required = true;

    document.getElementById("afreg_additional_3218").click();
    

    setInterval(function() { limpa_campos_etapa(3); }, 200);
    
    <?php } ?>

    <?php if($_GET['etapa_cadastro']==3){ ?>

        <?php 
            if (strpos($_SERVER['HTTP_REFERER'], '?etapa_cadastro=3') !== false) { ?>
                window.location=('/lista_planos');
        <?php }  ?>

    setInterval(function() { limpa_campos_etapa(2); }, 200);

    document.getElementById("form_cadastro_proximo").style.display = 'none';
    document.getElementById("form_cadastro_anterior").style.display = 'block';
    document.getElementById("form_cadastro_anterior").innerHTML = 'Finalizar';
    document.getElementById("form_cadastro_proximo").innerHTML = 'Finalizar';
    document.getElementById("form_cadastro_proximo").innerHTML = "<a href='/lista_planos'>Destacar Meu Negócio</a>";
    document.getElementById("form_cadastro_proximo").style.backgroundColor = "#18864B";
    document.getElementById("form_cadastro_proximo").style.color = "#fff";
    document.getElementById("controle_etapa_cadastro").value = 3;


    window.scrollTo({ top: 0, behavior: 'smooth' });

    var divsToShow = document.getElementsByClassName("page-title"); //divsToHide is an array
    for(var i = 0; i < divsToShow.length; i++){
        console.log('mostra_etapa'+i)
        divsToShow[i].innerHTML= "Parabéns ! <br>  <p class='aviso_parabens'>Você agora faz parte do time Achar é Fácil !</p>"; // depending on what you're doing
    }
    
    document.querySelector(".site-page-header-inner .entry-description p").innerHTML = "Você pode incrementar o anúncio com informações importantes, isso ajudará no desempenho do seu anúncio.<br> Você também pode destacar seu Negócio assinado um de nossos planos "; // depending on what you're doing

    <?php } ?> 

    var divsToHide = document.getElementsByClassName("woocommerce-form-register__submit"); //divsToHide is an array
    for(var i = 0; i < divsToHide.length; i++){
        divsToHide[i].style.display = "none"; // depending on what you're doing
    }
}



jQuery( document ).ready(function( $ ) {

$("#afreg_additional_3239").mask('00000-000', {clearIfNotMatch: true});




    $("#afreg_additional_3239").keyup(function(){
       if($("#afreg_additional_3239").val() == ""){
           $('#afreg_additional_3240').val("");
            $('#afreg_additional_3243').val("");
            $('#afreg_additional_3244').val("");
            $('#estado').val("");
       }
       var conta =  $(this).val();
       var conta2 = conta.length;
       if(conta2==9){
             $('#afreg_additional_3240').val("");
             $('#afreg_additional_3243').val("");
             $('#afreg_additional_3244').val("");
             $('#estado').val("");
             $('#status_busca_cep').show();
             $('#status_busca_cep').html("Carregando...");

        
           var site = "https://viacep.com.br/ws/"+conta+"/json";

           $.ajax({
                type: "GET",
                url: site,
                dataType: "json",
                success: function(json){
        
                         $('#afreg_additional_3240').val(json.logradouro);
                         $('#afreg_additional_3243').val(json.bairro);
                         $('#afreg_additional_3244').val(json.localidade);
                         $('#afreg_additional_3245').val(json.uf);
                         $('#afreg_additional_3240').removeAttr("readonly");
                        
                         $('#afreg_additional_3244').removeAttr("readonly");
                         $('#afreg_additional_3245').removeAttr("readonly");

                         var divsToHide = document.getElementsByClassName("cadastro-etapa-3"); //divsToHide is an array
                        for(var i = 0; i < divsToHide.length; i++){
                            divsToHide[i].style.display = "none"; // depending on what you're doing
                        }
                                
                },
                error: function(data) { 
                    $('#status_busca_cep').show();
                    $('#status_busca_cep').html("Cep não encontrado");
                }
                
            });			
       }
   });
});
</script>
<?php } ?>


<?php if(is_page('my-acoount') or is_page('edit-acoount') or is_page('criar-anuncio')){ ?>
<script>

    jQuery( document ).ready(function( $ ) {

        $(".campo_telefone input").mask('(00) 000000009', {clearIfNotMatch: true});
        
        $(".horario_atendimento input").mask('00:00', {clearIfNotMatch: true});

        $("#reg_email").on("keyup change", function(e) {

        let valor = $(this).val();
        $("#reg_username").val(removerCaracteresEspeciais(valor)+generatePassword());

        })


        $("#afreg_additional_3224").on("keyup change", function(e) {

            let valor = $(this).val();
            $("#reg_username").val(removerCaracteresEspeciais(valor)+generatePassword());
            
        })

       /* $("#afreg_additional_3232").change(function(){
            
            let valor = $(this).val();  

            $("#afreg_additionalshowhide_3234").css("display", "none");
            $("#afreg_additionalshowhide_3216").css("display", "none");
            $("#afreg_additionalshowhide_3217").css("display", "none");
            $("#afreg_additional_3234").css("display", "none");
            $("#afreg_additional_3216").css("display", "none");
            $("#afreg_additional_3217").css("display", "none");
                
            if(valor=='Linkedin'){
                $("#afreg_additionalshowhide_3234").css("display", "block");
                $("#afreg_additional_3234").css("display", "block");
                
            }
            if(valor=='Facebook'){
                $("#afreg_additionalshowhide_3217").css("display", "block");
                $("#afreg_additional_3217").css("display", "block");
                
            }
            if(valor=='Instagram'){
                $("#afreg_additional_3216").css("display", "block");
                $("#afreg_additionalshowhide_3216").css("display", "block");
            }

        })*/

    });


    function removerCaracteresEspeciais(string) {
        return string.replace(/[^a-zA-Z0-9]/g, "");
    }


    function generatePassword() {
        var length = 15,
            charset = "abcdefghijklmnopqrstuvwxyz0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        return retVal;
    }

  

</script>
<?php }?>


<script>


jQuery( document ).ready(function( $ ) {
        getLocation();
        bevesiThemeModule.siteslider();
      /*  $('.slick-slider').slick({
        arrows: true
        })*/
        $('.site-slider-categorias').slick({
            arrows: true,
            prevArrow: '<button type="button" class="slick-nav slick-prev slick-button unset"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" fill="currentColor"><polyline fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="17.2,22.4 6.8,12 17.2,1.6 "/></svg></button>',
            nextArrow: '<button type="button" class="slick-nav slick-next slick-button unset"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" fill="currentColor"><polyline fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="6.8,22.4 17.2,12 6.8,1.6 "/></svg></button>',
            lazyLoad: 'ondemand',
            slidesToShow: 7,
            slidesToScroll: 7,
            responsive: [
            {
            breakpoint: 768,
            settings: {
            slidesToShow: 3,
            centerMode: false, /* set centerMode to false to show complete slide instead of 3 */
            slidesToScroll: 3,
            dots: true
            }
            }]
        
        });

        $('.site-slider-anunciantes1').slick({
            arrows: true,
            prevArrow: '<button type="button" class="slick-nav slick-prev slick-button unset"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" fill="currentColor"><polyline fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="17.2,22.4 6.8,12 17.2,1.6 "/></svg></button>',
            nextArrow: '<button type="button" class="slick-nav slick-next slick-button unset"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" fill="currentColor"><polyline fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="6.8,22.4 17.2,12 6.8,1.6 "/></svg></button>',
            lazyLoad: 'ondemand',
            slidesToShow: 5,
            slidesToScroll: 5,
            responsive: [
            {
            breakpoint: 768,
            settings: {
            slidesToShow: 1,
            centerMode: true, /* set centerMode to false to show complete slide instead of 3 */
            slidesToScroll: 1,
            dots: true
            }
            }]
        });

    })


    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error);
        
        } else {
            console.log('Geolocation is not supported by this browser.');
        }
    }

    function success(position) {
        console.log(position);
        document.querySelector(".us_pos").value = position.coords.latitude +"_"+position.coords.longitude;
    }

    function error() {
        console.log("Sorry, no position available.");
    }

</script>


<div class="alert alert-primary col-md-16" role="alert" id='status_busca_cep'> </div>