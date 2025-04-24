<?php
/*
Plugin Name: Busca Usuarios Anúnciantes
Plugin URI: http://www.acharefacil.com.br
Description: Faz a Busca dos Usuarios/Anúnciantes
Version: 1.0
Author: Willian Batista
Author URI: http://www.acharefacil.com.br
License: Copyright
*/

function content_buscaUsuariosAnunciantes($content) {
    global $grupo,
           $wpdb;

    if (is_page('busca')) {

        $user_query = new WP_User_Query( array( 'role' => 'subscriber' , 'user_status' => 'approved' ) );
        $users = $user_query->get_results();

        $afreg_args = array( 
          'posts_per_page'   => -1,
          'post_type'        => 'afreg_fields',
          'post_status'      => 'publish',
          'orderby'          => 'menu_order',
          'suppress_filters' => false,
          'order'            => 'ASC',
        );
        
  
        $afreg_extra_fields = get_posts($afreg_args);
  /*      echo '<pre>';
        print_r($users);
        echo '</pre>';
        exit;*/
        $categorias = array();
        $cidades = array();


        if(!empty($users)){
          foreach ($users as $user){

       

            foreach ($afreg_extra_fields as $afreg_field) {

            
              $value = get_user_meta( $user->ID, 'afreg_additional_' . intval($afreg_field->ID), true );

              if($afreg_field->post_name=='nome-do-seu-negocio'){
                $user->nome_do_seu_negocio = $value;
              }

              if($afreg_field->post_name=='categoria'){
              

                if(trim($value)!=''){
                  if (!in_array($value, $categorias)){
                    array_push($categorias,$value);
                  
                  }
                }
              
              }

              if($afreg_field->post_name=='descricao'){
                $user->descricao = $value;
              }

              if($afreg_field->post_name=='foto-do-anunciante'){
                if(trim($value)==''){
                  $user->foto_do_anunciante = 'https://2.gravatar.com/avatar/ec65a0d5f2c7d6732407df4c552409c9?s=64&d=mm&r=g';
                }else{
                  $user->foto_do_anunciante = $value;
                }
               
              }


              if($afreg_field->post_name=='cep'){
                $user->cep = $value;
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

                if(trim($value)!=''){

                  if (!in_array($value, $cidades)){
                    array_push($cidades,$value);
                  }
                }
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
              
            //  echo $afreg_field->post_name.' -  Valor:'.$value.'<br>';

            }
          } 
         
        }

      if(isset($_REQUEST['categoria']) and $_REQUEST['categoria']!=''){
        $users = filtro_busca('categoria',$users,$_REQUEST['categoria']);
      }
        
       ob_start();
       include('tpl/buscaUsuariosAnunciantes.phtml');
       $template = ob_get_clean();

       $content = str_replace('[[lista_busca]]', $template, $content);
    }
    

    return $content;
}


function filtro_busca($filtro,$listagem,$request_categoria){

  $contador_array = 0;

  foreach($listagem as $registro_lista){

    $contador_array++;

   /* if($filtro=='categoria'){
      if($registro_lista->categoria != $request_categoria){
        $registro_lista->descricao = '';
      }
    }*/
   

  }

  return $listagem;

  
}

add_filter('the_content', 'content_buscaUsuariosAnunciantes');
