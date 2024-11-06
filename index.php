<?php
get_header();
?>
<main class="home">
    <div class="hero hero_home">
        <img src="<?php echo get_template_directory_uri(); ?>/img/hero_home.webp" alt="" class="hero_img">
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
                <p class="tagline">Votre hub ultime pour les tournois Valorant</p>
                <h1><?php bloginfo('name'); ?></h1>
            </div>
            <div class="hero_home_bottom">
                <p>Affrontez, conquérez, et devenez légende !</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <path d="M26.56 11.9333L17.8667 20.6267C16.84 21.6533 15.16 21.6533 14.1333 20.6267L5.44 11.9333" stroke="#ECE8E0" stroke-opacity="1" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>

    <section class="home_texts">
        <p>Participez aux tournois Valorant les plus intenses de la région. Défiez les meilleurs joueurs et équipes, montrez vos compétences et gravissez les échelons du classement. Que vous soyez un pro chevronné ou une étoile montante, ValoVerse est votre porte d'entrée vers la gloire.</p>
        <p><strong>ValoVerse</strong> n'est pas seulement un site de tournois - c'est une communauté pour les joueurs compétitifs de <strong>Valorant</strong>. Nous organisons, suivons et mettons en avant les meilleures parties pour que vous puissiez vous concentrer sur la victoire.</p>
        <p>Avec des calendriers de matchs détaillés, des informations sur les équipes et des mises à jour en direct, <strong>ValoVerse</strong> vous plonge au cœur de l'action du début à la fin. Plongez dans les événements à venir, connectez-vous avec d'autres joueurs et venez célébrer <strong>Valorant</strong> à son plus haut niveau.</p>
    </section>

    <?php
    // Get current date and time in the format matching your ACF field
    $current_datetime = current_time('d/m/Y g:i a');

    // Set up WP_Query to retrieve upcoming matches
    $args = array(
        'post_type'      => 'match',
        'posts_per_page' => 2,
        'meta_key'       => 'date',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => 'date',
                'value'   => $current_datetime,
                'compare' => '>=',
                'type'    => 'DATETIME'
            )
        )
    );

    $match_query = new WP_Query($args);

    if ($match_query->have_posts()) : ?>
        <section class="home_events">
            <h2>Événements à venir</h2>
            <div class="home_matchs">
                <?php while ($match_query->have_posts()) : $match_query->the_post(); 
                    $date_string = get_field('date');
                    $type_field = get_field('type');
                    if($date_string) {
                        // Convert the date from d/m/Y g:i a format to timestamp
                        $timestamp = DateTime::createFromFormat('d/m/Y g:i a', $date_string);
                    }
                ?>
                    <a href="<?php the_permalink(); ?>" class="match_card">
                        <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large');?>
                        <?php endif; ?>
                        <div class="match_info">
                            <h3 class="match_title"><?php the_title(); ?></h3>   
                            <div class="match_details">
                                <p class="match_stage"><?php echo esc_html($type_field['label']); ?></p>
                                <p class="match_datetime"><?php echo $timestamp->format('H:i'); ?> | <?php echo $timestamp->format('d.m'); ?></p>
                            </div>
                        </div>
                        </a>
                <?php endwhile; ?>
                <a class="all_matchs" href="http://localhost/sae301/matchs">Tous les matchs</a>
            </div>
        </section>
    <?php
    else :
        echo '<p>No upcoming matches found.</p>';
    endif;

    // Reset post data
    wp_reset_postdata();
    ?>
</main>
<?php
get_footer();
?>
