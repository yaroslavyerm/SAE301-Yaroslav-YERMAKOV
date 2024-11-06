<?php /* Template Name: Profil */ ?>

<?php get_header(); ?>

<div class="hero_top hero_top_profil">
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

<?php if (is_user_logged_in()) : ?>
    <!-- Display user information if logged in -->
    <div id="userInfo">
        <div>
            <?php 
            // Get current user information
            $current_user = wp_get_current_user();
            ?>
            <img src="<?php echo get_avatar_url($current_user->ID, array('size' => 512)); ?>" alt="User Avatar">
            <h1 class="username"><?php echo esc_html($current_user->display_name); ?></h1>
        </div>
        <p class="rank"><?php echo esc_html(get_user_meta($current_user->ID, 'rank', true)); ?></p>

        <?php
        // Query to find teams the user belongs to
        $user_id = $current_user->ID;
        $team_args = array(
            'post_type'  => 'equipe',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key'     => 'user1',
                    'value'   => $user_id,
                    'compare' => '='
                ),
                array(
                    'key'     => 'user2',
                    'value'   => $user_id,
                    'compare' => '='
                ),
                array(
                    'key'     => 'user3',
                    'value'   => $user_id,
                    'compare' => '='
                ),
                array(
                    'key'     => 'user4',
                    'value'   => $user_id,
                    'compare' => '='
                ),
                array(
                    'key'     => 'user5',
                    'value'   => $user_id,
                    'compare' => '='
                ),
            ),
        );

        $team_query = new WP_Query($team_args);

        // Display team info if the user is part of any team
        if ($team_query->have_posts()) : ?>
            <div class="user_teams">
                <h2>My Teams</h2>
                <?php while ($team_query->have_posts()) : $team_query->the_post(); ?>
                    <div class="team_card">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php 
        
        endif;

        // Reset post data after custom query
        wp_reset_postdata();
        ?>

        <p class="italic">Vous pouvez indiquer votre rank et changer votre avatar dans Tableau de Board</p>

        <a href="http://localhost/sae301/wp-login.php?action=logout&_wpnonce=721f431fd6">Deconnexion</a>
    </div>
<?php else : ?>
    <!-- Display sign-up buttons if not logged in -->
    <div id="signUp">
        <h1>Inscrivez-vous !</h1>
        <p>Vous ne vous êtes pas encore inscrit ?</p>
        <a href="http://localhost/sae301/login">Log In</a>
        <a href="http://localhost/sae301/register">Register</a>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
