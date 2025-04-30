<?php
/*
Plugin Name: Detalhe Usuarios Anúnciantes
Plugin URI: http://www.acharefacil.com.br
Description: Exibe o detalhes dos Usuarios/Anúnciantes
Version: 1.0
Author: Willian Batista
Author URI: http://www.acharefacil.com.br
License: Copyright
*/

function content_detalheUsuariosAnunciantes($content) {
    global $grupo,
           $wpdb;

    if (is_page('detalhe')) {

        if(!isset($_GET['detalhe_anunciante'])){
            echo "Codigo do anúncio não encontrado !";
            exit;
        }

         $consulta_usuarios_anunciantes = "SELECT DISTINCT
                                          us.ID,
                                          us.user_login
                                          FROM wp_users AS us
                                          JOIN wp_usermeta AS afreg_new_user_status  ON  us.ID = afreg_new_user_status.user_id  AND afreg_new_user_status.meta_key = 'afreg_new_user_status' and afreg_new_user_status.meta_value ='approved'
                                          where us.user_status = 0  and us.ID = '".$_GET['detalhe_anunciante']."'";

    

        $users = $wpdb->get_results($consulta_usuarios_anunciantes);

        $afreg_args = array( 
          'posts_per_page'   => -1,
          'post_type'        => 'afreg_fields',
          'post_status'      => 'publish',
          'orderby'          => 'menu_order',
          'suppress_filters' => false,
          'order'            => 'ASC',
        );
        
  
        $afreg_extra_fields = get_posts($afreg_args);
 

        if(!empty($users)){
          foreach ($users as $user){

       

            foreach ($afreg_extra_fields as $afreg_field) {

            
              $value = get_user_meta( $user->ID, 'afreg_additional_' . intval($afreg_field->ID), true );

              if($afreg_field->post_name=='nome-do-seu-negocio'){
                $user->nome_do_seu_negocio = $value;
              }

              if($afreg_field->post_name=='categoria'){
                $user->categoria = $value;
              }

              if($afreg_field->post_name=='descricao'){
                $user->descricao = $value;
              }

              if($afreg_field->post_name=='foto-do-anunciante'){
                if(trim($value)==''){
                  $user->foto_do_anunciante = 'https://2.gravatar.com/avatar/ec65a0d5f2c7d6732407df4c552409c9?s=64&d=mm&r=g';
                }else{
                  $upload_url = wp_upload_dir();

                  $upload_url = $upload_url['baseurl'] . '/addify_registration_uploads/';
                  $user->foto_do_anunciante = $upload_url.$value;
                }
               
              }


              if($afreg_field->post_name=='cep'){
                $user->cep = $value;
              }

              if($afreg_field->post_name=='destaque'){
                $user->destaque = $value;
              }

              if($afreg_field->post_name=='endereco'){
                $user->endereco = $value;
              }

              if($afreg_field->post_name=='numero'){
                $user->numero = $value;
              }

              if($afreg_field->post_name=='complemento'){
                if($value!=''){
                  $user->complemento = '- '.$value;
                }else{
                  $user->complemento = '';
                }    
            
              }


              if($afreg_field->post_name=='bairro'){
                $user->bairro = $value;
              }

              if($afreg_field->post_name=='cidade'){
                $user->cidade = $value;

             /*   if(trim($value)!=''){

                  if (!in_array($value, $cidades)){
                    array_push($cidades,$value);
                  }
                }*/
              }

              if($afreg_field->post_name=='endereco-facebook'){
                $user->endereco_facebook = $value;
              }

              if($afreg_field->post_name=='endereco-instagram'){
                $user->endereco_instagram = $value;
              }

              if($afreg_field->post_name=='endereco-linkedin'){
                $user->endereco_linkedin = $value;
              }

              if($afreg_field->post_name=='endereco-linkedin'){
                $user->segunda_horario_inicio = $value;
              }

              if($afreg_field->ID=='3270'){

              }

              if($afreg_field->post_name=='horario-inicio-segunda'){
                $user->segunda_horario_inicio = $value;
                echo  $value;
                exit;
              }

              if($afreg_field->post_name=='horario-inicio-terca'){
                $user->terca_horario_inicio = $value;
              }

              if($afreg_field->post_name=='horario-inicio-quarta'){
                $user->quarta_horario_inicio = $value;
              }

              if($afreg_field->post_name=='horario-inicio-quinta'){
                $user->quinta_horario_inicio = $value;
              }

              if($afreg_field->post_name=='horario-inicio-sexta'){
                $user->sexta_horario_inicio = $value;
              }

              if($afreg_field->post_name=='horario-inicio-sabado'){
                $user->sabado_horario_inicio = $value;
              }

              if($afreg_field->post_name=='horario-inicio-domingo'){
                $user->domingo_horario_inicio = $value;
              }

              if($afreg_field->post_name=='horario-fim-segunda'){
                $user->segunda_horario_fim = $value;
              }
              
              if($afreg_field->post_name=='horario-fim-terca'){
                $user->terca_horario_fim = $value;
              }
              
              if($afreg_field->post_name=='horario-fim-quarta'){
                $user->quarta_horario_fim = $value;
              }
              
              if($afreg_field->post_name=='horario-fim-quinta'){
                 $user->quinta_horario_fim = $value;
              }
              
              if($afreg_field->post_name=='horario-fim-sexta'){
                $user->sexta_horario_fim = $value;
              }
              
              if($afreg_field->post_name=='horario-fim-sabado'){
                 $user->sabado_horario_fim = $value;
              }
              
              if($afreg_field->post_name=='horario-fim-domingo'){
                $user->domingo_horario_fim = $value;
              }
            

              if($afreg_field->ID=='3270'){
              //  print_r($afreg_field);
               // exit;
              }

              if($afreg_field->post_name=='estado'){
                $user->estado = $value;
              }

              if($afreg_field->post_name=='telefone'){
                $user->telefone = $value;
              }

              if($afreg_field->post_name=='whatsapp'){
                $user->whatsapp = $value;
              }

              if($afreg_field->post_name=='website'){
                $user->website = $value;
              }

              if($afreg_field->post_name=='website'){
                $user->website = $value;
              }
              
            //  echo $afreg_field->post_name.' -  Valor:'.$value.'<br>';

            }
          } 
         
        }

    
        
       ob_start();
       include('tpl/detalheUsuariosAnunciantes.phtml');
       $template = ob_get_clean();

       $content = str_replace('[[detalhe_anunciante]]', $template, $content);
    }
    

    return $content;
}




add_filter('the_content', 'content_detalheUsuariosAnunciantes');
