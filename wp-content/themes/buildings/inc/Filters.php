<?php


namespace Buildings;


use WP_Query;

class Filters
{

    private static $_instance;

    public function __construct()
    {
        add_action('pre_get_posts', [$this, 'pre_get_posts'], 10, 3);

        add_action('wp_ajax_nopriv_search_buildings', [$this, 'ajax_handle_form']);
        add_action('wp_ajax_search_buildings', [$this, 'ajax_handle_form']);
    }

    public function ajax_handle_form()
    {
        $query = new WP_Query([
            'post_type' => 'buildings',
        ]);
        $this->filter_query($query);
        $query->get_posts();
        ob_start();
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/loop/loop', 'buildings');
            }
        }
        $current_page = $query->get('paged');
        if (!$current_page) {
            $current_page = 1;
        }
        wp_send_json([
            'items'          => ob_get_clean(),
            'limit'          => $query->max_num_pages,
            'has_more_posts' => $current_page < $query->max_num_pages,
        ]);
    }

    function filter_query(WP_Query $query)
    {
        $service_tag_id = 9; //todo Брать из базы данных

        //Номер страницы
        if (isset($_REQUEST['page'])) {
            $page = $_REQUEST['page'];
            $query->set('paged', $page);
        }

        //Поиск по таксономиям
        if (isset($_REQUEST['housing']) || isset($_REQUEST['additional']) || isset($_REQUEST['service'])) {
            $tax_query = [];

            //Класс жилья
            if (isset($_REQUEST['housing'])) {
                $tax_query[] = [
                    'taxonomy' => 'housing',
                    'field'    => 'term_id',
                    'terms'    => $_REQUEST['housing'],
                ];
            }

            //Дополнительные опции
            if (isset($_REQUEST['additional'])) {
                $tax_query[] = [
                    'taxonomy' => 'additional',
                    'field'    => 'term_id',
                    'terms'    => $_REQUEST['additional'],
                    'operator' => 'AND'
                ];
            }

            //Услуги 0%
            if (isset($_REQUEST['service'])) {
                $tax_query[] = [
                    'taxonomy' => 'badges',
                    'field'    => 'term_id',
                    'terms'    => $service_tag_id,
                ];
            }

            $query->set('tax_query', $tax_query);
        }

        //Поиск по мета полям
        if (isset($_REQUEST['general']) || isset($_REQUEST['deadline']) || isset($_REQUEST['price_max']) || isset($_REQUEST['metro_time'])) {
            $meta_query = [];

            //Близость к метро
            if (isset($_REQUEST['metro_time']) && !$_REQUEST['metro_time_any']) {
                $or = [
                    'relation' => 'OR',
                ];
                foreach ($_REQUEST['metro_time'] as $item) {

                    $metro_time_vals = explode('-', $item);
                    $metro_time_min = $metro_time_vals[0] ?? null;
                    $metro_time_max = $metro_time_vals[1] ?? null;
                    if ($metro_time_max) {
                        $or[] = [
                            'key'     => '_metros/time',
                            'value'   => $metro_time_max,
                            'compare' => '<=',
                            'type'    => 'NUMERIC'
                        ];
                    }
                    if ($metro_time_min) {
                        $or[] = [
                            'key'     => '_metros/time',
                            'value'   => $metro_time_min,
                            'compare' => '>=',
                            'type'    => 'NUMERIC'
                        ];
                    }
                }
                $meta_query[] = $or;
            }

            //Основные опции
            if (isset($_REQUEST['general'])) {
                $relation = [
                    'relation' => 'AND'
                ];
                foreach ($_REQUEST['general'] as $item) {
                    $relation[] = [
                        'key'     => '_' . $item,
                        'value'   => 'yes',
                        'compare' => '=',
                    ];
                }
                $meta_query[] = $relation;
            }

            //Срок Сдачи
            if (isset($_REQUEST['deadline'])) {
                if ($_REQUEST['deadline'] === 'passed') {
                    $meta_query[] = [
                        'key'     => '_deadline',
                        'value'   => date('Y-m-d', strtotime('now')),
                        'compare' => '<=',
                        'type'    => 'DATE'
                    ];
                }
                if ($_REQUEST['deadline'] === 'this-year') {
                    $meta_query[] = [
                        'key'     => '_deadline',
                        'value'   => date('Y-m-d', strtotime('first day of january this year')),
                        'compare' => '>=',
                        'type'    => 'DATE'
                    ];
                    $meta_query[] = [
                        'key'     => '_deadline',
                        'value'   => date('Y-m-d', strtotime('last day of december this year')),
                        'compare' => '<=',
                        'type'    => 'DATE'
                    ];
                }
                if ($_REQUEST['deadline'] === 'next-year') {
                    $meta_query[] = [
                        'key'     => '_deadline',
                        'value'   => date('Y-m-d', strtotime('first day of january next year')),
                        'compare' => '>=',
                        'type'    => 'DATE'
                    ];
                    $meta_query[] = [
                        'key'     => '_deadline',
                        'value'   => date('Y-m-d', strtotime('last day of december next year')),
                        'compare' => '<=',
                        'type'    => 'DATE'
                    ];
                }
            }

            $meta_query['relation'] = 'AND';
            $query->set('meta_query', $meta_query);
            return $query;
        }
    }

    function pre_get_posts(WP_Query $query)
    {
        if ($query->is_post_type_archive('buildings') && $query->is_main_query()) {
            return $this->filter_query($query);
        }

        return $query;

    }


    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
