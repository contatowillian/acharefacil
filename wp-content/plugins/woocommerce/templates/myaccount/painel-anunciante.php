<?php

global $wpdb;

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
                                and ud.id  = ". $id_usuario_logado."
                                limit 1 ";

$verifica_destaque = $wpdb->get_results($consulta_usuarios_anunciantes);


if(count($verifica_destaque)>0){
    $usuario_e_destaque = 'Sim';
}else{
    $usuario_e_destaque = 'Não';
}

/*******************************************************************************************************8*/
 $select_dados_usuario_anunciante_painel = "SELECT DISTINCT
                                            us.ID,
                                            us.user_login,
                                            quantas_vezes_apareceu_pesquisa.meta_value as qtd_vezes_apareceu_pesquisa,
                                            quantas_vezes_detalhe_anuncio.meta_value as qtd_vezes_detalhe_anuncio
                                            FROM wp_users AS us
                                            left JOIN wp_usermeta AS quantas_vezes_apareceu_pesquisa  ON  us.ID = quantas_vezes_apareceu_pesquisa.user_id  AND quantas_vezes_apareceu_pesquisa.meta_key = 'afreg_additional_3341'
                                            left  JOIN wp_usermeta AS quantas_vezes_detalhe_anuncio  ON  us.ID = quantas_vezes_detalhe_anuncio.user_id  AND quantas_vezes_detalhe_anuncio.meta_key = 'afreg_additional_3340'
                                            where us.id  = ". $id_usuario_logado."";

$dados_usuario_anunciante_painel = $wpdb->get_results($select_dados_usuario_anunciante_painel);

$quantas_vezes_apareceu_pesquisa = 0;
$quantas_vezes_detalhe_anuncio = 0;


$quantas_vezes_apareceu_pesquisa = 0;
$quantas_vezes_detalhe_anuncio = 0;

if(count($dados_usuario_anunciante_painel)>0){
    if(count($verifica_destaque)>0){
        $data_limite_destaque = $dados_usuario_anunciante_painel[0]->data_destaque;
    }else{
        $data_limite_destaque = "Sem destaque";
    }

    $quantas_vezes_apareceu_pesquisa = $dados_usuario_anunciante_painel[0]->qtd_vezes_apareceu_pesquisa;
    $quantas_vezes_detalhe_anuncio = $dados_usuario_anunciante_painel[0]->qtd_vezes_detalhe_anuncio;

}



?>

<div class="row painel_anunciante">

    <h1 class='h1_conta_achar_facil'>Sua conta achar é facil </h1>
                     
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 text-center">
        <div role="tabpanel">
            <div class="site-category-box style-2">
                <div class="site-category-thumbnail">
                <a href="/busca/?categoria=Aluguel de materiais para festas	" tabindex="0">
                <span class="im im-icon-Folder-Search"></span></a></div>
                <!-- site-category-thumbnail -->
                <div class="site-category-content">
                <h4 class="category-name"><a href="/busca/?categoria=Aluguel de materiais para festas	" tabindex="0">Quantidade vizualizações do anúncio</a></h4>
                <span class="category-count"><?php echo $quantas_vezes_detalhe_anuncio;?> vezes</span>
                </div>
                <!-- site-category-content -->
            </div>
            <!-- site-category-box -->
        </div>  
    </div>
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12  text-center">
         <div role="tabpanel">
            <div class="site-category-box style-2">
                <div class="site-category-thumbnail">
                <a href="/busca/?categoria=Aluguel de materiais para festas	" tabindex="0">
                <span class="im im-icon-File-Search"></span></a></div>
                <!-- site-category-thumbnail -->
                <div class="site-category-content">
                <h4 class="category-name"><a href="/busca/?categoria=Aluguel de materiais para festas	" tabindex="0">Quantas vezes apareceu na pesquisa</a></h4>
                <span class="category-count"><?php echo $quantas_vezes_apareceu_pesquisa;?> vezes</span>
                </div>
                <!-- site-category-content -->
            </div>
            <!-- site-category-box -->
        </div>  
    </div>
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12  text-center">
         <div role="tabpanel">
            <div class="site-category-box style-2">
                <div class="site-category-thumbnail">
                <a href="/busca/?categoria=Aluguel de materiais para festas	" tabindex="0">
                <span class="im im-icon-Add-UserStar"></span></a></div>
                <!-- site-category-thumbnail -->
                <div class="site-category-content">
                <h4 class="category-name"><a href="/busca/?categoria=Aluguel de materiais para festas	" tabindex="0">Anúncio Destaque</a></h4>
                <span class="category-count"><?php echo $usuario_e_destaque; ?></span>
                </div>
                <!-- site-category-content -->
            </div>
            <!-- site-category-box -->
        </div>  
    </div>
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12  text-center">
         <div role="tabpanel">
            <div class="site-category-box style-2">
                <div class="site-category-thumbnail">
                <a href="/busca/?categoria=Aluguel de materiais para festas	" tabindex="0">
                <span class="im  im-icon-Calendar-3"></span></a></div>
                <!-- site-category-thumbnail -->
                <div class="site-category-content">
                <h4 class="category-name"><a href="/busca/?categoria=Aluguel de materiais para festas	" tabindex="0">Data limite Destaque</a></h4>
                <span class="category-count"><?php echo $data_limite_destaque;?></span>
                </div>
                <!-- site-category-content -->
            </div>
            <!-- site-category-box -->
        </div>  
    </div>
</div>



<br><br>










<style>

    .h1_conta_achar_facil{
        width: 100%;
        text-align: center;
        padding: 5%;
    }
    .painel_anunciante .im {
        font-size: 50px;
        padding-bottom: 12px;
        display: block;
    }

    .painel_anunciante .category-count{
        font-size: 16px !important;
        padding-top: 8px !important;
        display: block !important;
    }

    body .page-id-10 .my-account-navigation {
        display: block !important;
        position: absolute !important;
        border: 1px solid !important;
        width: 110px !important;
        margin-top: 17px !important;
        border-radius: 7px !important;
        background-color: #f3f4f6;
    }

    .site-page-header{ 
        display: none !important;
    }
</style>
