<?php
/**
 * search.php
 * @package WordPress
 * @subpackage Bevesi
 * @since Bevesi 1.0
 * 
 */
 ?>

<?php get_header(); ?>

<div class="container">
	<div class="page-wrapper">

		<?php if( get_theme_mod( 'bevesi_blog_layout' ) == 'left-sidebar') { ?>
		
			<h2 class="search-title"><?php printf( esc_html__( '@@1 Resultados para busca: %s', 'bevesi' ), get_search_query() ); ?></h2>
			
			<div class="row content-wrapper sidebar-left">
				<div id="sidebar" class="col col-12 col-lg-3 secondary-column sticky blog-sidebar">
					<div class="sidebar-inner sticky-holder sticky-top-20 overflow-visible">
						<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
							<?php dynamic_sidebar( 'blog-sidebar' ); ?>
						<?php } ?>
					</div>
				</div>
				<div id="primary" class="col col-12 col-lg-9 primary-column">
					<div class="blog-posts">
						<?php if (have_posts()) : while (have_posts()) : the_post(); 
						 
						?>

							<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

						<?php endwhile; ?>
					
							<?php get_template_part( 'post-format/pagination' ); ?>
							
						<?php else : ?>

							<h2><?php esc_html_e('Nenhum anúnciante encontrado com  filtro escolhido !', 'bevesi') ?></h2>

						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php } elseif( get_theme_mod( 'bevesi_blog_layout' ) == 'full-width') { ?>
			<div class="row content-wrapper">
				<div id="primary" class="col col-12 col-lg-12 primary-column">
				
					<h2 class="search-title"><?php printf( esc_html__( '@@2 Resultados para busca: %s', 'bevesi' ), get_search_query() ); ?></h2>
				
					<div class="blog-posts">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

						<?php endwhile; ?>
					
							<?php get_template_part( 'post-format/pagination' ); ?>
							
						<?php else : ?>

							<h2><?php esc_html_e('Nenhum anúnciante encontrado com  filtro escolhido !', 'bevesi') ?></h2>

						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
			
				<?php /* <h2 class="search-title"><?php printf( esc_html__( '@@3 Resultados para busca: %s', 'bevesi' ), get_search_query() ); ?></h2>
			*/ ?>
				<div class="row ">
					<div id="primary" class="col col-12 col-lg-12 primary-column">
						<div class="blog-posts">
							<?php
							
							$all_user_id_post = [];
							global $post; 
							
							if (have_posts()) : while (have_posts()) : the_post();
								
								// Este Loppging grava os usuarios que a busca do relevansi retornou
								$user_id= $post->user_id ;
								if(!in_array($user_id, $all_user_id_post, true)){
									array_push($all_user_id_post, $user_id);
								}

								/*if($_SERVER["REMOTE_ADDR"]=='187.22.179.112'){
								  get_template_part( 'post-format/content', get_post_format() ); 
								}*/

							?>
							<?php endwhile; ?>

							<?php 
							include('post-format/query_busca.php');
							include('post-format/listagem_anuncios.php');
							
							?>
						
							<?php if($_SERVER["REMOTE_ADDR"]=='187.22.179.112'){
 									//get_template_part( 'post-format/pagination' ); 
							}
							?>

								
							<?php else : ?>

								<?php 
								include('post-format/query_busca.php');
								include('post-format/listagem_anuncios.php');
								?>

							<?php endif; ?>
						</div>
					</div>
					<?php /*<div id="sidebar" class="col col-12 col-lg-3 secondary-column sticky blog-sidebar">
						<div class="sidebar-inner sticky-holder sticky-top-20 overflow-visible">
							<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
								<?php dynamic_sidebar( 'blog-sidebar' ); ?>
							<?php } ?>
						</div>
					</div> */ ?>
				</div>
			<?php } else { ?>
				<div class="row content-wrapper">
					<div id="primary" class="col col-12 col-lg-12 primary-column">

						<h2 class="search-title"><?php printf( esc_html__( '@@4 Resultado para a busca: %s', 'bevesi' ), get_search_query() ); ?></h2>
					
						<div class="blog-posts">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

							<?php endwhile; ?>
						
								<?php get_template_part( 'post-format/pagination' ); ?>
								
							<?php else : ?>

								<h2><?php esc_html_e('Nenhum anúnciante encontrado com  filtro escolhido !', 'bevesi') ?></h2>

							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
		
	</div>
</div>

<?php 

if($_SERVER["REMOTE_ADDR"]=='179.215.177.141'){

	if(isset($array_contagem_usuario)){
		print_r($array_contagem_usuario);
	

	foreach($array_contagem_usuario as $ID_user){
		echo $ID_user;

		$quantidade_vizualizacao_busca = get_user_meta($ID_user, 'afreg_additional_3341', true );

		if($quantidade_vizualizacao_busca==''){
			$quantidade_vizualizacao_busca=0; 
		}
		$quantidade_vizualizacao_busca = $quantidade_vizualizacao_busca+1;
	echo 	$query = "update wp_usermeta set meta_value= '".$quantidade_vizualizacao_busca."' WHERE meta_key = 'afreg_additional_3341' AND user_id = $ID_user limit 1";
		$wpdb->query($wpdb->prepare($query));

	}

	}

}
?>


<?php get_footer(); ?>      