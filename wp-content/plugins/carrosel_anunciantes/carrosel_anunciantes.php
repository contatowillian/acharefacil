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

        buscar_usuarios_por_meta_like_get_users('afreg_additional_', 'cachorro');
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



function buscar_usuarios_por_meta_like_get_users($meta_key, $search_term) {

    echo "Chegou aqui no relevansi";
      
    $search_term = 'adestrador de cachorro'; // Defina o termo de busca aqui

    if ( ! empty( $search_term ) ) {
        $args = array(
            'search'         => '*' . esc_attr( $search_term ) . '*', // Termo de busca
            'search_columns' => array( // Opcional: Especifique colunas para a busca padrão do WP antes do Relevanssi
                'user_login',
                'user_nicename',
                'user_email',
                'user_url',
            ),
            'number'         => 10, // Número de usuários por página
            'paged'          => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
            'meta_query' => array(
                array(
                    'key'     => 'afreg_additional_3213',
                    'value'   => $search_term,
                    'compare' => 'LIKE', // Use 'LIKE' para busca parcial
                ),
            ),

            // 'role__in' => array('subscriber', 'editor'), // Opcional: Buscar apenas em roles específicas
        );
    
        // Adicione o filtro do Relevanssi para user queries
        add_filter( 'relevanssi_user_query_args', 'my_relevanssi_user_query_args' );
    
        $user_query = new WP_User_Query( $args );
    
        // Remova o filtro após a query para não afetar outras queries de usuário
        remove_filter( 'relevanssi_user_query_args', 'my_relevanssi_user_query_args' );
    
        // Defina a função de filtro
        function my_relevanssi_user_query_args( $query_args ) {
            // Esta função é chamada pelo Relevanssi quando ele processa uma WP_User_Query
            // Você pode adicionar lógica extra aqui, se necessário.
            // O Relevanssi já interceptará a busca se o termo 's' estiver presente
            // ou se você tiver configurado nas opções que ele deve assumir queries de usuário.
            return $query_args;
        }
    
        if ( ! empty( $user_query->get_results() ) ) {
            echo '<h2>Resultados da busca por usuários para "' . esc_html( $search_term ) . '"</h2>';
            echo '<ul>';
            foreach ( $user_query->get_results() as $user ) {
                echo '<li>';
                echo '<a href="' . esc_url( get_author_posts_url( $user->ID ) ) . '">' . esc_html( $user->display_name ) . '</a>';
                echo ' (Email: ' . esc_html( $user->user_email ) . ')';
                echo '</li>';
            }
            echo '</ul>';
    
            // Paginação (se houver muitos usuários, você pode precisar de um plugin ou lógica personalizada)
            // A paginação para WP_User_Query é um pouco mais complexa que para WP_Query.
            // Você precisaria calcular o total de páginas com base em $user_query->total_users.
            $total_users    = $user_query->total_users;
            $users_per_page = $args['number'];
            $total_pages    = ceil( $total_users / $users_per_page );
    
            if ( $total_pages > 1 ) {
                echo '<div class="pagination">';
                for ( $i = 1; $i <= $total_pages; $i++ ) {
                    echo '<a href="' . add_query_arg( 'paged', $i, get_permalink() ) . '">' . $i . '</a> ';
                }
                echo '</div>';
            }
    
        } else {
            echo '<p>Nenhum usuário encontrado para "' . esc_html( $search_term ) . '".</p>';
        }
    } else {
        echo '<p>Por favor, digite um termo de busca para usuários.</p>';
    }

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
