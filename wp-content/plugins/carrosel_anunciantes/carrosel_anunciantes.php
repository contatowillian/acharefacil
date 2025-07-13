<?php
/*
Plugin Name: Carrosel de Anúnciantes
Plugin URI: http://www.acharefacil.com.br
Description: Faz o  Carrosel de Anúnciantes
Version: 1.0
Author: Willian Batista
Author URI: http://www.acharefacil.com.br
License: Copyright
*/

function content_buscaCarroselAnunciantes($content) {
    global $grupo,
           $wpdb;

     if (is_front_page()) {

      if(isset($_GET['teste_caes'])){
        $user_query = new WP_User_Query( array( 'search' => 'adestrador de cães' ) );
        echo "<pre>";
        print_r($user_query );
        echo "</pre>";
        exit;
      }
      if(isset($_GET['teste_cachorro'])){
        $args  = array(
          's'           => 'adestrador de cães',
          'numberposts' => 10,
          'post_types'  => array( 'post', 'page', 'custom_cpt' ),
          'relevanssi'  => true,
          // add other parameters here...
      );
      
       $query = new WP_Query( $args );

        echo "<pre>";
        print_r($query );
        echo "</pre>";
        exit;
      }
    



    //  echo "yyy";
    //  exit;

      
      $consulta_anunciantes_carrosel = "SELECT DISTINCT
      us.ID,
      us.user_login,
      nome_do_seu_negocio.meta_value as nome_do_seu_negocio,
      descricao.meta_value  as descricao,
      foto_do_anunciante.meta_value  as foto_do_anunciante
      FROM wp_users AS us
      JOIN wp_usermeta AS afreg_new_user_status  ON  us.ID = afreg_new_user_status.user_id  AND afreg_new_user_status.meta_key = 'afreg_new_user_status' and afreg_new_user_status.meta_value ='approved'
      JOIN wp_usermeta AS categoria  ON  us.ID = categoria.user_id  AND categoria.meta_key = 'afreg_additional_3213' 
      and trim(categoria.meta_value) not in ('Profissionais do sexo','Acompanhantes','Massagens eróticas','Massagem') 
      JOIN wp_usermeta AS nome_do_seu_negocio  ON  us.ID = nome_do_seu_negocio.user_id  AND nome_do_seu_negocio.meta_key = 'afreg_additional_3224'
      JOIN wp_usermeta AS descricao  ON  us.ID = descricao.user_id  AND descricao.meta_key = 'afreg_additional_3226'
      JOIN wp_usermeta AS foto_do_anunciante  ON  us.ID = foto_do_anunciante.user_id  AND foto_do_anunciante.meta_key = 'afreg_additional_3212'
      where us.user_status = 0   and  foto_do_anunciante.meta_value!='' and  foto_do_anunciante.meta_value!='00000000-0000-0000-0000-000000000000'  order by rand() limit 15 ";
    /*  JOIN wp_usermeta AS destaque  ON  us.ID = destaque.user_id  AND destaque.meta_key = 'afreg_additional_3288' AND destaque.meta_value = 'sim'*/


       $users_anunciantes_carrosel = $wpdb->get_results($consulta_anunciantes_carrosel);
       $textotitulocat = 'Veja nosso destaques';
       $nome_carrosel = 'site-slider-anunciantes1';
       $classe_carrosel = 'carrosel_destaque_lista';
        
       ob_start();
       include('tpl/CarroselAnunciantes.phtml');
       $template = ob_get_clean();

       $content = str_replace('[[carrosel_anunciantes]]', $template, $content);
    }
    

    return $content;
}




add_filter('the_content', 'content_buscaCarroselAnunciantes');




function content_buscaCarroselAnunciantesRecentes($content) {
  global $grupo,
         $wpdb;

   if (is_front_page()) {

  //  echo "yyy";
  //  exit;

    
    $consulta_anunciantes_carrosel = "SELECT DISTINCT
    us.ID,
    us.user_login,
    nome_do_seu_negocio.meta_value as nome_do_seu_negocio,
    descricao.meta_value  as descricao,
    foto_do_anunciante.meta_value  as foto_do_anunciante
    FROM wp_users AS us
    JOIN wp_usermeta AS afreg_new_user_status  ON  us.ID = afreg_new_user_status.user_id  AND afreg_new_user_status.meta_key = 'afreg_new_user_status' and afreg_new_user_status.meta_value ='approved'
    JOIN wp_usermeta AS categoria  ON  us.ID = categoria.user_id  AND categoria.meta_key = 'afreg_additional_3213'
    and trim(categoria.meta_value) not in ('Profissionais do sexo','Acompanhantes','Massagens eróticas','Massagem') 
    JOIN wp_usermeta AS nome_do_seu_negocio  ON  us.ID = nome_do_seu_negocio.user_id  AND nome_do_seu_negocio.meta_key = 'afreg_additional_3224'
    JOIN wp_usermeta AS descricao  ON  us.ID = descricao.user_id  AND descricao.meta_key = 'afreg_additional_3226'
    JOIN wp_usermeta AS foto_do_anunciante  ON  us.ID = foto_do_anunciante.user_id  AND foto_do_anunciante.meta_key = 'afreg_additional_3212'
    where us.user_status = 0 and  foto_do_anunciante.meta_value!='' and  foto_do_anunciante.meta_value!='00000000-0000-0000-0000-000000000000'  order by user_registered desc limit 15 ";
  /*  JOIN wp_usermeta AS destaque  ON  us.ID = destaque.user_id  AND destaque.meta_key = 'afreg_additional_3288' AND destaque.meta_value = 'sim'*/


    $users_anunciantes_carrosel = $wpdb->get_results($consulta_anunciantes_carrosel);
    $textotitulocat = 'Veja nosso anúncios recentes';
    $nome_carrosel = 'site-slider-anunciantes1';
    $classe_carrosel = 'carrosel_recentes_lista';

     ob_start();
     include('tpl/CarroselAnunciantes.phtml');
     $template = ob_get_clean();

     $content = str_replace('[[carrosel_anunciantes_recentes]]', $template, $content);
  }
  

  return $content;
}




add_filter('the_content', 'content_buscaCarroselAnunciantesRecentes');
