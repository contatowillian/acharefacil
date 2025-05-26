<?php
/*
Plugin Name: Faz a Importação dos Anúnciantes
Plugin URI: http://www.acharefacil.com.br
Description: Faz  carrosel da home do Importação dos Anúnciantes
Version: 1.0
Author: Willian Batista
Author URI: http://www.acharefacil.com.br
License: Copyright
*/

function content_importaUsuariosAnunciantes($content) {
    global $wpdb;

    if (is_page('atualiza_latitude_longitude')) {


    }

    if (is_page('importacao_anunciantes')) {

  

        $consulta_usuarios_anunciantes = "SELECT * from Anuncio  where anunciante_cadastrado is null limit 500";


        $anunciantes = $wpdb->get_results($consulta_usuarios_anunciantes);

   
        if(!empty($anunciantes)){
          foreach ($anunciantes as $registro_anunciantes){
            
           // echo "<pre>";
            //print_r($registro_anunciantes->Email);
            $senha_randomica = date("Y_M_S_i").rand(100,99999999999999999);

            $usuario_criado = wp_create_user($registro_anunciantes->Email,$senha_randomica,$registro_anunciantes->Email);

            wp_update_user(
                array(
                    'ID'            => $usuario_criado,
                    'first_name'    => $registro_anunciantes->Nome
                )
            );

            $wpdb->query(
              $wpdb->prepare(  "update Anuncio set anunciante_cadastrado = 'sim' where id_anuncio = '".$registro_anunciantes->id_anuncio."' limit 1 ")
            );

            update_user_meta( $usuario_criado, 'afreg_new_user_status','approved');
            update_user_meta( $usuario_criado, 'afreg_additional_3239', $registro_anunciantes->Cep);
            update_user_meta( $usuario_criado, 'afreg_additional_3224',$registro_anunciantes->Titulo);
            update_user_meta( $usuario_criado, 'afreg_additional_3213',$registro_anunciantes->nome_categoria);

            //Valida se é whats app
            $celular1      = strripos($registro_anunciantes->Telefone, ') 9');
            $celular2      = strripos($registro_anunciantes->Telefone, ') 8');
            $celular3      = strripos($registro_anunciantes->Telefone, ') 7');


            if ($celular1 === false && $celular2 === false && $celular3 === false) {
              update_user_meta( $usuario_criado, 'afreg_additional_3254',$registro_anunciantes->Telefone);
            }else{
              //WhatsApp
              update_user_meta( $usuario_criado, 'afreg_additional_3214',$registro_anunciantes->Telefone);
            }
            
            update_user_meta( $usuario_criado, 'afreg_additional_3226',$registro_anunciantes->MiniDescricao);
            
            if($registro_anunciantes->Foto!='00000000-0000-0000-0000-000000000000'){
              update_user_meta( $usuario_criado, 'afreg_additional_3212',$registro_anunciantes->Foto);
            }
            
            update_user_meta( $usuario_criado, 'afreg_additional_3239',$registro_anunciantes->Cep);
            update_user_meta( $usuario_criado, 'afreg_additional_3240',$registro_anunciantes->Endereco);
            update_user_meta( $usuario_criado, 'afreg_additional_3241',$registro_anunciantes->Numero);
            update_user_meta( $usuario_criado, 'afreg_additional_3242',$registro_anunciantes->Complemento);
            update_user_meta( $usuario_criado, 'afreg_additional_3243',$registro_anunciantes->Bairro);
            update_user_meta( $usuario_criado, 'afreg_additional_3244',$registro_anunciantes->nome_cidade);
            update_user_meta( $usuario_criado, 'afreg_additional_3245',$registro_anunciantes->Uf);
            update_user_meta( $usuario_criado, 'afreg_additional_3255',$registro_anunciantes->UrlSite);
            update_user_meta( $usuario_criado, 'afreg_additional_3217',$registro_anunciantes->UrlFacebook);
            update_user_meta( $usuario_criado, 'afreg_additional_3234',$registro_anunciantes->UrlLinkedin);
      /*      update_user_meta( $usuario_criado, 'afreg_additional_3246'	"09:00"
            update_user_meta( $usuario_criado, 'afreg_additional_3263'	"18:00"
            update_user_meta( $usuario_criado, 'afreg_additional_3248'	"09:00"
            update_user_meta( $usuario_criado, 'afreg_additional_3264'	"18:00"
            update_user_meta( $usuario_criado, 'afreg_additional_3249'	"09:00"
            update_user_meta( $usuario_criado, 'afreg_additional_3266'	"18:00"
            update_user_meta( $usuario_criado, 'afreg_additional_3250'	"09:00"
            update_user_meta( $usuario_criado, 'afreg_additional_3267'	"18:00"
            update_user_meta( $usuario_criado, 'afreg_additional_3247'	"09:00"
            update_user_meta( $usuario_criado, 'afreg_additional_3268'	"18:00"
            update_user_meta( $usuario_criado, 'afreg_additional_3252'	"09:00"
            update_user_meta( $usuario_criado, 'afreg_additional_3270'	"18:00"*/
          //  update_user_meta( $usuario_criado, 'afreg_additional_3216'	"www.instagram.com/jacquesfreitas"

          //  echo "</pre>";
          //  exit;
          
          } 
         
        }

    
    
    }
    

    return $content;
}




add_filter('the_content', 'content_importaUsuariosAnunciantes');


