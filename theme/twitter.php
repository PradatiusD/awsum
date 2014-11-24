<?php

  use TwitterOAuth\TwitterOAuth;

  date_default_timezone_set('UTC');

  require_once __DIR__ . '/lib/autoload.php';
  require_once('config.php');

  $twitterHandle = types_render_field("twitter", array());

  if (strlen($twitterHandle) > 0) {

    $tw = new TwitterOAuth($config);

    $params = array(
      'screen_name' => $twitterHandle,
      'count' => 10
      );

    $response = $tw->get('statuses/user_timeline', $params);

    $response = json_encode($response);
    ?>

    <script>
      var teamMemberJSON = <?php echo $response;?>;
    </script>

    <div ng-app="seeds">

      <div ng-controller="TwitterController" class="twitterFeed" id="twitterFeed">

        <h4>Follow <a href="https://twitter.com/<?php echo $twitterHandle;?>"><?php echo $twitterHandle;?></a></h4>
        <hr>

        <article ng-repeat="status in statuses">

          <section class="row">
            <aside class="col-xs-2">
              <a href="http://twitter.com/{{status.user.screen_name}}" target="_blank">
                <img ng-src="{{status.user.profile_image_url}}" alt="" class="twit-img">
              </a>
            </aside>

            <section class="col-xs-10">
              <header>
                <strong ng-bind-html="status.user.name | linkUsername"></strong> 
                <a href="http://twitter.com/@{{status.user.screen_name}}" target="_blank" class="text-muted small">
                  @{{status.user.screen_name}}
                </a>
              </header>
              <p class="tweet">
                <span ng-bind-html="status.text | tweet"></span><br>
                <a href="http://{{status.entities.media[0].expanded_url}}" ng-show="status.entities.media[0]">
                  <img ng-src="{{status.entities.media[0].media_url}}" alt="" class="img-responsive img-rounded twit-media">                
                </a>
                <small>{{fixDate(status.created_at)}}</small>
              </p>
            </section>          
          </section>

          <div class="row">
            <div class="col-md-12">
              <hr>
            </div>
          </div>
        </article>
      </div>

      
    </div>



  <?php

}
