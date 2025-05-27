<?php
/*
Plugin Name: Faz a Importação dos Anúnciantes
Plugin URI: http://www.acharefacil.com.br
Description: Faz  carrosel da home do Importação dos Anúnciantes
Version: 1.0
Author: Willian Batista
Author URI: http://www.acharefacil.com.br
License: Copyright
*/



 function get_coordenates_by_adress($endere_loc_google,$chave){

  // pega a latitude e longitude
  $url = html_entity_decode('https://maps.google.com/maps/api/geocode/json?key='.$chave.'&address='.$endere_loc_google);
    $url = str_replace(" ", '%20', $url);

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
  $return = curl_exec($curl);
  curl_close($curl);
  $arrResp = json_decode($return, true);
  $array = json_decode(json_encode($arrResp), true);


  //retorna os dados da localização
  if(isset($array['results']['0']['geometry']['location']['lat'])  and isset($array['results']['0']['geometry']['location']['lng']) ){
    $array['results']['0']['geometry']['location'];
  } 

  return $array;
}



function content_importaUsuariosAnunciantes($content) {
    global $wpdb;



    if (is_page('atualiza_latitude_longitude')) {

      $consulta_usuarios_anunciantes = "SELECT * from wp_users  where atualizado_lat_long !='sim' limit 1";



      $chave='AIzaSyCfoajxoXAuaRQns0gtbxP9ys6VDBT8ZMs';

      $consulta_usuarios_anunciantes = "SELECT * from wp_users  where atualizado_lat_long !='sim' limit 1";

      $anunciantes = $wpdb->get_results($consulta_usuarios_anunciantes);

 
      if(!empty($anunciantes)){
        foreach ($anunciantes as $registro_anunciantes){
          
          $cep = get_user_meta( $registro_anunciantes->ID, 'afreg_additional_3239', true );

          if($cep!=''){
            $coordenadas =  get_coordenates_by_adress($cep,$chave);
           /* echo '<pre>';
            print_r($coordenadas['results']['0']);
            echo '</pre>';
            exit;*/
          }

          $query_update = "update wp_users set atualizado_lat_long = 'sim' , geo_long = '".$coordenadas['results']['0']['geometry']['location']['lng']."',geo_lat = '".$coordenadas['results']['0']['geometry']['location']['lat']."' where ID = '".$registro_anunciantes->ID."' limit 1 ";

          $wpdb->query(
            $wpdb->prepare($query_update)
          );

        }
      }



    

    }

    if (is_page('importacao_anunciantes')) {


       /*
      if(isset($_GET['importa_fotos'])){
        $consulta_anunciantes_Categoria = "SELECT DISTINCT
         AN.Foto,
         AN.id_anuncio
        FROM Anuncio AS  AN
        where AN.Foto!='00000000-0000-0000-0000-000000000000'  
        and AN.anunciante_foto_baixada is null
        limit 1000  ";
  
        $lista_fotos = $wpdb->get_results($consulta_anunciantes_Categoria);
        foreach($lista_fotos as $registro_lista_fotos){

          $file = 'https://acharefacil.blob.core.windows.net/publico/foto/'.strtolower($registro_lista_fotos->Foto).'.jpeg';
          $file_headers = @get_headers($file);

          if (!strripos($file_headers[0], '404')) {
            $wpdb->query(
              $wpdb->prepare(  "update Anuncio set anunciante_foto_baixada = 'sim' where id_anuncio = '".$registro_lista_fotos->id_anuncio."' limit 1 ")
            );

          $img = $registro_lista_fotos->Foto.'.jpeg';
          file_put_contents('./wp-content/uploads/addify_registration_uploads/'.$img, file_get_contents($file));

          }

         
        }
      }*/

    /*

        $consulta_usuarios_anunciantes = "SELECT * from Anuncio  where anunciante_cadastrado is null limit 500";


        $anunciantes = $wpdb->get_results($consulta_usuarios_anunciantes);

   
        if(!empty($anunciantes)){
          foreach ($anunciantes as $registro_anunciantes){
            
        
            $senha_randomica = date("Y_M_S_i").rand(100,99999999999999999);

            $usuario_criado = wp_create_user($registro_anunciantes->Email,$senha_randomica,$registro_anunciantes->Email);

            wp_update_user(
                array(
                    'ID'            => $usuario_criado,
                    'first_name'    => $registro_anunciantes->Nome
                )
            );

            $wpdb->query(
              $wpdb->prepare(  "update Anuncio set anunciante_cadastrado = 'sim' where id_anuncio = '".$registro_anunciantes->id_anuncio."' limit 1 ")
            );

            update_user_meta( $usuario_criado, 'afreg_new_user_status','approved');
            update_user_meta( $usuario_criado, 'afreg_additional_3239', $registro_anunciantes->Cep);
            update_user_meta( $usuario_criado, 'afreg_additional_3224',$registro_anunciantes->Titulo);
            update_user_meta( $usuario_criado, 'afreg_additional_3213',$registro_anunciantes->nome_categoria);

            $celular1      = strripos($registro_anunciantes->Telefone, ') 9');
            $celular2      = strripos($registro_anunciantes->Telefone, ') 8');
            $celular3      = strripos($registro_anunciantes->Telefone, ') 7');


            if ($celular1 === false && $celular2 === false && $celular3 === false) {
              update_user_meta( $usuario_criado, 'afreg_additional_3254',$registro_anunciantes->Telefone);
            }else{
              update_user_meta( $usuario_criado, 'afreg_additional_3214',$registro_anunciantes->Telefone);
            }
            
            update_user_meta( $usuario_criado, 'afreg_additional_3226',$registro_anunciantes->MiniDescricao);
            
            if($registro_anunciantes->Foto!='00000000-0000-0000-0000-000000000000'){
              update_user_meta( $usuario_criado, 'afreg_additional_3212',$registro_anunciantes->Foto);
            }
            
            update_user_meta( $usuario_criado, 'afreg_additional_3239',$registro_anunciantes->Cep);
            update_user_meta( $usuario_criado, 'afreg_additional_3240',$registro_anunciantes->Endereco);
            update_user_meta( $usuario_criado, 'afreg_additional_3241',$registro_anunciantes->Numero);
            update_user_meta( $usuario_criado, 'afreg_additional_3242',$registro_anunciantes->Complemento);
            update_user_meta( $usuario_criado, 'afreg_additional_3243',$registro_anunciantes->Bairro);
            update_user_meta( $usuario_criado, 'afreg_additional_3244',$registro_anunciantes->nome_cidade);
            update_user_meta( $usuario_criado, 'afreg_additional_3245',$registro_anunciantes->Uf);
            update_user_meta( $usuario_criado, 'afreg_additional_3255',$registro_anunciantes->UrlSite);
            update_user_meta( $usuario_criado, 'afreg_additional_3217',$registro_anunciantes->UrlFacebook);
            update_user_meta( $usuario_criado, 'afreg_additional_3234',$registro_anunciantes->UrlLinkedin);
     
        
          
          } 
         
        }
      */
    
    
    }
    

    return $content;
}




add_filter('the_content', 'content_importaUsuariosAnunciantes');


