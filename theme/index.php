<?php get_header(); ?>

  <div class="container main">
    <div class="row">

      <main class="col-md-9">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <h1>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
                <?php the_title(); ?>
              </a>
            </h1>

            <?php
              // If blog home
              if (is_post_type_archive()): ?>
                <article class="row">

                  <?php if (has_post_thumbnail()): ?>

                    <div class="col-md-3">
                      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('thumbnail', array('class'=>'img-responsive')); ?>
                      </a>
                    </div>
                    <div class="col-md-9">
                  <?php else:?>
                    <div class="col-md-12">
                  <?php endif; ?>
                      <?php the_excerpt(); ?>
                    </div>
                </article>
              <?php
              else:
                if (get_post_type() == 'team-member') {
                  get_template_part('team-member');
                } else {
                  the_content('Read more...');
                }
              endif;
            ?>

        <?php endwhile;?>

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