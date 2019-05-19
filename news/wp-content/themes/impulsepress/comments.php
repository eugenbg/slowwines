<?php
/**
 * Comments Template
 *
 * @file           comments.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 1.3
 */
?>
<?php if (post_password_required()) { ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view any comments.', 'impulse-press'); ?></p>

	<?php return; } ?>


<?php if (comments_open()) : ?>

<?php
    $fields = array(
        'author' =>
            '<div class="form-group">' .
            '<label for="author"> '.  __('Name','impulse-press') .'</label>'.
            '<input type="text" class="form-control" id="author" name="author" placeholder="' . __('Enter Name','impulse-press').'">'.
            '</div>',
        'email' =>
                '<div class="form-group">'.
                '<label for="email">'.__('Email','impulse-press')  .'</label>'.
                '<input type="text" class="form-control" id="email" name="email" placeholder="'. __('Enter Email address','impulse-press') .'">'.
                '</div>',

    );

    $args = array(
        'id_form'           => 'commentform',
        'fields' => apply_filters('comment_form_default_fields', $fields),
        'comment_field'  =>
                '<div class="form-group">'.
                '<label for="comment">'.__('Comment','impulse-press') . '</label>'.
                '<textarea class="form-control" id="comment" name="comment" rows="3" placeholder="'. __('Enter Comment','impulse-press') .'"></textarea>'.
                '</div>',
        'comment_notes_after' => '<div class="row"><div class="col-lg-12"><p class="form-allowed-tags">You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: <br> <code>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt;</code><br><code> &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; </code><br><code>&lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; &lt;strong&gt; </code></p></div></div>'
    );

    comment_form($args);
?>


<script src="<?php echo impulse_press_directory_uri(); ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript">
// Validate
	// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
	// http://docs.jquery.com/Plugins/Validation/
	// http://docs.jquery.com/Plugins/Validation/validate#toptions

		$('.comment-form').validate({
	    rules: {
	      author: {
	        minlength: 2,
	        required: true
	      },
	      email: {
	        required: true,
	        email: true
	      },
	      comment: {
	        minlength: 2,
	        required: true
	      }
	    },
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			success: function(element) {
				element.closest('.form-group').removeClass('has-error').addClass('has-success');
			}
	  });

</script>


<?php endif; ?>

<?php if (have_comments()) : ?>
    <hr>
    <h6 id="comments"><?php comments_number(__('No Comments &#187;', 'impulse-press'), __('1 Comment &#187;', 'impulse-press'), __('% Comments &#187;', 'impulse-press')); ?> for <?php the_title(); ?></h6>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div class="navigation">
        <div class="previous"><?php previous_comments_link(__( '&#8249; Older comments','impulse-press' )); ?></div><!-- end of .previous -->
        <div class="next"><?php next_comments_link(__( 'Newer comments &#8250;','impulse-press', 0 )); ?></div><!-- end of .next -->
    </div><!-- end of.navigation -->
    <?php endif; ?>

    <ol class="commentlist">
        <?php wp_list_comments('avatar_size=60&type=comment'); ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div class="navigation">
        <div class="previous"><?php previous_comments_link(__( '&#8249; Older comments','impulse-press' )); ?></div><!-- end of .previous -->
        <div class="next"><?php next_comments_link(__( 'Newer comments &#8250;','impulse-press', 0 )); ?></div><!-- end of .next -->
    </div><!-- end of.navigation -->
    <?php endif; ?>

<?php else : ?>

<?php endif; ?>

<?php
if (!empty($comments_by_type['pings'])) : // let's seperate pings/trackbacks from comments
    $count = count($comments_by_type['pings']);
    ($count !== 1) ? $txt = __('Pings&#47;Trackbacks','impulse-press') : $txt = __('Pings&#47;Trackbacks','impulse-press');
?>

    <h6 id="pings"><?php echo $count . " " . $txt; ?> <?php _e('for','impulse-press'); ?> "<?php the_title(); ?>"</h6>

    <ol class="commentlist">
        <?php wp_list_comments('type=pings&max_depth=<em>'); ?>
    </ol>


<?php endif; ?>


