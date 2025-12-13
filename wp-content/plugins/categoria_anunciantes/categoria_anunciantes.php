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

    
      
      $consulta_anunciantes_Categoria = "SELECT * FROM Categoria_principal";


      $users_anunciantes_Categoria = $wpdb->get_results($consulta_anunciantes_Categoria);
  

        
       ob_start();
       include('tpl/CategoriaAnunciantes.phtml');
       $template = ob_get_clean();

       $content = str_replace('[[Categoria_anunciantes]]', $template, $content);
    }
    

    return $content;
}




add_filter('the_content', 'content_buscaCategoriaAnunciantes');