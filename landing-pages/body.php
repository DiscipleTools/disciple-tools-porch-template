<?php
if ( isset( $this->parts['post_id'] ) && ! empty( $this->parts['post_id'] ) ) {
    $my_postid = $this->parts['post_id'];//This is page id or post id
    $post_status = get_post_status( $my_postid );
    if ( 'publish' === $post_status ) {
        $content_post = get_post( $my_postid );
        $content = $content_post->post_content;
        $content = apply_filters( 'the_content', $content );
        $content = str_replace( ']]>', ']]&gt;', $content );
        echo $content; // @phpcs:ignore
    }
    else {
        echo 'No post found';
    }
}
else {
    echo 'No post found';
}
