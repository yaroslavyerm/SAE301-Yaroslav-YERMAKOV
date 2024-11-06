<?php /* Template Name: Matchs */ ?>

<?php get_header(); ?>

<div>

<div class="hero hero_page">
        <img src="<?php echo get_template_directory_uri(); ?>/img/hero_matchs.webp" alt="" class="hero_img">
        <div class="hero_wrap">
            <div class="hero_top">
                <!-- logo -->
                <a href="http://localhost/sae301/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M28.174 18.7798L19.8297 27.125L16.6037 23.899L25.4816 15.0164L30.8453 15L48 32.1547L47.9051 32.2505H41.6446L28.174 18.7798ZM19.826 29.8511L28.1703 21.5068L31.3963 24.7319L22.5184 33.6154L17.1547 33.6309L0 16.4762L0.0948834 16.3813H6.35536L19.826 29.8511Z" fill="#ECE8E0"/>
                </svg>
                </a>
                <!-- menu icon -->
                <button class="hero_button" aria-controls="menu" @click="menuIsOpen = true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M4 9.33334H28" stroke="#ECE8E0" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M4 16H28" stroke="#ECE8E0" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M4 22.6667H28" stroke="#ECE8E0" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
            <div class="hero_home_title">
                    <p class="tagline">Preparez-vous pour les</p>
                    <h1>Matchs</h1>
                </div>
</div>
</div>

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
