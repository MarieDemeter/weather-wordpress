<?php get_header(); ?>

<h1>Voici nos supers FRUITS </h1>

<div>
    <h2>Découvrez nos derniers articles :</h2>
	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

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

<?php get_footer(); ?>