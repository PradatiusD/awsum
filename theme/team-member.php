<section class="row">
  <div class="col-md-9 member-bio">
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

    <div>
      <a href="<?php echo 'http://twitter.com/'.$twitterHandle;?>" target="_blank">
        <i class="fa fa-twitter"></i>
        <?php echo $twitterHandle; ?>
      </a>
    </div>

    <div>
      <a href="<?php echo $linkedInUrl;?>" target="_blank">
        <i class="fa fa-linkedin"></i>
        View Profile
      </a>
    </div>
  </aside>
</section>
<section class="row">
  <div class="col-md-12">
    <?php 
      $googleScholarLink = types_render_field("google-scholar-link", array('output'=>'raw'));
      if (strlen($googleScholarLink) > 0 ):
    ?>
      <h4 class="top-papers">Top Papers on Google Scholar</h4>
    <?php
        require('lib/electrolinux/phpquery/phpQuery/phpQuery.php');
        $html = file_get_contents($googleScholarLink);
        $html = phpQuery::newDocumentHTML($html);
        echo $html->find('#gsc_art');
      endif;
    ?>
    <div class="text-center">
      <a href="<?php echo $googleScholarLink; ?>" class="btn btn-primary btn-lg" target="_blank">
        <i class="fa fa-book"></i>
        View Google Scholar Information
      </a>      
    </div>
    <script>
      (function($){

        var $articleList = $('#gsc_art');

        $('#gsc_art').find('a').each(function(){

          var $this = $(this);
          var oldHref = $this.attr('href');

          if (oldHref.indexOf('http://scholar.google.com') === -1) {
            $this.attr({
              'href':'http://scholar.google.com' + oldHref,
              'target':'_blank'
            });
          }
        });

        $articleList.find('table').addClass('table table-striped');
        $articleList.find('#gsc_a_nn').remove();
        $articleList.find('#gsc_lwp').remove();

      })(jQuery);
    </script>
  </div>
</section>