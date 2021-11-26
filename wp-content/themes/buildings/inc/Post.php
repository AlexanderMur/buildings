<?php


namespace Buildings;


class Post
{
    /**
     * @var self
     */
    private static $_instance = null;

    public function __construct()
    {
        add_action('init', [$this, 'register_post_type']);
        add_action('init', [$this, 'register_taxonomy']);
    }

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function register_post_type()
    {
        register_post_type('buildings', array(
            'labels'             => array(
                'name'               => 'Новостройки',
                'singular_name'      => 'Новостройка',
                'add_new'            => 'Добавить новостройку',
                'add_new_item'       => 'Добавить новостройку',
                'edit_item'          => 'Редактировать',
                'new_item'           => 'Новая новостройка',
                'view_item'          => 'Посмотреть',
                'search_items'       => 'Поиск',
                'not_found'          => 'Ничего не найдено',
                'not_found_in_trash' => 'В корзине не найдено',
                'parent_item_colon'  => '',
                'menu_name'          => 'Новостройки',
                'all_items'          => 'Все публикации',

            ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => true,
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-admin-home',
//            'show_in_rest'       => true,
            'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
        ));
    }

    public function register_taxonomy()
    {
        register_taxonomy('housing', 'buildings', array(
            'hierarchical' => true,
            'labels'       => array(
                'name'              => 'Класс жилья',
                'singular_name'     => 'Класс жилья',
                'search_items'      => 'Поиск',
                'popular_items'     => 'Популярные Классы жилья',
                'all_items'         => 'Все Классы жилья',
                'parent_item'       => null,
                'parent_item_colon' => null,
                'edit_item'         => 'Редактировать',
                'update_item'       => 'Обновить',
                'add_new_item'      => 'Добавить новый',
                'menu_name'         => 'Класс жилья',
            ),
            'show_ui'      => true,
            'query_var'    => true,
            'show_in_rest' => true,
        ));

        register_taxonomy('construction_type', 'buildings', array(
            'hierarchical' => true,
            'labels'       => array(
                'name'              => 'Конструктив',
                'singular_name'     => 'Конструктив',
                'search_items'      => 'Поиск',
                'popular_items'     => 'Популярные Конструктивы',
                'all_items'         => 'Все Конструктивы',
                'parent_item'       => null,
                'parent_item_colon' => null,
                'edit_item'         => 'Редактировать',
                'update_item'       => 'Обновить',
                'add_new_item'      => 'Добавить новый',
                'menu_name'         => 'Конструктив',
            ),
            'show_ui'      => true,
            'query_var'    => true,
            'show_in_rest' => true,
        ));

        register_taxonomy('finishing', 'buildings', array(
            'hierarchical' => true,
            'labels'       => array(
                'name'              => 'Отделка',
                'singular_name'     => 'Отделка',
                'search_items'      => 'Поиск',
                'popular_items'     => 'Популярные Отделки',
                'all_items'         => 'Все Отделки',
                'parent_item'       => null,
                'parent_item_colon' => null,
                'edit_item'         => 'Редактировать',
                'update_item'       => 'Обновить',
                'add_new_item'      => 'Добавить новый',
                'menu_name'         => 'Отделка',
            ),
            'show_ui'      => true,
            'query_var'    => true,
            'show_in_rest' => true,
        ));

        register_taxonomy('price_group', 'buildings', array(
            'hierarchical' => true,
            'labels'       => array(
                'name'              => 'Ценовая группа',
                'singular_name'     => 'Ценовая группа',
                'search_items'      => 'Поиск',
                'popular_items'     => 'Популярные Ценовые группы',
                'all_items'         => 'Все Ценовые группы',
                'parent_item'       => null,
                'parent_item_colon' => null,
                'edit_item'         => 'Редактировать',
                'update_item'       => 'Обновить',
                'add_new_item'      => 'Добавить новую',
                'menu_name'         => 'Ценовая группа',
            ),
            'show_ui'      => true,
            'query_var'    => true,
            'show_in_rest' => true,
        ));

        register_taxonomy('badges', 'buildings', array(
            'hierarchical' => false,
            'labels'       => array(
                'name'              => 'Теги',
                'singular_name'     => 'Теги',
                'search_items'      => 'Поиск',
                'popular_items'     => 'Популярные Теги',
                'all_items'         => 'Все Теги',
                'parent_item'       => null,
                'parent_item_colon' => null,
                'edit_item'         => 'Редактировать',
                'update_item'       => 'Обновить',
                'add_new_item'      => 'Добавить новый Тег',
                'menu_name'         => 'Теги',
            ),
            'show_ui'      => true,
            'query_var'    => true,
            'show_in_rest' => true,
        ));

        register_taxonomy('additional', 'buildings', array(
            'hierarchical' => true,
            'labels'       => array(
                'name'              => 'Дополнительные опции',
                'singular_name'     => 'Дополнительные опции',
                'search_items'      => 'Поиск',
                'popular_items'     => 'Популярные Дополнительные опции',
                'all_items'         => 'Все Дополнительные опции',
                'parent_item'       => null,
                'parent_item_colon' => null,
                'edit_item'         => 'Редактировать',
                'update_item'       => 'Обновить',
                'add_new_item'      => 'Добавить новую опцию',
                'menu_name'         => 'Дополнительные опции',
            ),
            'show_ui'      => true,
            'query_var'    => true,
            'show_in_rest' => true,
        ));
    }
}
