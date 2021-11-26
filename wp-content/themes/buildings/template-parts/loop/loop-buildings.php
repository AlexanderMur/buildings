<li class="page-loop__item wow animate__animated animate__fadeInUp" data-wow-duration="0.8s">

    <a href="#" class="favorites-link favorites-link__add" title="Добавить в Избранное" role="button">
        <span class="icon-heart"><span class="path1"></span><span class="path2"></span></span>
    </a>

    <a href="<?php echo get_the_permalink() ?>" class="page-loop__item-link">

        <div class="page-loop__item-image">

            <?php the_post_thumbnail(); ?>
            <div class="page-loop__item-badges">
                <?php
                $badges = wp_get_post_terms($post->ID, 'badges');
                foreach ($badges as $badge) {
                    ?>
                    <span class="badge"><?php echo $badge->name ?></span>
                    <?php
                }
                ?>
            </div>

        </div>

        <div class="page-loop__item-info">

            <h3 class="page-title-h3"><?php the_title() ?></h3>


            <?php
            $deadline = carbon_get_post_meta($post->ID, 'deadline');
            if (strtotime($deadline) > strtotime('now')) {
                ?>
                <p class="page-text">Срок сдачи до <?php echo getQuarterAndYear($deadline) ?></p>
                <?php
            } else {
                ?>
                <p class="page-text">Сдан <?php echo getQuarterAndYear($deadline) ?></p>
                <?php
            }
            ?>

            <?php
            $metro = carbon_get_post_meta($post->ID, 'metros')[0] ?? null;
            if ($metro) {
                ?>
                <div class="page-text to-metro">
                    <span class="<?php echo $metro['metro_icon'] ?>"></span>
                    <span class="page-text"><?php echo $metro['title'] ?> <span> <?php echo $metro['time'] ?> мин.</span></span>
                    <span class="<?php echo $metro['travel_icon'] ?>"></span>
                </div>
                <?php
            }
            ?>


            <span class="page-text text-desc"><?php echo carbon_get_post_meta($post->ID, 'address') ?></span>

        </div>

    </a>

</li>
