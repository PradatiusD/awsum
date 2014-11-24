<?php require('lib/electrolinux/phpquery/phpQuery/phpQuery.php'); ?>

<section class="row">
  <div class="col-md-12">
    <h4 class="top-papers">Top Papers on Google Scholar</h4>
    <?php
        $googleScholarLink = types_render_field("google-scholar-link", array('output'=>'raw'));
        $html = file_get_contents($googleScholarLink);
        $html = phpQuery::newDocumentHTML($html);
        echo $html->find('#gsc_art');
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