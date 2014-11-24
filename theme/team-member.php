<section class="row">
  <div class="col-md-9 member-bio">

    <h1><?php the_title();?></h1>

    <h4 class="official-title">
      <?php echo types_render_field( "official-title", array()); ?>
    </h4>
    <?php the_content('Read more...'); ?>
  </div>
  <aside class="col-md-3 text-center">
    <?php 

      the_post_thumbnail('thumbnail', array(
        'class'=>'img-responsive member-pic',
        'style'=>'display:inline-block;')
      );

      $twitterHandle = types_render_field("twitter", array());
      $linkedInUrl   = types_render_field("linkedin-public-url", array('output'=>'raw'));
    ?>

  <?php if (strlen($twitterHandle) > 0): ?>
    <div>
      <a href="<?php echo 'http://twitter.com/'.$twitterHandle;?>" target="_blank">
        <i class="fa fa-twitter"></i>
        @<?php echo $twitterHandle; ?>
      </a>
    </div>  
  <?php endif;?>
  
    <div>
      <a href="<?php echo $linkedInUrl;?>" target="_blank">
        <i class="fa fa-linkedin"></i>
        View Profile
      </a>
    </div>
  </aside>
</section>

<?php 
  $googleScholarLink = types_render_field("google-scholar-link", array('output'=>'raw'));
  
  if (strlen($googleScholarLink) > 0 ) {
    get_template_part('google-scholar');     
  }
?>