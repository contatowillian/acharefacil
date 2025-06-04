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

function get_ip_lat_long(){

  $retorno = array();
  $ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
  $url = "http://freegeoip.net/json/$ip";
  $ch  = curl_init();
  
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
  $data = curl_exec($ch);
  curl_close($ch);
  
  if ($data) {
      $location = json_decode($data);
  
      echo $retorno['lat']= $location->latitude;
      $retorno['long']=  $lon = $location->longitude;
    
      exit;
      //$sun_info = date_sun_info(time(), $lat, $lon);
      //print_r($sun_info);
  }
  return $retorno;

}



function content_buscaUsuariosAnunciantes($content) {
    global $grupo,
           $wpdb;

    if (is_page('busca')) {

        $filtro = '';
        $filtro_categoria = '';
        $filtro_extra = '';
        $qtd_por_pagina = 20;

        if(isset($_REQUEST['pagina'])){
          $_REQUEST['pagina'] = $_REQUEST['pagina']*$qtd_por_pagina;
          $paginacao = "limit ".$_REQUEST['pagina'].",$qtd_por_pagina";
        }else{
          $paginacao = "limit 0,$qtd_por_pagina";
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

          $filtro_categoria.='';

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



        // $dados_lat_long_ip_user = get_ip_lat_long();

        // print_r($dados_lat_long_ip_user);
        // exit;
        $order_by_next_la_long='';

        if(isset($_GET['us_pos']) and $_GET['us_pos']!=''){

          $divide_lat_long = explode("_",$_GET['us_pos']);

          if(isset($divide_lat_long[1]) and $divide_lat_long[1]!=''){

            $user_lat=$divide_lat_long[0];
            $user_lng = $divide_lat_long[1];
            $order_by_next_la_long= "ORDER BY ABS(us.geo_lat-'$user_lat') + ABS(us.geo_long  - '$user_lng') ASC";

            //$order_by_next_la_long=' ORDER BY ((us.geo_lat-'.$user_lat.')(us.geo_lat-'.$user_lat.')) + ((us.geo_long - '.$user_lng.')(us.geo_long - '.$user_lng.')) ASC';
          }

        }
        $order_by_next_la_long='';

        $consulta_usuarios_anunciantes = "";

        $consulta_usuarios_anunciantes .= "(SELECT DISTINCT
                                          us.ID,
                                          us.user_login,
                                          destaque.meta_value as data_destaque
                                          FROM wp_users AS us
                                          JOIN wp_usermeta AS destaque  ON  us.ID = destaque.user_id  AND destaque.meta_key = 'afreg_additional_3288'
                                          and destaque.meta_value !=''
                                          JOIN wp_usermeta AS afreg_new_user_status  ON  us.ID = afreg_new_user_status.user_id  AND afreg_new_user_status.meta_key = 'afreg_new_user_status' and afreg_new_user_status.meta_value ='approved'
                                          where us.user_status = 0 
                                          and
                                          DATE(
                                            CONCAT(SUBSTR(destaque.meta_value, 7, 4),
                                            CONCAT('-',
                                            CONCAT(SUBSTR(destaque.meta_value, 4, 2), 
                                            CONCAT('-',SUBSTR(destaque.meta_value, 1, 2)
                                            )))))
                                            >=  NOW()
                                          $filtro_extra order by rand() limit 3) union ";

    
       $consulta_usuarios_anunciantes .= "SELECT DISTINCT
                                          us.ID,
                                          us.user_login,
                                          '' as destaque
                                          FROM wp_users AS us
                                          JOIN wp_usermeta AS afreg_new_user_status  ON  us.ID = afreg_new_user_status.user_id  AND afreg_new_user_status.meta_key = 'afreg_new_user_status' and afreg_new_user_status.meta_value ='approved'
                                          where us.user_status = 0 $filtro_extra
                                          $order_by_next_la_long
                                          
                                           ".$paginacao;

                                            
   

        $users = $wpdb->get_results($consulta_usuarios_anunciantes);


                      

        $consulta_usuarios_anunciantes_paginacao = "SELECT count(*) as quantidade
                                                    FROM wp_users AS us
                                                    JOIN wp_usermeta AS afreg_new_user_status  ON  us.ID = afreg_new_user_status.user_id  AND afreg_new_user_status.meta_key = 'afreg_new_user_status' and afreg_new_user_status.meta_value ='approved'
                                                    where us.user_status = 0 $filtro_extra";




        $paginacao_busca = $wpdb->get_results($consulta_usuarios_anunciantes_paginacao);

        $qtd_total_busca = (int)$paginacao_busca[0]->quantidade;

         $quantidade_paginas =  (int)$paginacao_busca[0]->quantidade/$qtd_por_pagina;
         $quantidade_paginas = round($quantidade_paginas);



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
          $filtro_categoria_escolhida = "and trim(categoria.meta_value) !='".$_REQUEST['categoria']."'";
        }else{
          $filtro_categoria_escolhida="";
        }
        

        /************************************   Filtro nome da categoria  ************************************/

        $filtro_categoria = "SELECT  distinct(categoria.meta_value) as categoria 
        FROM wp_users AS us
        JOIN wp_usermeta AS categoria  ON  us.ID = categoria.user_id  AND categoria.meta_key = 'afreg_additional_3213'
        JOIN wp_usermeta AS afreg_new_user_status  ON  us.ID = afreg_new_user_status.user_id  AND afreg_new_user_status.meta_key = 'afreg_new_user_status' and afreg_new_user_status.meta_value ='approved'
        where us.user_status = 0 
        $filtro_extra
        $filtro_categoria_escolhida order by  categoria.meta_value asc  ";

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
                            $filtro_extra
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
                $user->categoria = $value;
              }


              if($afreg_field->post_name=='descricao'){
                $user->descricao = $value;
              }

              if($afreg_field->post_name=='foto-do-anunciante'){
                if(trim($value)==''){
                  $user->foto_do_anunciante = 'https://2.gravatar.com/avatar/ec65a0d5f2c7d6732407df4c552409c9?s=64&d=mm&r=g';
                  }else{

                
                    $caminho = 'wp-content/uploads/addify_registration_uploads/'.$value;

                    if(file_exists($caminho)){ 
                      $user->foto_do_anunciante = '/'.$caminho;
                     
                    }else if(file_exists($caminho.'.jpeg')){
                      $user->foto_do_anunciante ='/'.$caminho.'.jpeg';
                    }else{
                      $user->foto_do_anunciante = 'https://2.gravatar.com/avatar/ec65a0d5f2c7d6732407df4c552409c9?s=64&d=mm&r=g';

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
