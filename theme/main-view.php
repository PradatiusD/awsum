<article class="row">
  <h1>
      <?php the_title(); ?>
  </h1>

  <?php 
  if (has_post_thumbnail()) {
    the_post_thumbnail('thumbnail', array('class'=>'img-responsive'));
  }
  the_content();

?>
</article>