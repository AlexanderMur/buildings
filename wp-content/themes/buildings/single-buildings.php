<?php


get_header();
?>
    <main class="main">

        <div class="container">

            <div class="page-top">
                <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<p id="breadcrumbs" class="page-breadcrumb">','</p>' );
                }
                ?>

            </div>

            <div class="page-section">

                <div class="page-content">

                    <article class="post">

                        <div class="post-header">
                            <h1 class="page-title-h1"><?php the_title() ?></h1>

                            <span><?php echo carbon_get_post_meta($post->ID, 'company') ?></span>

                            <div class="post-header__details">
                                <div class="address"><?php echo carbon_get_post_meta($post->ID, 'address') ?></div>

                                <?php
                                $metros = carbon_get_post_meta($post->ID, 'metros');
                                foreach ($metros as $metro) {
                                    ?>
                                    <div class="metro"><span class="<?php echo $metro['metro_icon'] ?>"></span><?php echo $metro['title'] ?> <span><?php echo $metro['time'] ?> мин.<span
                                                    class="<?php echo $metro['travel_icon'] ?>"></span></span></div>
                                    <?php
                                }
                                ?>



                            </div>

                        </div>

                        <div class="post-image">
                            <?php
                            $image = carbon_get_post_meta($post->ID, 'big_image');
                            $logo_src = wp_get_attachment_image_src($image, 'large')[0] ?? '';
                            ?>
                            <img src="<?php echo $logo_src ?>" alt="Расцветай на Маркса">

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

                            <a href="#"
                               class="favorites-link favorites-link__add"
                               title="Добавить в Избранное"
                               role="button">
                                <span class="icon-heart"><span class="path1"></span><span class="path2"></span></span>
                            </a>

                        </div>

                        <h2 class="page-title-h1">Характеристики ЖК</h2>

                        <ul class="post-specs">
                            <?php
                            $class = wp_get_post_terms($post->ID, 'housing')[0] ?? null;
                            if ($class) {
                                ?>
                                <li>
                                <span class="icon-building"></span>
                                <div class="post-specs__info">
                                    <span>Класс жилья</span>

                                    <p><?php echo $class->name ?></p>
                                </div>
                            </li>
                                <?php
                            }
                            $construction_type = wp_get_post_terms($post->ID, 'construction_type')[0] ?? null;
                            if ($construction_type) {
                                ?>
                                <li>
                                <span class="icon-brick"></span>
                                <div class="post-specs__info">
                                    <span>Конструктив</span>
                                    <p><?php echo $construction_type->name ?></p>
                                </div>
                            </li>
                                <?php
                            }
                            $finishing = wp_get_post_terms($post->ID, 'finishing')[0] ?? null;
                            if ($finishing) {
                                ?>
                                <li>
                                <span class="icon-paint"></span>
                                <div class="post-specs__info">
                                    <span>Отделка</span>
                                    <p>
                                        <?php echo $finishing->name ?>
                                        <span class="tip tip-info" data-toggle="popover" data-placement="top"
                                              data-content="And here's some amazing content. It's very engaging. Right?">
						<span class="icon-prompt"></span>
					</span>
                                    </p>
                                </div>
                            </li>
                                <?php
                            }
                            $deadline = carbon_get_post_meta($post->ID, 'deadline');
                            if ($deadline) {
                                ?>
                                <li>
                                    <span class="icon-calendar"></span>
                                    <div class="post-specs__info">
                                        <span>Срок сдачи</span>
                                        <p><?php echo getQuarterByDate($deadline) ?> кв. <?php echo date_i18n('Y', strtotime($deadline)) ?></p>
                                    </div>
                                </li>
                                <?php
                            }
                            $ceiling_height = carbon_get_post_meta($post->ID, 'ceiling_height');
                            $ceiling_height_text = str_replace('.', ',', $ceiling_height);
                            if ($ceiling_height) {
                                ?>
                                <li>
                                    <span class="icon-ruller"></span>
                                    <div class="post-specs__info">
                                        <span>Высота потолков</span>
                                        <p><?php echo $ceiling_height_text ?> м</p>
                                    </div>
                                </li>
                                <?php
                            }
                            $underground_parking = carbon_get_post_meta($post->ID, 'underground_parking');
                            ?>
                            <li>
                                <span class="icon-parking"></span>
                                <div class="post-specs__info">
                                    <span>Подземный паркинг</span>
                                    <?php
                                    if ($underground_parking) {
                                        ?>
                                        <p>Присутствует</p>
                                        <?php
                                    } else {
                                        ?>
                                        <p>отсутсвует</p>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </li>
                            <?php
                            $floor_count_min = carbon_get_post_meta($post->ID, 'floor_count_min');
                            $floor_count_max = carbon_get_post_meta($post->ID, 'floor_count_max');
                            $floor_count_text = $floor_count_min;
                            if ($floor_count_max) {
                                $floor_count_text .= '-' . $floor_count_max;
                            }
                            if ($floor_count_min) {
                                ?>
                                <li>
                                    <span class="icon-stair"></span>
                                    <div class="post-specs__info">
                                        <span>Этажность</span>
                                        <p><?php echo $floor_count_text?></p>
                                    </div>
                                </li>
                                <?php
                            }
                            $price_group = carbon_get_post_meta($post->ID, 'price_group');
                            ?>
                            <li>
                                <span class="icon-wallet"></span>
                                <div class="post-specs__info">
                                    <span>Ценовая группа</span>
                                    <p>Выше среднего</p>
                                </div>
                            </li>
                            <li>
                                <span class="icon-rating"></span>
                                <div class="post-specs__info">
                                    <span>Рейтинг</span>
                                    <p>8.8</p>
                                </div>
                            </li>
                        </ul>

                        <div class="post-text">
                            <?php the_content() ?>
                        </div>

                    </article>

                </div>

                <div class="page-filter"></div>

            </div>

        </div>

    </main>
<?php

get_footer();
