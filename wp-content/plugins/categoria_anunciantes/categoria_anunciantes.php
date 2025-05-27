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

     
     
      
      $consulta_anunciantes_Categoria = "
      SELECT count(us.ID) AS qtd_anuncio , categoria.meta_value as categoria
      FROM wp_users AS us
      JOIN wp_usermeta AS categoria  ON  us.ID = categoria.user_id  AND categoria.meta_key = 'afreg_additional_3213'
      GROUP BY categoria.meta_value
      ORDER BY 1 desc
      LIMIT 7 ";
    /*  JOIN wp_usermeta AS destaque  ON  us.ID = destaque.user_id  AND destaque.meta_key = 'afreg_additional_3288' AND destaque.meta_value = 'sim'*/


      $users_anunciantes_Categoria = $wpdb->get_results($consulta_anunciantes_Categoria);
      
      $contador_icones = 0;

      foreach($users_anunciantes_Categoria as $registro_users_anunciantes_Categoria){

        $query_icone = "select Icone from Categoria_icones where trim(Nome) like trim('".$registro_users_anunciantes_Categoria->categoria."')";
        $nome_do_icone = $wpdb->get_results($query_icone);
        $users_anunciantes_Categoria[$contador_icones]->Icone =  $nome_do_icone[0]->Icone;
       
        $contador_icones++;
      }


        
       ob_start();
       include('tpl/CategoriaAnunciantes.phtml');
       $template = ob_get_clean();

       $content = str_replace('[[Categoria_anunciantes]]', $template, $content);
    }
    

    return $content;
}




add_filter('the_content', 'content_buscaCategoriaAnunciantes');
