<?php get_header(); ?>

<?php 
// 1. On définit les arguments pour définir ce que l'on souhaite récupérer
$args = array(
    'post_type' => 'post',
);

// 2. On exécute la WP Query
$my_query = new WP_Query( $args );?>

<h1>Erreur lexiste pas !</h1>

<?php get_posts(); ?>


<div>
    <h2>Découvrez donc nos derniers articles :</h2>
	<?php if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post(); ?>

    <article class="post">
        <h2><?php the_title(); ?></h2>

        <?php the_post_thumbnail(); ?>
        
        <p class="post__meta">
            Publié le <?php the_time( get_option( 'date_format' ) ); ?> 
            par <?php the_author(); ?> • <?php comments_number(); ?>
        </p>
        <?php the_excerpt(); ?>

    </article>
	<?php endwhile; endif; ?>
</diV>

<?php get_footer();

// 4. On réinitialise à la requête principale (important)
wp_reset_postdata();
?>