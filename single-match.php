<?php get_header(); ?>

<div class="hero hero_page">
    <?php
    $thumbnail_url = get_the_post_thumbnail_url();
    if ($thumbnail_url) {
        echo '<img src="' . esc_url($thumbnail_url) . '" alt="" class="hero_img">';
    }
    ?>
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
            <h1><?php the_title(); ?></h1>
            <?php
            $type = get_field('type');
            if ($type) {
                echo '<p>' . esc_html($type['label']) . '</p>';
            }
            ?>
            <p class="match_date <?php echo esc_attr((get_field('status') == 'past') ? 'match_date_past' : ''); ?>">
                <?php
                $date = get_field('date');
                if ($date) {
                    $date_obj = DateTime::createFromFormat('d/m/Y g:i a', $date);
                    $formatted_date = $date_obj ? $date_obj->format('d/m | H:i') : '';
                    echo esc_html($formatted_date);
                }
                ?>
            </p>
        </div>
    </div>
</div>

<div class="cards_wrap">
    <?php
    $status = get_field('status');
    if ($status == 'future') {
        $teams = get_field('participants');
        if ($teams && count($teams) >= 2) {
            $team1 = $teams[0];
            $team2 = $teams[1];

            $thumbnail1 = get_the_post_thumbnail_url($team1->ID, 'large');
            $name1 = $team1->post_title;
            $link1 = get_permalink($team1->ID);

            $thumbnail2 = get_the_post_thumbnail_url($team2->ID, 'large');
            $name2 = $team2->post_title;
            $link2 = get_permalink($team2->ID);
            ?>
            <a href="<?php echo esc_url($link1); ?>" class="card_team">
                <img src="<?php echo esc_url($thumbnail1); ?>" alt="<?php echo esc_attr($name1); ?>" class="team_card_img">
                <div class="card_team_title">
                    <h3><?php echo esc_html($name1); ?></h3>
                </div>
            </a>
            <div class="vs">
                <p class="vs">VS</p>
            </div>
            <a href="<?php echo esc_url($link2); ?>" class="card_team">
                <img src="<?php echo esc_url($thumbnail2); ?>" alt="<?php echo esc_attr($name2); ?>" class="team_card_img">
                
                <div class="card_team_title">
                    <h3><?php echo esc_html($name2); ?></h3>
                </div>
            </a>
            <?php
        }
    } elseif ($status == 'past') {
        $winner_array = get_field('winner');
        $looser_array = get_field('looser');

        $winner = $winner_array[0];
        $looser = $looser_array[0];

        if ($winner && $looser) {
            $thumbnail_winner = get_the_post_thumbnail_url($winner->ID, 'thumbnail');
            $name_winner = $winner->post_title;
            $link_winner = get_permalink($winner->ID);

            $thumbnail_looser = get_the_post_thumbnail_url($looser->ID, 'thumbnail');
            $name_looser = $looser->post_title;
            $link_looser = get_permalink($looser->ID);
            ?>
            <a href="<?php echo esc_url($link_winner); ?>" class="card_team">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url($winner->ID, 'large')); ?>" alt="<?php echo esc_attr($name_winner); ?>">
                <div class="card_team_title">
                    <h3><?php echo esc_html($name_winner); ?></h3>
                    <p class="team_card_status">Won</p>
                </div>
            </a>
            <div class="vs">
                <p class="vs">VS</p>
            </div>
            <a href="<?php echo esc_url($link_looser); ?>" class="card_team">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url($looser->ID, 'large')); ?>" alt="<?php echo esc_attr($name_looser); ?>">
                <div class="card_team_title">
                    <h3><?php echo esc_html($name_looser); ?></h3>
                    <p class="team_card_status">Lost</p>
                </div>
            </a>
            <?php
        } else {
            echo '<p>Error: Could not retrieve winner or looser details.</p>';
        }
    }

    $type = get_field('type');
    if ($type && $type['value'] !== '18finale') {
        $previous_matches = get_field('match_precedent1');
        if ($previous_matches && is_array($previous_matches)) {
            ?>
            <h2>Matchs précédents</h2>
            <?php
            foreach ($previous_matches as $match) {
                $match_thumbnail = get_the_post_thumbnail_url($match->ID, 'thumbnail');
                $match_title = $match->post_title;
                $match_link = get_permalink($match->ID);
                ?>
                <a href="<?php echo esc_url($match_link); ?>" class="card_team">
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url($match->ID, 'large')); ?>" alt="<?php echo esc_attr($match_title); ?>">
                    <div class="card_team_">
                        <h3><?php echo esc_html($match_title); ?></h3>
                        <p class="match_date match_date_past">
                            <?php
                            $date = get_field('date', $match->ID);
                            if ($date) {
                                $date_obj = DateTime::createFromFormat('d/m/Y g:i a', $date);
                                if ($date_obj) {
                                    $formatted_date = $date_obj->format('d/m | H:i');
                                    echo esc_html($formatted_date);
                                } else {
                                    echo 'Invalid Date Format';
                                }
                            } else {
                                echo 'Date not available';
                            }
                            ?>
                        </p>
                    </div>
                </a>
                <?php
            }
        }
    }
    ?>
</div>

<?php get_footer(); ?>
