<?php /* Template Name: Matchs */ ?>

<?php get_header(); ?>

<div>

<h1><?php the_title();?></h1>
    <?php
    // Query to get the latest matches where the ACF field 'status' is 'future'
    $match_query = new WP_Query(array(
        'post_type' => 'match', // Replace with your custom post type slug for matches
        'posts_per_page' => -1, // Use -1 to show all matches, or set it to a specific number
        'meta_query' => array(
            array(
                'key' => 'status', // ACF field name
                'value' => 'future', // Value to match
                'compare' => '='
            )
        )
    ));

    if ($match_query->have_posts()) : ?>
        <?php while ($match_query->have_posts()) : $match_query->the_post(); ?>
        <div class="card">
            <!-- Link to the single match page -->
            <a href="<?php the_permalink(); ?>" class="card-link">
                <!-- Display the featured image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="card-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <!-- Display the match title -->
                <h3 class="card-title">
                    <?php the_title(); ?>
                </h3>
            </a>
        </div>
        <?php endwhile; ?>
    <?php endif; ?> <!-- Close the if statement -->

    <?php wp_reset_postdata(); ?> <!-- Reset the global $post object -->
</div>

<?php get_footer(); ?>
