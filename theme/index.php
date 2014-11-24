<?php get_header(); ?>

  <div class="container main">
    <div class="row">

      <main class="col-md-9">

        <?php 
        if ( have_posts() ) : while ( have_posts() ) : the_post();

          if (is_post_type_archive()) {

            get_template_part('archive-view'); 

          } else if (is_singular('team-member')) {

            get_template_part('team-member');

          } else {
            get_template_part('main-view');
          }

          endwhile;
        ?>

            <hr>
            <div class="text-center">
              <nav class="btn-group blog-pagination">       
                <?php previous_posts_link( 'Newer posts' ); ?>
                <?php next_posts_link( 'Older posts' ); ?>
              </nav>
            </div>
        <?php else: ?>
          <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>
        <!-- End WordPress Loop -->

      </main>

      <aside class="col-md-3">
        <?php get_sidebar(); ?>
      </aside>

    </div>


<?php get_footer(); ?>