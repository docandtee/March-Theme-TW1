<div class="flex justify-center items-center mt-3 mb-5">
    <a class="text-primary hover:text-dark transition m-1" href="<?php /* news posts page */ echo esc_url( get_page_link( 1089 ) ); ?>" alt="The Latest">All</a>
    <?php
    $categories = get_categories( array(
        'orderby' => 'name',
        'order'   => 'ASC'
    ) );

    foreach( $categories as $category ) {
        $category_link = sprintf( 
            '<a class="text-primary hover:text-dark transition m-1" href="%1$s" alt="%2$s">%3$s</a>',
            esc_url( get_category_link( $category->term_id ) ),
            esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
            esc_html( $category->name )
        );
        
        echo sprintf( esc_html__( '%s', 'textdomain' ), $category_link );

    }  ?> 
</div>
<div class="flex justify-center items-center mt-3 mb-10">
    <?php get_template_part('searchform'); ?>
</div>