<?php get_header(); ?>

<div class="hero hero_page">
        <img src="<?php echo get_template_directory_uri(); ?>/img/hero_teams.webp" alt="" class="hero_img">
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
                    <p class="tagline">Réncontres les</p>
                    <h1>ÉQUIPES</h1>
                </div>
</div>
</div>

<div class="cards_wrap">
    <?php
    $equipe_query = new WP_Query(array(
        'post_type' => 'equipe', 
        'posts_per_page' => -1
    ));

    if ($equipe_query->have_posts()) : ?>

        <?php while ($equipe_query->have_posts()) : $equipe_query->the_post(); ?>

            <a href="<?php the_permalink(); ?>" class="card_team">
                <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large'); ?>
                <?php endif; ?>
                <div class="card_team_title">
                    <h3>
                        <?php the_title(); ?>
                    </h3>
                </div>
            </a>            

        <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <div>
    <p>Vous voulez faire une partie d’une équipe ?</p>
    <a href="localhost/103/login">S’inscrire</a>
</div>

</div>


<?php get_footer(); ?>
