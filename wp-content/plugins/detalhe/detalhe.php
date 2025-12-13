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

function start_session() {
  if(!session_id()) {
    session_start();
  }
}

add_action('init', 'start_session', 1);




function content_detalheUsuariosAnunciantes($content) {
    global $grupo,
           $wp_session,
           $wpdb;


    if (is_page('detalhe')) {

        if(!isset($_GET['detalhe_anunciante'])){
            echo "Codigo do anúncio não encontrado !";
            exit;
        }

         $consulta_usuarios_anunciantes = "SELECT DISTINCT
                                          us.ID,
                                          us.user_login,
                                          afreg_new_user_status.meta_value as aprovacao
                                          FROM wp_users AS us
                                          where us.user_status = 0   and us.afreg_new_user_status ='approved'  and us.ID = '".$_GET['detalhe_anunciante']."'";

    

        $users = $wpdb->get_results($consulta_usuarios_anunciantes);

   

        if(strtolower($users[0]->aprovacao)!='approved'){ ?>

          <h3>Seu anúncio está em fase de aprovação ...<br> Estamos analisando e seu cadastro será liberado em breve !</h3>
          <style>
          .container .woocommerce-breadcrumb{
            display: none !important;
          }
          .single-product-wrapper {
            display: none !important;
          }
          .page-id-3290 .klb-post h1{
            display: none !important;
          }
          .anuncios_semelhantes_bloco{
            display: none !important;
          }
          </style>
        
        <?php }
        
        $afreg_args = array( 
          'posts_per_page'   => -1,
          'post_type'        => 'afreg_fields',
          'post_status'      => 'publish',
          'orderby'          => 'menu_order',
          'suppress_filters' => false,
          'order'            => 'ASC',
        );
        
  
        $afreg_extra_fields = get_posts($afreg_args);


        	/************************************   Verifica contagem repetida ************************************/
				 $verifica_contagem_repetida ="select id_controle_insert_contagem_vizualizacao_anuncio from wp_controle_insert_contagem_vizualizacao_anuncio
         where   id_user = ".$_GET['detalhe_anunciante']." and ip ='".$_SERVER["REMOTE_ADDR"]."' and date(data_insert) = CURDATE()  and pagina = 'detalhe'
          ";

          $contagem_verifica_contagem_repetida = $wpdb->get_results($verifica_contagem_repetida);

          if(count($contagem_verifica_contagem_repetida)==0){

            $quantidade_vizualizacao_detalhes = get_user_meta( $_GET['detalhe_anunciante'], 'afreg_additional_3340', true );
            if($quantidade_vizualizacao_detalhes==''){
              $quantidade_vizualizacao_detalhes=0; 
            }

            $quantidade_vizualizacao_detalhes = (int)$quantidade_vizualizacao_detalhes+1;

            $query = "insert into wp_controle_insert_contagem_vizualizacao_anuncio(id_user,valor_contagem,ip,pagina) values(".$_GET['detalhe_anunciante'].",$quantidade_vizualizacao_detalhes,'".$_SERVER['REMOTE_ADDR']."','detalhe')";
            $wpdb->query($wpdb->prepare($query));


            $query = "update wp_usermeta set meta_value= '".$quantidade_vizualizacao_detalhes."' WHERE meta_key = 'afreg_additional_3340' AND user_id = ".$_GET['detalhe_anunciante']." limit 1";
            $wpdb->query($wpdb->prepare($query));
          }

          

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

             /*     $file = 'https://acharefacil.blob.core.windows.net/publico/foto/'.strtolower($value).'.jpeg';
                  $file_headers = @get_headers($file);


                  if (!strripos($file_headers[0], '404')) {
                    $user->foto_do_anunciante = $file;
                  }else {

                   $upload_url = wp_upload_dir();
                    $upload_url = $upload_url['baseurl'] . '/addify_registration_uploads/';
                    $file_headers = get_headers($upload_url.$user->foto_do_anunciante);     
                    if (!strripos($file_headers[0], '404') and $file_headers !='') {
                       $user->foto_do_anunciante = $upload_url.$user->foto_do_anunciante;
                    }else{
                       $user->foto_do_anunciante = 'https://2.gravatar.com/avatar/ec65a0d5f2c7d6732407df4c552409c9?s=64&d=mm&r=g';
                    } */
                 
                    $caminho = 'wp-content/uploads/addify_registration_uploads/'.$value;

                    if(file_exists($caminho)){ 
                      $user->foto_do_anunciante = '/'.$caminho;
                    }else if(file_exists($caminho.'.jpeg')){
                      $user->foto_do_anunciante ='/'.$caminho.'.jpeg';
                    }else{
                      $user->foto_do_anunciante = 'https://2.gravatar.com/avatar/ec65a0d5f2c7d6732407df4c552409c9?s=64&d=mm&r=g';

                    }

                 
                    // }
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

              if($afreg_field->post_name=='horario-segunda-feira'){
                $user->segunda_horario_inicio = $value;
              //  echo  $value;
               // exit;
              }

              if($afreg_field->post_name=='horario-terca-feira'){
                $user->terca_horario_inicio = $value;
              }

              if($afreg_field->post_name=='horario-quarta-feira'){
                if(!empty($value)) {
                    $user->quarta_horario_inicio = $value;
                }
                
              }

              if($afreg_field->post_name=='horario-quinta-feira'){
                if(!empty($value)) {
                $user->quinta_horario_inicio = $value;
                }
              }

              if($afreg_field->post_name=='horario-sexta-feira'){
                if(!empty($value)) {
                $user->sexta_horario_inicio = $value;
                }
              }

              if($afreg_field->post_name=='horario-sabado'){
                if(!empty($value)) {
                $user->sabado_horario_inicio = $value;
                }
              }

              if($afreg_field->post_name=='horario-domingo'){
                if(!empty($value)) {
                $user->domingo_horario_inicio = $value;
                }
              }

              if($afreg_field->post_name=='horario-fim-segunda-feira'){
                if(!empty($value)) {
                $user->segunda_horario_fim = $value;
                }
              }
              
              if($afreg_field->post_name=='horario-fim-terca-feira'){
                if(!empty($value)) {
                $user->terca_horario_fim = $value;
                }
              }
              
              if($afreg_field->post_name=='horario-fim-quarta-feira'){
                if(!empty($value)) {
                $user->quarta_horario_fim = $value;
                }
              }
              
              if($afreg_field->post_name=='horario-fim-quinta-feira'){
                if(!empty($value)) {
                 $user->quinta_horario_fim = $value;
                }
              }
              
              if($afreg_field->post_name=='horario-fim-sexta-feira'){
                if(!empty($value)) {
                $user->sexta_horario_fim = $value;
                }
              }
              
              if($afreg_field->post_name=='horario-fim-sabado'){
                if(!empty($value)) {
                 $user->sabado_horario_fim = $value;
                }
              }
              
              if($afreg_field->post_name=='horario-fim-domingo'){
                if(!empty($value)) {
                $user->domingo_horario_fim = $value;
                }
              }
            

              if($afreg_field->ID=='3246'){
              //  print_r($afreg_field);
                //exit;
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
                $value = str_replace("https://","",$value);
                $value = str_replace("http://","",$value);
                $user->website = $value;
              }
              
            //  echo $afreg_field->post_name.' -  Valor:'.$value.'<br>';

            }
          } 
         
        }
     
        


        $consulta_usuarios_anunciantes_semelhantes = "SELECT DISTINCT
        us.ID,
        us.user_login,
        us.nome_categoria as categoria,
        us.nome_do_seu_negocio as nome_do_seu_negocio,
        us.descricao_anunciante as descricao,
        us.foto_do_anunciante as foto_do_anunciante
        FROM wp_users AS us
        where us.user_status = 0  and categoria.meta_value = '".$users[0]->categoria."'
        and us.foto_do_anunciante !=''
        and us.ID != ".$_GET['detalhe_anunciante']."   and us.afreg_new_user_status ='approved' 
        GROUP BY     us.user_login,
        categoria.meta_value,
        us.nome_do_seu_negocio,
        descricao.meta_value  ,
        us.foto_do_anunciante
        limit 3 
        
        ";


        $users_anunciantes_semelhantes = $wpdb->get_results($consulta_usuarios_anunciantes_semelhantes);

        /* echo '<pre>';
        print_r($users_anunciantes_semelhantes);
        echo '</pre>';
        exit; */

       ob_start();
       include('tpl/detalheUsuariosAnunciantes.phtml');
       $template = ob_get_clean();

       $content = str_replace('[[detalhe_anunciante]]', $template, $content);
    }
    

    return $content;
}




add_filter('the_content', 'content_detalheUsuariosAnunciantes');





