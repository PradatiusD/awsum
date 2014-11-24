<article class="row">
  <h1>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
      <?php the_title(); ?>
    </a>
  </h1>

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