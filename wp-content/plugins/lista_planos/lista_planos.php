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

function atualiza_data_destaque_usuario($id_pagamento) {
  global $wpdb;
  
  $select_ultimo_pagamento = "select id_pagamento,user_id,tipo_plano,validado from `pagamento` where id_pagamento = ".$id_pagamento;
  $dados_pagamento = $wpdb->get_results($select_ultimo_pagamento);  

 
  if(isset($dados_pagamento[0]->user_id) && $dados_pagamento[0]->validado!='sim'){

    $data_cadastro = get_user_meta( $dados_pagamento[0]->user_id, 'afreg_additional_3288', true );
   // echo "data_cadasotro".$data_cadastro;

    atualiza_pagamento_validado($dados_pagamento[0]->id_pagamento);

    if($data_cadastro==''){
      $data_formatada = date('Y-m-d');
    }else{
      $dia_data = substr($data_cadastro,0,2);
      $mes_data = substr($data_cadastro,3,2);
      $ano_data = substr($data_cadastro,6,4);
      $data_formatada = $ano_data."-".$mes_data."-".$dia_data;
    }


        
    if($dados_pagamento[0]->tipo_plano=='plano_mensal'){
      $data_cadastro = date('d/m/Y', strtotime($data_formatada. ' + 30 days'));
    }

    if($dados_pagamento[0]->tipo_plano=='plano_semestral'){
      $data_cadastro = date('d/m/Y',strtotime($data_formatada. ' + 180 days'));
    }

    if($dados_pagamento[0]->tipo_plano=='plano_anual'){
      $data_cadastro = date('d/m/Y', strtotime($data_formatada. ' + 360 days'));
    }

    
    update_user_meta( $dados_pagamento[0]->user_id, 'afreg_additional_3288',$data_cadastro);

  }else{ 
    print_r($wpdb);
    echo  "Erro ao atualizar pagamento, entre com contato com o Adminstrador ";
    exit;  
  }
 
  return $dados_pagamento[0]->user_id;
}


function atualiza_pagamento_validado($id_pagamento) {
  global $wpdb;
  
  $result_check =  $wpdb->update( 'pagamento', array(
      'validado' => 'sim'
  ), array(
      'id_pagamento' =>  $id_pagamento
  )
  );
 
 
  if(!$result_check){
     print_r($wpdb);
    echo  "Erro ao validar pagamento ";
    exit;  
  }else{
    return true;
  }

}





function atualiza_pagamento_realizado($id_pagamento) {
  global $wpdb;
  
  try{

    $result_check =  $wpdb->update( 'pagamento', array(
      'pagamento_efetuado' => 'sim'
    ), array(
        'id_pagamento' =>  $id_pagamento
    )
    );
    return true;
  } catch (Exception $e) {
    print_r($wpdb);
    echo  "Erro ao atualizar pagamento ";
    exit;  
  }

}




function atualiza_dados_pagamento($dados) {
  global $wpdb;
  
  $result_check =  $wpdb->update( 'pagamento', array(
      'dados_retorno' => $dados['dados_retorno']
  ), array(
      'id_pagamento' =>  $dados['id_pagamento']
  )
  );
 
 
  if(!$result_check){
     print_r($wpdb);
    echo  "Erro ao atualizar pagamento ";
    exit;  
  }else{
    return true;
  }

}


function inseri_dados_pagamento($dados) {
  global $wpdb;

  $select_ultimo_pagamento_id_user = "select id_pagamento from `pagamento` where pagamento_efetuado is null and tipo_plano= '".$dados['tipo_plano']."' user_id  = ".$dados['user_id'];

  $results=$wpdb->get_results($select_ultimo_pagamento_id_user);
  if (count($results)==0){
    $result_check = $wpdb->insert( 'pagamento', array("user_id"  => $dados['user_id'],"tipo_plano"  => $dados['tipo_plano'], "dados_envio" => $dados['dados_envio']));
  }


  $select_ultimo_pagamento = "select id_pagamento from `pagamento` order by id_pagamento desc";
    
  
  if($result_check){
  return $wpdb->get_results($select_ultimo_pagamento);               

  }else{
    echo $wpdb->last_error;
    echo  "Erro ao gravar pagamento ";
    exit;
  }
}


