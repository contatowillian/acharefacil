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
  
  $args = array(
    'post_type'      => 'post', // Ou 'page', 'product', 'custom_post_type', etc.
    's'              => 'caẽs', // Este é o parâmetro crucial para a busca
    'posts_per_page' => 10, // Quntos posts por página você quer
    'paged'          => (get_query_var('paged')) ? get_query_var('paged') : 1, // Para paginação
    // Adicione outros parâmetros da WP_Query conforme necessário,
    // como 'category_name', 'tag', 'author', 'meta_query', etc.
    // O Relevanssi vai aprimorar a busca com base no 's'
);

$search_results = new WP_Query($args);

relevanssi_do_query( $search_results );
$search_results = $search_results->get_posts();

echo '<pre>';
print_r($search_results);
echo '</pre>';


foreach( $search_results as $post ) {

  echo '<pre>';
  print_r($post);
  echo '</pre>';
  
}
exit;

  $args = array(
    'meta_query' => array(
      'relation' => 'OR',
        array(
          'compare_key' => 'LIKE',
          'key'     => 'afreg_additional_',
          'value'   => 'adestrador de cachorro',
          'compare' => 'like'
        )
    )
  );


  $user_query = new WP_User_Query($args);

  $user_query->parse_query($args);

  // Usa Relevanssi para ordenar a consulta
  if ( function_exists( 'relevanssi_do_query' ) ) {
    relevanssi_do_query( $user_query );
  }


  $resultado =  $user_query->get_results();
  
  echo count($resultado);

  exit;
  
  
  $args = array(
      'meta_query' => array(
          array(
            'compare_key' => 'LIKE',
              'key'     => $meta_key,    // A chave do metadado que você quer buscar
              'value'   => $search_term, // O valor que você quer buscar, incluindo os curingas '%'
              'compare' => 'LIKE'       // O operador de comparação, neste caso, LIKE
          )
      )
  );

  $users = get_users($args); // Executa a busca pelos usuários
  

  echo count($users).'<br><br>';

  print_r($users);
}




// Função para buscar usuários com meta_valor LIKE '%%'
function buscar_usuarios_por_meta_like($meta_key, $search_term) {
  $args = array(
      'meta_query' => array(
          array(
              'key'     => $meta_key,
              'value'   => $search_term,
              'compare' => 'LIKE'
          )
      )
  );

  $user_query = new WP_Query($args);

  if (!empty($user_query->results)) {
      echo '<h2>Usuários encontrados para meta_key "' . esc_html($meta_key) . '" e busca "' . esc_html($search_term) . '":</h2>';
      echo '<ul>';
      foreach ($user_query->results as $user) {
          echo '<li>' . esc_html($user->display_name) . ' (ID: ' . esc_html($user->ID) . ')</li>';
          // Você pode adicionar mais informações do usuário aqui
      }
      echo '</ul>';
  } else {
      echo '<p>Nenhum usuário encontrado com os critérios especificados.</p>';
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
