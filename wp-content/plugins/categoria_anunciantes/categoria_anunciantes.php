<?php
/*
Plugin Name: Categoria de Anúnciantes
Plugin URI: http://www.acharefacil.com.br
Description: Faz o  Categoria de Anúnciantes
Version: 1.0
Author: Willian Batista
Author URI: http://www.acharefacil.com.br
License: Copyright
*/

function content_buscaCategoriaAnunciantes($content) {
    global $grupo,
           $wpdb;

     if (is_front_page()) {

    //  echo "yyy";
    //  exit;
      
      $consulta_anunciantes_Categoria = "SELECT DISTINCT
      categoria.meta_value as categoria,
      Categoria_icones.Icone as icone
      FROM wp_users AS us
      JOIN wp_usermeta AS categoria  ON  us.ID = categoria.user_id  AND categoria.meta_key = 'afreg_additional_3213'
      JOIN Categoria_icones AS Categoria_icones  ON trim(Categoria_icones.Nome) = trim(categoria.meta_value) 
      JOIN wp_usermeta AS afreg_new_user_status  ON  us.ID = afreg_new_user_status.user_id  AND afreg_new_user_status.meta_key = 'afreg_new_user_status' and afreg_new_user_status.meta_value ='approved'
      where us.user_status = 0 order by  categoria.meta_value asc  limit 9  ";
    /*  JOIN wp_usermeta AS destaque  ON  us.ID = destaque.user_id  AND destaque.meta_key = 'afreg_additional_3288' AND destaque.meta_value = 'sim'*/


      $users_anunciantes_Categoria = $wpdb->get_results($consulta_anunciantes_Categoria);


        
       ob_start();
       include('tpl/CategoriaAnunciantes.phtml');
       $template = ob_get_clean();

       $content = str_replace('[[Categoria_anunciantes]]', $template, $content);
    }
    

    return $content;
}




add_filter('the_content', 'content_buscaCategoriaAnunciantes');
