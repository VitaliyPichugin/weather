<?php

//create menu
function myweather_setup(){
    register_nav_menus(array(
        'top'  => 'Menu',
    ));
}
add_action('after_setup_theme', 'myweather_setup');

//register scripts My weather
function myweather_scripts(){

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_script('jquery');

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js');
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array('jquery'));

}
add_action('wp_enqueue_scripts', 'myweather_scripts');

$achievements_meta_fields = array(
    array(
        'label' => 'Вид',
        'desc'  => 'Выберите вид',
        'id'    => 'select_type',
        'type'  => 'select',
        'options' => array (
            'one' => array (
                'label' => 'GIT',
                'value' => 'GIT'
            ),
            'two' => array (
                'label' => 'PHP',
                'value' => 'PHP'
            ),
            'three' => array (
                'label' => 'Wordpress',
                'value' => 'Wordpress'
            )
        )
    ),
    array(
        'label' => 'Задание',
        'desc'  => 'Выберите задание',
        'id'    => 'select_task',
        'type'  => 'select',
        'options' => array (
            'one' => array (
                'label' => 'Создать стартовый проект на CMS Wordpress',
                'value' => 'Создать стартовый проект на CMS Wordpress'
            ),
            'two' => array (
                'label' => 'Перенести созданный проект в GIT репозиторий
                                (https://gitlab.com/) ветка Master) ',
                'value' => 'Перенести созданный проект в GIT репозиторий
                                (https://gitlab.com/) ветка Master) '
            ),
            'three' => array (
                'label' => 'Создать доп. ветку  (develop)',
                'value' => 'Создать доп. ветку  (develop)'
            ),
            'four' => array (
                'label' => 'Создать парсер погоды в Запорожье на 3 дня 
                            Ссылка https://www.gismeteo.ua/weather-zaporizhia-5093/',
                'value' => 'Создать парсер погоды в Запорожье на 3 дня 
                            Ссылка https://www.gismeteo.ua/weather-zaporizhia-5093/'
            ),
            'five' => array (
                'label' => 'Создать wordpress тему с названием (My weather)',
                'value' => 'Создать две страници (одна из них главная)'
            ),
            'six' => array (
                'label' => 'Создать две страници (одна из них главная)',
                'value' => 'Создать две страници (одна из них главная)'
            ),
            'seven' => array (
                'label' => 'Создать template хедера, где вывисок страниц, подвязать template к страницам',
                'value' => 'Создать template хедера, где вывисок страниц, подвязать template к страницам'
            ),
            'eight' => array (
                'label' => 'На главной странице отобразить удобочитаемую табличку с парсингом погоды',
                'value' => 'На главной странице отобразить удобочитаемую табличку с парсингом погоды'
            ),
            'nine' => array (
                'label' => 'Создать Post Type',
                'value' => 'Создать Post Type'
            ),
            'ten' => array (
                'label' => 'Создать поля для даного Post Type',
                'value' => 'Создать поля для даного Post Type'
            ),
            'eleven' => array (
                'label' => 'Отобразить на второй странице созданные Посты',
                'value' => 'Создать поля для даного Post Type'
            )
        )
    ),
    array(
        'label' => 'Затраченное время в часах',
        'desc'  => '(Заполнить сколько ушло время в часах)',
        'id'    => 'select_time',
        'type'  => 'number'
    )
);


if ( ! function_exists( 'my_achievements_cp' ) ) {

//description functional for register_post_type
    function my_achievements_cp() {
        $labels = array(
            'name'                => _x( 'Мои достижения', 'Post Type General Name', 'my_achievements' ),
            'singular_name'       => _x( 'Мое достижение', 'Post Type Singular Name', 'my_achievements' ),
            'menu_name'           => __( 'Мои достижения', 'my_achievements' ),
            'parent_item_colon'   => __( 'Родительский:', 'my_achievements' ),
            'all_items'           => __( 'Все записи', 'my_achievements' ),
            'view_item'           => __( 'Просмотреть', 'my_achievements' ),
            'add_new_item'        => __( 'Добавить новую запись в Мои достижения', 'my_achievements' ),
            'add_new'             => __( 'Добавить новое', 'my_achievements' ),
            'edit_item'           => __( 'Редактировать запись', 'my_achievements' ),
            'update_item'         => __( 'Обновить запись', 'my_achievements' ),
            'search_items'        => __( 'Найти запись', 'my_achievements' ),
            'not_found'           => __( 'Не найдено', 'my_achievements' ),
            'not_found_in_trash'  => __( 'Не найдено в корзине', 'my_achievements' ),
        );
        $args = array(
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', ),
            'taxonomies'          => array( 'my_achievements_tax' ), 
            'public'              => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-book',
        );
        register_post_type( 'my_achievements', $args );
    }
    add_action( 'init', 'my_achievements_cp', 0 );

}

if ( ! function_exists( 'my_achievements_tax' ) ) {

//description functional for register_taxonomy
    function my_achievements_tax() {

        $labels = array(
            'name'                       => _x( 'Категории моих достижений', 'Taxonomy General Name', 'my_achievements' ),
            'singular_name'              => _x( 'Категория моего достижения', 'Taxonomy Singular Name', 'my_achievements' ),
            'menu_name'                  => __( 'Категории', 'my_achievements' ),
            'all_items'                  => __( 'Категории', 'my_achievements' ),
            'parent_item'                => __( 'Родительская категория моего достижения', 'my_achievements' ),
            'parent_item_colon'          => __( 'Родительская категория моего достижения:', 'my_achievements' ),
            'new_item_name'              => __( 'Новая категория', 'my_achievements' ),
            'add_new_item'               => __( 'Добавить новую категорию', 'my_achievements' ),
            'edit_item'                  => __( 'Редактировать категорию', 'my_achievements' ),
            'update_item'                => __( 'Обновить категорию', 'my_achievements' ),
            'search_items'               => __( 'Найти', 'my_achievements' ),
            'add_or_remove_items'        => __( 'Добавить или удалить категорию', 'my_achievements' ),
            'choose_from_most_used'      => __( 'Поиск среди популярных', 'my_achievements' ),
            'not_found'                  => __( 'Не найдено', 'my_achievements' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
        );
        register_taxonomy( 'my_achievements_tax', array( 'my_achievements' ), $args );

    }

    add_action( 'init', 'my_achievements_tax', 0 );

}

function wep_meta_box() {
    add_meta_box(
        'wep_meta_box', // id
        'Мои достижения - дополнительная информация', // title
        'show_my_field_metabox', // callback
        'my_achievements', // where show our field
        'normal',
        'high');
}
add_action('add_meta_boxes', 'wep_meta_box');

function show_my_field_metabox() {
    global $achievements_meta_fields;
    global $post;
// for verification
    echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

    // draw table
    echo '<table class="form-table">';
    foreach ($achievements_meta_fields as $field) {
        // get value if is exist for field
        $meta = get_post_meta($post->ID, $field['id'], true);
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
        switch($field['type']) {
            case 'number':
                echo '<input type="number" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
					        <br /><span class="description">'.$field['desc'].'</span>';
                break;
            case 'select':
                echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
                }
                echo '</select><br /><span class="description">'.$field['desc'].'</span>';
                break;
        }
        echo '</td></tr>';
    }
    echo '</table>';
}

function save_my_meta_fields($post_id) {
    global $achievements_meta_fields;  // arr with field

    // verify
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return $post_id;
    // check auto-save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check role
    if ('my_achievements' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // if ok run foreach
    foreach ($achievements_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true); // get old data if they are
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {  // if data is new
            update_post_meta($post_id, $field['id'], $new); // update data
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old); // if data not found - delete
        }
    } // end foreach
}
add_action('save_post', 'save_my_meta_fields'); // run function save


