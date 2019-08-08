<div class="clear"></div>
</div>
<footer id="footer">
  <div class="inner">
    <div class="box-top">
      <div class="box-left">
        <h2 class="headline slogan not-mobile"><?php echo ot_get_option('headline_slogan'); ?></h2>
        <div class="menu-footer">
	        <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
        </div>
        <p>Private Cloud by <strong><a href="#" target="_blank" rel="noopener nofollow">Stackscale</a></strong></p>
        <ul class="list-social">
          <li>
	        <a href="<?php echo ot_get_option('instagram_link'); ?>">
	          <i class="fa fa-instagram" aria-hidden="true"></i>
	        </a>
	      </li>
	      <li>
	        <a href="<?php echo ot_get_option('twitter_link'); ?>">
	          <i class="fa fa-twitter" aria-hidden="true"></i>
	        </a>
	      </li>
	      <li>
	        <a href="<?php echo ot_get_option('facebook_link'); ?>">
	         <i class="fa fa-facebook" aria-hidden="true"></i>
	        </a>
	      </li>
        </ul>
      </div>
      <div class="box-right">
        <?php dynamic_sidebar( 'footer-right' ); ?>
      </div>
    </div>
  </div>
</footer>
</div>
</div>

<!-- Modal -->
<div id="airport_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Apply to get access</h4>
      </div>
      <div class="modal-body">
      
      <?php if (is_user_logged_in()): ?>
      <?php echo do_shortcode('[gravityform id=2]'); ?>
      <?php else: ?>
      You need to login first
      <?php endif ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php wp_footer(); ?>

 <script src="<?php  echo get_template_directory_uri(); ?>/js/vendor.2fd930e2b5108d7ee29c.js"></script>
<script src="<?php  echo get_template_directory_uri(); ?>/js/winner.adcd56e89fd1220cbc13.js"></script> 
<script src="<?php  echo get_template_directory_uri(); ?>/js/main.js"></script> 
<script>
        jQuery(document).ready(function($){
          $("ul.address-info li a").on('click', function(event) {
            if (this.hash !== "") {
              event.preventDefault();
              var hash = this.hash;
              $('html, body').animate({
                scrollTop: $(hash).offset().top
              }, 500, function(){
                   window.location.hash = hash;
              });
            } // End if
          });
        });
	</script>

  <script>

    jQuery(document).ready(function($) {
      
      
      $('#airport_modal #field_2_3 input').attr('value', '<?= get_the_ID(); ?>');
      $('#airport_modal #field_2_6 input').attr('value', '<?= get_the_title(); ?>');
      $('#airport_modal #field_2_9 input').attr('value', 'No');


    });


  </script>
</body>
</html>