<?php get_header(); ?>

<div class="hero hero_page">
<?php
        $thumbnail_url = get_the_post_thumbnail_url();
        if ($thumbnail_url) {
            echo '<img src="' . esc_url($thumbnail_url) . '" alt="" class="hero_img">';
        }
        ?>        <div class="hero_wrap">
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
                    <h1 class="title">
                    <?php the_title(); ?>
                    </h1>

                    <h3>Participants</h3>
                    <div class="container-students">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <?php $user = get_field("user$i"); ?>
                                        <?php if ($user) : ?>
                                                <div class="card-students">
                                                        <figure class="avatar-students"><?php echo get_avatar($user['ID'], 1000); ?></figure>
                                                        <p class="name-students"><?php echo $user['display_name']; ?></p>
                                                </div>
                                        <?php endif; ?>
                                <?php endfor; ?>
                                        </div>
                                        <h2>Games To Play</h2>
                                        <div class="container-games">
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
                                                while ($matches->have_posts()) : $matches->the_post(); ?>
                                                    <div class="card-game">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail('thumbnail'); ?>
                                                            <p class="name-game"><?php the_title(); ?></p>
                                                        </a>
                                                    </div>
                                                <?php endwhile;
                                                wp_reset_postdata();
                                            else : ?>
                                                <p>No games to play.</p>
                                            <?php endif; ?>
                                        </div>

                                        <h2>Played Games</h2>
                                        <div class="container-games">
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
                                                    $loser = get_field('looser');
                                                    ?>
                                                    <div class="card-game">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail('thumbnail'); ?>
                                                            <p class="name-game"><?php the_title(); ?></p>
                                                        </a>
                                                        <?php if (in_array(get_the_ID(), array_column($winner, 'ID'))) : ?>
                                                            <p>Won</p>
                                                        <?php elseif (in_array(get_the_ID(), array_column($loser, 'ID'))) : ?>
                                                            <p>Lost</p>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endwhile;
                                                wp_reset_postdata();
                                            else : ?>
                                                <p>No played games.</p>
                                            <?php endif; ?>
                                        </div>
            </article>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
