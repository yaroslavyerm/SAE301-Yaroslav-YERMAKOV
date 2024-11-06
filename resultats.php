<?php /* Template Name: Resultats */ ?>

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
                    <p class="tagline">Consultez les</p>
                    <h1>RÉSULTATS</h1>
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
                'value' => 'past', // Value to match
                'compare' => '='
            )
        )
    ));

    if ($match_query->have_posts()) : ?>

  <div class="container_games">
    <?php while ($match_query->have_posts()) : $match_query->the_post(); ?>
        <!-- Link to the single match page with updated class structure -->
        <a href="<?php the_permalink(); ?>" class="match_card">
            <!-- Display the featured image, if available -->
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large'); ?>
            <?php endif; ?>

            <!-- Updated match info section -->
            <div class="match_info">
                <!-- Match title -->
                <h3 class="match_title"><?php the_title(); ?></h3>
                
                <!-- Additional match details -->
                <div class="match_details">
                    <p class="match_stage">
                        <?php 
                        $type_field = get_field_object('type_field'); 
                        echo esc_html($type_field['label']); 
                        ?>
                    </p>
                    <p class="match_datetime">
                        <?php 
                        $timestamp = new DateTime(get_field('match_datetime'));
                        echo $timestamp->format('H:i'); ?> | <?php echo $timestamp->format('d.m'); 
                        ?>
                    </p>
                </div>
            </div>
        </a>
    <?php endwhile; ?>
    <?php endif; ?>
</div>

    <?php wp_reset_postdata(); ?> <!-- Reset the global $post object -->
</div>

<?php get_footer(); ?>
