<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 * 
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="clearfix"></div>
<div id="comments" class="comments-area comments">

<?php if ( have_comments() ) : ?>
    <h4 class="comments-title h_line_f mb0">
        <?php
                $comments_number = get_comments_number();
                if ( 1 === $comments_number ) {
                        /* translators: %s: post title */
                        printf( esc_html( _x( 'ONE COMMENTS &#41;%s&#41;', 'comments title', 'wooxon' )), '' );
                } else {                                 

                        printf(
                                /* translators: 1: number of comments, 2: post title */
                                esc_html( _nx(
                                        '%1$s COMMENTS &#40;%2$s&#41;',
                                        '%1$s COMMENTS &#40;%2$s&#41;',
                                        $comments_number,
                                        'comments title',
                                        'wooxon'
                                )),						
                                '',
                                number_format_i18n( $comments_number )
                        );
                }
        ?>
    </h4>

    <?php the_comments_navigation(); ?>

    <ul class="comment-list media-list">
            <?php
                    wp_list_comments( array(
                    'type'      => 'all',   
                    'style'    => 'ol',
                    'callback'  => 'wooxon_comment_callback',
                    'short_ping'  => true,

                    ) );
            ?>
    </ul><!-- .comment-list -->

    <?php the_comments_navigation(); ?>

<?php endif; // Check for have_comments(). ?>

<?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wooxon' ); ?></p>
<?php endif; ?>

<?php 
    comment_form();
?>

</div><!-- .comments-area -->