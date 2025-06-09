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


    if (is_page('checkout_plano')) {

      if(!isset($_GET['plano']) or empty($_GET['plano'])){
        
        echo "Parametrô plano não encontrado";
        exit;

      }else{

        if($_GET['plano']=='plano_mensal'){
          $valor = '1990';
          $retorno_gera_checkout=  gera_token_pag_seguro($valor,$_GET['plano']);

        }

        if($_GET['plano']=='plano_semestral'){
          $valor = '4990';
          $retorno_gera_checkout=  gera_token_pag_seguro($valor,$_GET['plano']);

        }

        if($_GET['plano']=='plano_anual'){
          $valor = '11890';
          $retorno_gera_checkout=   gera_token_pag_seguro($valor,$_GET['plano']);

        }
      
        foreach($retorno_gera_checkout->links as $links){
          if($links->rel=='PAY'){
            header("Location: ".$links->href);
          }
        }

      }
      


    }



    if (is_front_page()  or is_page('lista_planos')) {
     
      ob_start();
      include('tpl/ListaPlanos.phtml');
      $template = ob_get_clean();



      if ( is_user_logged_in() ) {
       
        $user = wp_get_current_user();

        $id_usuario_logado = $user->ID;

        $consulta_data_limite_usuario = "SELECT DISTINCT
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
          and us.id  = ". $id_usuario_logado."
          limit 1 ";

        $lista_planos = $wpdb->get_results($consulta_usuarios_anunciantes);

        if(count($lista_planos)>0){
          $content = str_replace('[[lista_planos]]', '', $content);

        }else{
          $content = str_replace('[[lista_planos]]', $template, $content);

        }

        
      } else {
        $content = str_replace('[[lista_planos]]', $template, $content);
      }


    }

    return $content;
}



function gera_token_pag_seguro(){

  $curl = curl_init();

  $token_achar_facil = '14a84a4a-8d7a-43ba-9b4c-19965eccfd99f50b68984ffaba08f4a980aafeb8a3f3eda0-c784-4720-a814-bb2650fde987';

  
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://sandbox.api.pagseguro.com/checkouts',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'
  {
    "expiration_date": "2030-08-14T19:09:10-03:00",
    "reference_id": "1",
    "items": [
      {
        "reference_id": "plano_mensal",
        "name": "plano_mensal",
        "description": "plano_mensal",
        "unit_amount": 1990,
        "quantity": 1
      }
    ],
    "payment_methods": [
      {
        "type": "CREDIT_CARD"
      },
      {
        "type": "CREDIT_CARD"
      }
    ],
    "redirect_url": "https://sorvetedecerveja.com.br/conclusao_plano"
  }
  ',
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer '.$token_achar_facil,
      'Content-type: application/json',
      'accept: application/json',
      'x-client-id: 0ea39b37-5e5f-4995-ad22-62f2663ca0f8',
      'x-client-secret: db4ab4a6-87fc-4122-b4eb-a437b24fb9fb'
    ),
  ));
  
  $response = curl_exec($curl);
  
  curl_close($curl);
  return json_decode($response);
  

}



add_filter('the_content', 'content_mostraListasPlanos');


