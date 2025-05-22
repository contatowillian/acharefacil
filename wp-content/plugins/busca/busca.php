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

        $filtro = '';
        $filtro_extra = '';

        if(isset($_REQUEST['pagina'])){
          $_REQUEST['pagina'] = $_REQUEST['pagina']*20;
          $paginacao = "limit ".$_REQUEST['pagina'].",20";
        }else{
          $paginacao = "limit 0,20";
        }

        if(isset($_REQUEST['categoria']) and $_REQUEST['categoria']!=''){

          /************************************   Filtro nome da categoria  ************************************/
          $filtro_extra .="AND us.user_status = 0 and  us.ID in
                          (select nome_do_seu_negocio.user_id from wp_usermeta as nome_do_seu_negocio
                          where us.ID = nome_do_seu_negocio.user_id 
                          AND nome_do_seu_negocio.meta_key = 'afreg_additional_3213'
                          AND nome_do_seu_negocio.meta_value like '%".$_REQUEST['categoria']."%')";
        }


        if(isset($_REQUEST['cidade']) and $_REQUEST['cidade']!=''){

          /************************************   Filtro nome da cidade  ************************************/
          $filtro_extra .="AND us.user_status = 0 and  us.ID in
                          (select nome_do_seu_negocio.user_id from wp_usermeta as nome_do_seu_negocio
                          where us.ID = nome_do_seu_negocio.user_id 
                          AND nome_do_seu_negocio.meta_key = 'afreg_additional_3244'
                          AND nome_do_seu_negocio.meta_value like '%".$_REQUEST['cidade']."%')";
        }

        if(isset($_REQUEST['palavra_chave']) and $_REQUEST['palavra_chave']!=''){

          /************************************   Filtro nome do negocio  ************************************/
          $filtro_extra .="AND us.user_status = 0 and  us.ID in
                                (select nome_do_seu_negocio.user_id from wp_usermeta as nome_do_seu_negocio
                                where us.ID = nome_do_seu_negocio.user_id 
                                AND nome_do_seu_negocio.meta_key = 'afreg_additional_3224'
                                AND nome_do_seu_negocio.meta_value like '%".$_REQUEST['palavra_chave']."%')";

          /************************************   Filtro nome da categoria  ************************************/
          $filtro_extra .="OR us.user_status = 0 and  us.ID in
                                (select nome_do_seu_negocio.user_id from wp_usermeta as nome_do_seu_negocio
                                where us.ID = nome_do_seu_negocio.user_id 
                                AND nome_do_seu_negocio.meta_key = 'afreg_additional_3213'
                                AND nome_do_seu_negocio.meta_value like '%".$_REQUEST['palavra_chave']."%')";

          /************************************   Filtro descrição do anúncio ************************************/
          $filtro_extra .="OR us.user_status = 0 and  us.ID in
                                (select nome_do_seu_negocio.user_id from wp_usermeta as nome_do_seu_negocio
                                where us.ID = nome_do_seu_negocio.user_id 
                                AND nome_do_seu_negocio.meta_key = 'afreg_additional_3226'
                                AND nome_do_seu_negocio.meta_value like '%".$_REQUEST['palavra_chave']."%')";              

        }

        $consulta_usuarios_anunciantes = "(SELECT DISTINCT
                                          us.ID,
                                          us.user_login
                                          FROM wp_users AS us
                                          JOIN wp_usermeta AS nome_do_seu_negocio  ON  us.ID = nome_do_seu_negocio.user_id  AND nome_do_seu_negocio.meta_key = 'afreg_additional_3288'
                                          and nome_do_seu_negocio.meta_value ='sim'
                                          JOIN wp_usermeta AS afreg_new_user_status  ON  us.ID = afreg_new_user_status.user_id  AND afreg_new_user_status.meta_key = 'afreg_new_user_status' and afreg_new_user_status.meta_value ='approved'
                                          where us.user_status = 0 $filtro_extra order by rand() limit 3) union ";

        $consulta_usuarios_anunciantes .= "SELECT DISTINCT
                                          us.ID,
                                          us.user_login
                                          FROM wp_users AS us
                                          JOIN wp_usermeta AS afreg_new_user_status  ON  us.ID = afreg_new_user_status.user_id  AND afreg_new_user_status.meta_key = 'afreg_new_user_status' and afreg_new_user_status.meta_value ='approved'
                                          where us.user_status = 0 $filtro_extra
                                          ".$paginacao;




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
  /*      echo '<pre>';
        print_r($users);
        echo '</pre>';
        exit;*/
        
        //$categorias = array();
        $cidades = array();

        if(isset($_REQUEST['categoria']) and $_REQUEST['categoria']!=''){
          $filtro_categoria_escolhida = "and trim(categorias.meta_value) !='".$_REQUEST['categoria']."'";
        }else{
          $filtro_categoria_escolhida="";
        }
        

        /************************************   Filtro nome da categoria  ************************************/
        $filtro_categoria ="select distinct(categorias.meta_value) as categoria  from wp_usermeta as categorias
                            where  categorias.meta_key = 'afreg_additional_3213' and trim(categorias.meta_value) !=''
                            $filtro_categoria_escolhida
                            order by categorias.meta_value ASC
                            ";

        $categorias = $wpdb->get_results($filtro_categoria);



        if(isset($_REQUEST['cidade']) and $_REQUEST['cidade']!=''){
            $filtro_cidade_escolhida = "and trim(cidades.meta_value) !='".$_REQUEST['cidade']."'";
        }else{
            $filtro_cidade_escolhida="";
        }
        
        
        /************************************   Filtro nome da cidade  ************************************/
        $filtro_cidade ="select distinct cidades.meta_value as cidade,  estado.meta_value as estado
                            from wp_users as us
                            JOIN wp_usermeta as cidades   ON  us.ID = cidades.user_id  AND cidades.meta_key = 'afreg_additional_3244'
                            JOIN wp_usermeta AS estado  ON  us.ID = estado.user_id  AND estado.meta_key = 'afreg_additional_3245'
                            where  trim(cidades.meta_value) !=''
                            $filtro_cidade_escolhida
                            order by estado.meta_value, cidades.meta_value ASC

                            ";
     

        $cidades = $wpdb->get_results($filtro_cidade);



        if(!empty($users)){
          foreach ($users as $user){

       

            foreach ($afreg_extra_fields as $afreg_field) {

            
              $value = get_user_meta( $user->ID, 'afreg_additional_' . intval($afreg_field->ID), true );

              if($afreg_field->post_name=='nome-do-seu-negocio'){
                $user->nome_do_seu_negocio = $value;
              }

              if($afreg_field->post_name=='categoria'){
              /*    if(trim($value)!=''){
                  if (!in_array($value, $categorias)){
                    array_push($categorias,$value);
                  
                  }
                } */
              
              }

              if($afreg_field->post_name=='descricao'){
                $user->descricao = $value;
              }

              if($afreg_field->post_name=='foto-do-anunciante'){
                if(trim($value)==''){
                  $user->foto_do_anunciante = 'https://2.gravatar.com/avatar/ec65a0d5f2c7d6732407df4c552409c9?s=64&d=mm&r=g';
                  }else{

                  $file = 'https://acharefacil.blob.core.windows.net/publico/foto/'.strtolower($value).'.jpeg';
                  $file_headers = @get_headers($file);


                  if (!strripos($file_headers[0], '404')) {
                    $user->foto_do_anunciante = $file;
                  }else {


                    $upload_url = wp_upload_dir();
                    $upload_url = $upload_url['baseurl'] . '/addify_registration_uploads/';
                    $file_headers = get_headers($upload_url.$value);     
                    if (file_exists($upload_url.$value)) {
                       $user->foto_do_anunciante = $upload_url.$value;
                    }else{
                       $user->foto_do_anunciante = 'https://2.gravatar.com/avatar/ec65a0d5f2c7d6732407df4c552409c9?s=64&d=mm&r=g';
                    }



                  
                  }
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

    
        
       ob_start();
       include('tpl/buscaUsuariosAnunciantes.phtml');
       $template = ob_get_clean();

       $content = str_replace('[[lista_busca]]', $template, $content);
    }
    

    return $content;
}




add_filter('the_content', 'content_buscaUsuariosAnunciantes');
