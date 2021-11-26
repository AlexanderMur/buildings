<?php


namespace Buildings;


use Carbon_Fields\Container;
use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Field;

class Options
{
    /**
     * @var self
     */
    private static $_instance = null;


    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'crb_load']);
        add_action('carbon_fields_register_fields', [$this, 'attach_post_meta']);
        add_action('carbon_fields_register_fields', [$this, 'attach_theme_options']);
    }

    public function crb_load()
    {
        Carbon_Fields::boot();
    }

    public function attach_theme_options()
    {

    }

    public function attach_post_meta()
    {
        Container::make('post_meta', 'characteristics', 'Характеристики')
            ->where('post_type', '=', 'buildings')
            ->add_fields(array(
                Field::make('text', 'company', 'Компания'),
                Field::make('text', 'address', 'Адрес'),
                Field::make('image', 'big_image', 'Большое Изображение'),
                Field::make('text', 'ceiling_height', 'Высота потолков')->set_attribute('type', 'number')->set_attribute('step', '0.1'),
                Field::make('date', 'deadline', 'Срок сдачи'),
                Field::make('text', 'floor_count_min', 'Количество этажей от')->set_attribute('type', 'number')->set_width(50),
                Field::make('text', 'floor_count_max', 'Количество этажей до')->set_attribute('type', 'number')->set_width(50),
                Field::make('complex', 'metros', 'Станции метро')->add_fields([
                    Field::make('radio_image', 'metro_icon', 'Иконка метро')->add_options([
                        'icon-metro icon-metro--red'   => get_template_directory_uri() . '/assets/img/icons/metro-red.svg',
                        'icon-metro icon-metro--green' => get_template_directory_uri() . '/assets/img/icons/metro-green.svg',
                    ])->set_width(5),
                    Field::make('text', 'title', 'Станция')->set_width(20),
                    Field::make('text', 'time', 'Время мин.')->set_attribute('type', 'number')->set_width(1),
                    Field::make('radio_image', 'travel_icon', 'Способ передвижения')->add_options([
                        'icon-bus'       => get_template_directory_uri() . '/assets/img/icons/bus.svg',
                        'icon-walk-icon' => get_template_directory_uri() . '/assets/img/icons/walk-icon.svg',
                    ])->set_width(5),
                ]),

                Field::make('checkbox', 'yard', 'Благоустроенный двор'),
                Field::make('checkbox', 'finishing', 'Отделка под ключ'),
                Field::make('checkbox', 'underground_parking', 'Подземный паркинг'),
                Field::make('checkbox', 'brick', 'Кирпичный дом'),
                Field::make('checkbox', 'river', 'Вид на реку'),
                Field::make('checkbox', 'forest', 'Лес рядом'),
                Field::make('checkbox', 'sale', 'Есть акции'),
            ));

    }

    public function get($name)
    {
        return carbon_get_theme_option($name);
    }

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
