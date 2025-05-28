<?php
/*
Plugin Name: Lista de Planos
Plugin URI: http://www.acharefacil.com.br
Description:  Exibe o quadro com a listas de planos
Version: 1.0
Author: Willian Batista
Author URI: http://www.acharefacil.com.br
License: Copyright
*/


function content_mostraListasPlanos($content) {

    global $wpdb;

    if (is_page('atualiza_latitude_longitude') or is_front_page() ) {

      ob_start();
      include('tpl/ListaPlanos.phtml');
      $template = ob_get_clean();

      if ( is_user_logged_in() ) {
        $link_compra_planos = '/criar-anuncio';
      } else {
        $link_compra_planos = 'https://pagar.me';
      }

      $content = str_replace('[[lista_planos]]', $template, $content);

    }

    return $content;
}




add_filter('the_content', 'content_mostraListasPlanos');


