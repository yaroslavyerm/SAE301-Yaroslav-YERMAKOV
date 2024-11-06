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
        </div>
    </div>
</div>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article class="container-equipe">
            <h2>Participants</h2>
            <div class="container-games">
                <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <?php $user = get_field("user$i"); ?>
                    <?php if ($user) : ?>
                        <div class="card-students">
                            <figure class="avatar-students"><?php echo get_avatar($user['ID'], 512); ?></figure>
                            <p class="name-students"><?php echo $user['display_name']; ?></p>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>

            <div class="container_games">
                <h2>Jeux à jouer</h2>
                <?php
                $args = array(
                    'post_type' => 'match',
                    'meta_query' => array(
                        array(
                            'key' => 'participants',
                            'value' => '"' . get_the_ID() . '"',
                            'compare' => 'LIKE'
                        )
                    )
                );
                $matches = new WP_Query($args);
                if ($matches->have_posts()) :
                    while ($matches->have_posts()) : $matches->the_post();
                        $timestamp = new DateTime(get_field('match_date'));
                        $type_field = get_field_object('type_field');
                        ?>
                        <a href="<?php the_permalink(); ?>" class="match_card">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php endif; ?>
                            <div class="match_info">
                                <h3 class="match_title"><?php the_title(); ?></h3>
                                <div class="match_details">
                                    <p class="match_stage"><?php echo esc_html($type_field['label']); ?></p>
                                    <p class="match_datetime"><?php echo $timestamp->format('H:i'); ?> | <?php echo $timestamp->format('d.m'); ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p>Pas de jeux à jouer.</p>
                <?php endif; ?>
            </div>

            <div class="container_games">
                <h2>Jeux joués</h2>
                <?php
                $args = array(
                    'post_type' => 'match',
                    'meta_query' => array(
                        'relation' => 'OR',
                        array(
                            'key' => 'winner',
                            'value' => '"' . get_the_ID() . '"',
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'loser',
                            'value' => '"' . get_the_ID() . '"',
                            'compare' => 'LIKE'
                        )
                    )
                );
                $matches = new WP_Query($args);
                if ($matches->have_posts()) :
                    while ($matches->have_posts()) : $matches->the_post();
                        $winner = get_field('winner');
                        $loser = get_field('loser');
                        $timestamp = new DateTime(get_field('match_date'));
                        $type_field = get_field_object('type_field');
                        ?>
                        <a href="<?php the_permalink(); ?>" class="match_card">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php endif; ?>
                            <div class="match_info">
                                <h3 class="match_title"><?php the_title(); ?></h3>
                                <div class="match_details">
                                    <p class="match_stage"><?php echo esc_html($type_field['label']); ?></p>
                                    <p class="match_datetime"><?php echo $timestamp->format('H:i'); ?> | <?php echo $timestamp->format('d.m'); ?></p>
                                </div>
                            </div>
                            <?php if (is_array($winner) && in_array(get_the_ID(), array_column($winner, 'ID'))) : ?>
                                <p class="match_result">Gagné</p>
                            <?php elseif (is_array($loser) && in_array(get_the_ID(), array_column($loser, 'ID'))) : ?>
                                <p class="match_result">Perdu</p>
                            <?php endif; ?>
                        </a>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p>Pas de jeux joués.</p>
                <?php endif; ?>
            </div>
        </article>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
