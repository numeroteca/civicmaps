<?php
/*
Template Name: Resources sitemap
*/
get_header();
?>


<h2 id="posts">My Post Type</h2>
                            <ul>
                            <?php
                            $terms = get_terms( 'resource-category', 'orderby=name' );
                            foreach ($terms as $term) {
                            echo "<li><h3>".$term->name."</h3>";
                            echo "<ul>";
                            $args = array(
                                    'post_type' => 'resources',
                                    'posts_per_page' => -1,
                                    'tax_query' => array(
                                            array(
                                                    'taxonomy' => 'resource-caterogy',
                                                    'field' => 'slug',
                                                    'terms' => $term->slug
                                            )
                                    )
                            );
                            $new = new WP_Query($args);
                    while ($new->have_posts()) {
                    $new->the_post();
                    echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
                    }
                    echo "</ul>";
                    echo "</li>";
                            } ?>
                            </ul>


<?php get_footer(); ?>
