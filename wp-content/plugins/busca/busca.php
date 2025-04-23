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

        $rel_grupo_subbuscaUsuariosAnunciantes = new colecao('wp_rel_grupo_subcultura', $wpdb);
        $rel_grupo_subbuscaUsuariosAnunciantes->condicoes(array ('grupo_id' => $grupo->ID));
        $rel_grupo_subbuscaUsuariosAnunciantes->obter();

        $subcult = array ();

        foreach ($rel_grupo_subbuscaUsuariosAnunciantes as $item) {
            $subcult[] = $item->ID;
        }


        ob_start();
        include('tpl/buscaUsuariosAnunciantes.phtml');
        $template = ob_get_clean();

        $content = str_replace('[[lista_busca]]', $template, $content);
    }

    return $content;
}

add_filter('the_content', 'content_buscaUsuariosAnunciantes');
