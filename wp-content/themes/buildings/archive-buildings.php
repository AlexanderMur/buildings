<?php


get_header();

?>

    <main class="main">
        <div class="container">
            <div class="page-top">


                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs" class="page-breadcrumb">', '</p>');
                }
                ?>

                <div class="page-top__switchers">

                    <div class="container">
                        <div class="row">

                            <div class="page-top__switchers-inner">

                                <a href="#" class="page-top__filter">
                                    <span class="icon-filter"></span>
                                    Фильтры
                                </a>

                                <a href="#" data-tab-name="loop" class="page-top__switcher tab-nav active">
                                    <span class="icon-grid"></span>
                                </a>

                                <a href="#" data-tab-name="map" class="page-top__switcher tab-nav">
                                    <span class="icon-marker"></span>
                                </a>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <div class="page-section">

                <div class="page-content">

                    <h1 class="visuallyhidden">Новостройки</h1>

                    <div class="page-loop__wrapper loop tab-content tab-content__active">

                        <ul class="page-loop with-filter">
                            <?php
                            while (have_posts()) {
                                the_post();
                                get_template_part('template-parts/loop/loop', 'buildings');
                            }
                            ?>
                        </ul>

                        <div class="show-more">
                            <?php
                            $page = get_query_var('page') ?: 1;
                            $limit = $wp_query->max_num_pages;
                            ?>
                            <button class="show-more__button"
                                    data-page="<?php echo $page ?>"
                                    data-limit="<?php echo $limit ?>"
                                    style="display: <?php echo $page < $limit ? '' : 'none' ?>"
                            >

                                <span class="show-more__button-icon"></span>

                                Показать еще

                            </button>

                        </div>

                    </div>

                    <div class="page-map tab-content map">

                        <h1>Тут будет карта</h1>

                    </div>

                </div>

                <div class="page-filter fixed">

                    <div class="page-filter__wrapper">

                        <form id="page-filter" class="page-filter__form">

                            <div class="page-filter__body">

                                <div class="page-filter__category">

                                    <a href="#proximity" class="page-filter__category-link" data-toggle="collapse">
                                        <h3 class="page-title-h3">Близость к метро</h3>
                                        <svg width="13"
                                             height="8"
                                             viewBox="0 0 13 8"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z"
                                                    fill="#111111"/>
                                        </svg>
                                    </a>

                                    <div class="page-filter__category-list collapse show" id="proximity">
                                        <ul class="proximity">
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="metro_time[]" id="-10" value="-10">
                                                    <label for="-10">&lt;10</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="metro_time[]" id="10-20" value="10-20">
                                                    <label for="10-20">10-20</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="metro_time[]" id="20-40" value="20-40">
                                                    <label for="20-40">20-40</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="metro_time[]" id="40" value="40">
                                                    <label for="40">40+</label>
                                                </div>
                                            </li>
                                            <li class="w-100">
                                                <div class="checkbox">
                                                    <input type="checkbox"
                                                           name="metro_time_any"
                                                           id="any"
                                                           checked
                                                           value="any">
                                                    <label for="any">Любой</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <div class="page-filter__category">

                                    <a href="#deadline" class="page-filter__category-link" data-toggle="collapse">
                                        <h3 class="page-title-h3">Срок сдачи</h3>
                                        <svg width="13"
                                             height="8"
                                             viewBox="0 0 13 8"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z"
                                                    fill="#111111"/>
                                        </svg>
                                    </a>

                                    <div class="page-filter__category-list collapse show" id="deadline">
                                        <ul class="deadline">
                                            <li>
                                                <div class="radio">
                                                    <input type="radio" name="deadline" id="all" value="all" checked>
                                                    <label for="all">Любой</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio">
                                                    <input type="radio" name="deadline" id="passed" value="passed">
                                                    <label for="passed">Сдан</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio">
                                                    <input type="radio"
                                                           name="deadline"
                                                           id="this-year"
                                                           value="this-year">
                                                    <label for="this-year">В этом году</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="radio">
                                                    <input type="radio"
                                                           name="deadline"
                                                           id="next-year"
                                                           value="next-year">
                                                    <label for="next-year">В следующем году</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <div class="page-filter__category">

                                    <a href="#housing" class="page-filter__category-link" data-toggle="collapse">
                                        <h3 class="page-title-h3">Класс жилья</h3>
                                        <svg width="13"
                                             height="8"
                                             viewBox="0 0 13 8"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z"
                                                    fill="#111111"/>
                                        </svg>
                                    </a>

                                    <div class="page-filter__category-list collapse show" id="housing">
                                        <ul class="housing">
                                            <?php
                                            $housings = get_categories([
                                                'taxonomy' => 'housing',
                                            ]);

                                            $get_housing = $_GET['housing'] ?? '';
                                            foreach ($housings as $housing) {
                                                ?>
                                                <li>
                                                    <div class="checkbox">
                                                        <input
                                                                type="checkbox"
                                                                name="housing[]"
                                                                value="<?php echo $housing->term_id ?>"
                                                                id="<?php echo $housing->term_id ?>"
                                                        <?php echo $housing->term_id == $get_housing ? 'checked' : '' ?>
                                                        >
                                                        <label for="<?php echo $housing->term_id ?>"><?php echo $housing->name ?></label>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                </div>

                                <div class="page-filter__category">

                                    <a href="#general" class="page-filter__category-link" data-toggle="collapse">
                                        <h3 class="page-title-h3">Основные опции</h3>
                                        <svg width="13"
                                             height="8"
                                             viewBox="0 0 13 8"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z"
                                                    fill="#111111"/>
                                        </svg>
                                    </a>

                                    <div class="page-filter__category-list collapse show" id="general">
                                        <ul class="general">
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="general[]" value="yard" id="yard">
                                                    <label for="yard">Благоустроенный двор</label>
                                                    <span class="icon-garden"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox"
                                                           name="general[]"
                                                           value="finishing"
                                                           id="finishing">
                                                    <label for="finishing">Отделка под ключ</label>
                                                    <span class="icon-paint"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox"
                                                           name="general[]"
                                                           value="underground_parking"
                                                           id="underground_parking">
                                                    <label for="underground_parking">Подземный паркинг</label>
                                                    <span class="icon-parking"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="general[]" value="brick" id="brick">
                                                    <label for="brick">Кирпичный дом</label>
                                                    <span class="icon-brick"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="general[]" value="river" id="river">
                                                    <label for="river">Вид на реку</label>
                                                    <span class="icon-water"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="general[]" value="forest" id="forest">
                                                    <label for="forest">Лес рядом</label>
                                                    <span class="icon-tree"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox">
                                                    <input type="checkbox" name="general[]" value="sale" id="sale">
                                                    <label for="sale">Есть акции</label>
                                                    <span class="icon-sale"></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <div class="page-filter__category">

                                    <a href="#additional" class="page-filter__category-link" data-toggle="collapse">
                                        <h3 class="page-title-h3">Дополнительные опции</h3>
                                        <svg width="13"
                                             height="8"
                                             viewBox="0 0 13 8"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z"
                                                    fill="#111111"/>
                                        </svg>
                                    </a>
                                    <?php
                                    $additional_tags = get_categories([
                                        'taxonomy'   => 'additional',
                                        'hide_empty' => 0
                                    ]);
                                    $get_tags = $_GET['additional'] ?? [];
                                    $first_tags = array_slice($additional_tags, 0, 6);
                                    $show_more_tags = array_slice($additional_tags, 6, 100);
                                    ?>
                                    <div class="page-filter__category-list collapse show" id="additional">
                                        <ul class="additional">
                                            <?php
                                            foreach ($first_tags as $additional_tag) {
                                                ?>
                                                <li>
                                                    <div class="checkbox">
                                                        <input type="checkbox"
                                                               name="additional[]"
                                                               value="<?php echo $additional_tag->term_id ?>"
                                                               id="<?php echo $additional_tag->term_id ?>"
                                                            <?php echo in_array($additional_tag->term_id, $get_tags) ? 'checked' : '' ?>
                                                        >
                                                        <label for="<?php echo $additional_tag->term_id ?>"><?php echo $additional_tag->name ?></label>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                        if (count($show_more_tags)) {
                                            ?>
                                            <div class="collapse" id="additional_collapse">
                                                <ul class="additional additional__collapse">
                                                    <?php
                                                    foreach ($show_more_tags as $additional_tag) {
                                                        ?>
                                                        <li>
                                                            <div class="checkbox">
                                                                <input type="checkbox"
                                                                       name="additional[]"
                                                                       value="<?php $additional_tag->term_id ?>"
                                                                       id="<?php $additional_tag->term_id ?>"
                                                                    <?php echo in_array($additional_tag->term_id, $get_tags) ? 'checked' : '' ?>
                                                                >
                                                                <label for="<?php $additional_tag->term_id ?>"><?php echo $additional_tag->name ?></label>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <a href="#additional_collapse"
                                               class="page-filter__category-more"
                                               data-toggle="collapse"
                                               data-count="9"
                                               role="button">Показать еще (<?php echo count($show_more_tags) ?>)</a>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                </div>

                                <div class="page-filter__category service">

                                    <div class="checkbox">
                                        <input type="checkbox" name="service" id="service" checked>
                                        <label for="service"><span class="checkbox__box"></span>Услуги 0%</label>
                                        <span class="tip tip-info" data-toggle="popover" data-placement="top"
                                              data-content="And here's some amazing content. It's very engaging. Right?">
						<span class="icon-prompt"></span>
					</span>
                                    </div>

                                </div>

                            </div>

                            <div class="page-filter__buttons">

                                <button class="button button--pink w-100" type="submit" id="apply_filter">Применить
                                    фильтры
                                </button>

                                <button class="button w-100" type="reset" id="reset_filter">Сбросить фильтры
                                    <svg width="9"
                                         height="8"
                                         viewBox="0 0 9 8"
                                         fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M8.5 0.942702L7.5573 0L4.49999 3.05729L1.4427 0L0.5 0.942702L3.55729 3.99999L0.5 7.0573L1.4427 8L4.49999 4.94271L7.55728 8L8.49998 7.0573L5.44271 3.99999L8.5 0.942702Z"/>
                                    </svg>
                                </button>

                            </div>
                            <input type="hidden" name="action" value="search_buildings">
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </main>

<?php

get_footer();
