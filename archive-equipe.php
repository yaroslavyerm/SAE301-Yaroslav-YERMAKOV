<?php get_header(); ?>

<div>
    <?php
    // Query to get the latest aliments (ingredients)
    $equipe_query = new WP_Query(array(
        'post_type' => 'equipe', // Replace with your custom post type slug for aliments (ingredients)
        'posts_per_page' => -1 // Use -1 to show all aliments, or set it to a specific number
    ));

    if ($equipe_query->have_posts()) : ?>
        <?php while ($equipe_query->have_posts()) : $equipe_query->the_post(); ?>
        <div class="card">
            <!-- Link to the single aliment page -->
            <a href="<?php the_permalink(); ?>" class="card-link">
                <!-- Display the featured image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="card-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <!-- Display the aliment title -->
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
