<?php
/**
 * The loop that displays a page.
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				
                
    <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <article>				
    <?php if (!is_page_template('template-fullwidth.php')) { ?>
        <?php if (is_front_page() && !get_post_meta($post->ID, 'hidetitle', true)) { ?>
            
            <h2 class="entry-title"><span><?php the_title(); ?></span></h2>
            
        <?php } elseif (!get_post_meta($post->ID, 'hidetitle', true)) { ?>
            
            
        <?php } else {
            echo '<br />';
        } ?>
    <?php } ?>
    
        <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'claymore' ), 'after' => '</div>' ) ); ?>
        </div><!-- .entry-content -->
        
        <div class="edit-link-wrap">
            <?php edit_post_link( __( 'Edit', 'claymore' ), '<span class="edit-link">', '</span>' ); ?>
        </div><!-- .edit-link-wrap -->
        </article>
    </section><!-- #post-## -->
    
     <?php if(comments_open()) { ?>
    <div class="loop-single-divider"></div>
    <?php } ?>
    
    
    <?php comments_template( '', true ); ?>
    

<?php endwhile; // end of the loop. ?>