function content_mostraListasPlanos($content) {

    global $wpdb;



    if (is_page('conclusao_plano')) {


      if ( is_user_logged_in() ) {


        if(!isset($_GET['id_pagamento']) or empty($_GET['id_pagamento'])){

          echo "Codigo do pagamento não enviado, informe ao adminstrador !";

        }else{

          $id_pagamento  = base64_decode($_GET['id_pagamento']);
          atualiza_pagamento_realizado($id_pagamento);
          $id_user_id = atualiza_data_destaque_usuario($id_pagamento);


         $botao_compartilhar = '<a style="background-color: #336838" class="elementor-button elementor-button-link elementor-size-sm" href="https://acharefacil.com.br/detalhe/?detalhe_anunciante='.$id_user_id.'" id="ver-meu-anuncio-botao">
                                  <span class="elementor-button-content-wrapper">
                                        <span class="elementor-button-text">Ver meu anúncio</span>
                                  </span>
                                </a>';
          
          $content = str_replace('[[botoes_ver_anuncio]]', $botao_compartilhar, $content);

        }
      

      }

      return $content;
    }



    if (is_page('cadastro_sucesso')) {


      ob_start();
      include('tpl/PaginaCompartilharCadastro.phtml');
      $template = ob_get_clean();



      if ( is_user_logged_in() ) {
       
        $user = wp_get_current_user();

        $id_usuario_logado = $user->ID;
        

        $template = str_replace("{{id_user}}",$id_usuario_logado,$template);

        $content = str_replace('[[botoes_compartilhar]]', $template, $content);
      }

      return $content;
    }


    

    if (is_page('checkout_plano')  ) {

      if(!isset($_GET['plano']) or empty($_GET['plano'])){
        
        echo "Parametrô plano não encontrado";
        exit;

      }else{


        $user = wp_get_current_user();

        $dados_usuario_logado = $user;

        $dados_compra = array();

        $dados_compra['user_id'] = $dados_usuario_logado->ID;
        $dados_compra['dados_comprador']['nome'] = $dados_usuario_logado->display_name;
        $dados_compra['dados_comprador']['email'] =   $dados_usuario_logado->user_email;


        if($_GET['plano']=='plano_mensal'){
          $valor = '9.90';
          $dados_compra['valor_plano'] = $valor;
          $dados_compra['descricao_plano'] = "plano_mensal";
          

          $retorno_gera_checkout=  gera_token_pagar_plano($dados_compra);

        }

        if($_GET['plano']=='plano_semestral'){
          $valor = '19.90';
          $dados_compra['valor_plano'] = $valor;
          $dados_compra['descricao_plano'] = "plano_semestral";
          $retorno_gera_checkout=  gera_token_pagar_plano($dados_compra);

        }

        if($_GET['plano']=='plano_anual'){
          $valor = '49.90';
          $dados_compra['valor_plano'] = $valor;
          $dados_compra['descricao_plano'] = "plano_anual";
          $retorno_gera_checkout=   gera_token_pagar_plano($dados_compra);
        }
     
         header("Location: ".$retorno_gera_checkout->init_point);
         
      }
      


    }



    if (is_front_page()  or is_page('lista_planos') ) {
     

      if ( is_user_logged_in() ) {
        $url_compra= '/checkout_plano';
      }else{
        $url_compra= '/criar-anuncio';
      }
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



function gera_token_pagar_plano($dados_compra){

  $dados_pagamento['user_id'] = $dados_compra['user_id'];

  // Substitua pelo seu Access Token do Mercado Pago
  $access_token = "APP_USR-3903374143838872-091110-794a956cdb4c557e344d80b8ea7f3ba6-2677537645";

  $api_url = "https://api.mercadopago.com/checkout/preferences";

  
  $preco_do_produto = $dados_compra['valor_plano'];

  $dados_pagamento['tipo_plano'] =$dados_compra['descricao_plano'];

  $inseri_dados_pagamento = inseri_dados_pagamento($dados_pagamento);


  // Dados do item e da preferência de pagamento
  $dados_pagamento['dados_envio']= [
      "items" => [
          [
              "title" => "".$dados_compra['descricao_plano']."",
              "quantity" => 1,
              "unit_price" =>(float) $preco_do_produto, 
              "currency_id" => "BRL",
          ]
      ],
      "back_urls" => [
          "success" => "https://acharefacil.com.br/conclusao_plano?id_pagamento=".base64_encode($inseri_dados_pagamento[0]->id_pagamento)
      ],
      "auto_return" => "approved"
  ];


 

  // Transforma os dados em formato JSON
  $json_data = json_encode($dados_pagamento['dados_envio']);



  // Inicializa a sessão cURL
  $ch = curl_init($api_url);

  // Configurações da requisição cURL
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retorna a resposta da API como string
  curl_setopt($ch, CURLOPT_POST, true);           // Define a requisição como POST
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data); // Envia os dados JSON no corpo da requisição

  // Define os headers, incluindo o Authorization para autenticação
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "Content-Type: application/json",
      "Authorization: Bearer " . $access_token,
  ]);

  // Executa a requisição e armazena a resposta
  $response = curl_exec($ch);

  // Verifica se houve erros na requisição cURL
  if (curl_errno($ch)) {
      echo "Erro ao gerar pagamento : " . curl_error($ch);
      exit;
  }
  // Fecha a sessão cURL
  curl_close($ch);

  $dados_pagamento['dados_retorno'] = $response;

  $dados_pagamento['id_pagamento'] = $inseri_dados_pagamento[0]->id_pagamento;

  $inseri_dados_pagamento = atualiza_dados_pagamento($dados_pagamento);

  return json_decode($response);

}



add_filter('the_content', 'content_mostraListasPlanos');


