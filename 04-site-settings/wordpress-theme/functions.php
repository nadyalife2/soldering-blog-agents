<?php
/**
 * SolderBlog — functions.php
 * Подключает стили, шрифты, Яндекс.Метрику, Cookie-скрипт
 */

/* -------------------------------------------------------
   1. ОСНОВНЫЕ НАСТРОЙКИ ТЕМЫ
------------------------------------------------------- */
function solderblog_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    add_theme_support( 'editor-styles' );

    register_nav_menus( [
        'primary' => 'Основное меню',
        'footer'  => 'Подвал',
    ] );
}
add_action( 'after_setup_theme', 'solderblog_setup' );

/* -------------------------------------------------------
   2. СТИЛИ И ШРИФТЫ
------------------------------------------------------- */
function solderblog_enqueue_assets() {

    // Google Fonts: Bitter (заголовки) + Inter (текст) + JetBrains Mono (код)
    wp_enqueue_style(
        'solderblog-fonts',
        'https://fonts.googleapis.com/css2?family=Bitter:wght@400;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap',
        [],
        null
    );

    // Основная тема
    wp_enqueue_style(
        'solderblog-style',
        get_stylesheet_uri(),
        [ 'solderblog-fonts' ],
        wp_get_theme()->get( 'Version' )
    );

    // Cookie-баннер JS
    wp_enqueue_script(
        'solderblog-cookie',
        get_template_directory_uri() . '/js/cookie-banner.js',
        [],
        '1.0.0',
        true   // в footer
    );

    // Основной JS темы
    wp_enqueue_script(
        'solderblog-main',
        get_template_directory_uri() . '/js/main.js',
        [ 'solderblog-cookie' ],
        '1.0.0',
        true
    );

    // Передаём URL ajax и нonce в JS
    wp_localize_script( 'solderblog-main', 'SOLDERBLOG', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'solderblog_nonce' ),
    ] );
}
add_action( 'wp_enqueue_scripts', 'solderblog_enqueue_assets' );

/* -------------------------------------------------------
   3. ЯНДЕКС МЕТРИКА
   Номер счётчика хранится в настройках темы.
   Настройки → Внешний вид → Настройки темы → YM ID
------------------------------------------------------- */
function solderblog_yandex_metrika() {
    $ym_id = get_option( 'solderblog_ym_id', '' );
    if ( empty( $ym_id ) ) return;
    // Метрика вставляется ТОЛЬКО после принятия куки
    // cookie-banner.js вызовет solderblog_init_ym() при согласии
    ?>
    <script>
    window.SOLDERBLOG_YM_ID = <?php echo intval( $ym_id ); ?>;
    function solderblog_init_ym() {
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for(var j=0;j<document.scripts.length;j++){
                if(document.scripts[j].src===r){return;}
            }
            k=e.createElement(t),a=e.getElementsByTagName(t)[0];
            k.async=1;k.src=r;
            a.parentNode.insertBefore(k,a);
        })(window,document,'script','https://mc.yandex.ru/metrika/tag.js','ym');
        ym(window.SOLDERBLOG_YM_ID,'init',{
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    }
    // Если куки уже приняты ранее — запустить сразу
    if ( document.cookie.indexOf('sb_cookie_consent=1') !== -1 ) {
        solderblog_init_ym();
    }
    </script>
    <noscript>
    <div><img src="https://mc.yandex.ru/watch/<?php echo intval( $ym_id ); ?>" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <?php
}
add_action( 'wp_head', 'solderblog_yandex_metrika' );

/* -------------------------------------------------------
   4. ПОЛЕ НАСТРОЕК ТЕМЫ — YM ID
------------------------------------------------------- */
function solderblog_register_settings() {
    register_setting( 'solderblog_options', 'solderblog_ym_id', [
        'type'              => 'integer',
        'sanitize_callback' => 'absint',
        'default'           => '',
    ] );
    add_options_page(
        'Настройки SolderBlog',
        'SolderBlog',
        'manage_options',
        'solderblog-settings',
        'solderblog_settings_page'
    );
}
add_action( 'admin_menu', 'solderblog_register_settings' );

function solderblog_settings_page() {
    ?>
    <div class="wrap">
    <h1>Настройки SolderBlog</h1>
    <form method="post" action="options.php">
        <?php settings_fields( 'solderblog_options' ); ?>
        <table class="form-table">
        <tr>
            <th>Яндекс.Метрика ID</th>
            <td>
                <input type="number" name="solderblog_ym_id"
                    value="<?php echo esc_attr( get_option('solderblog_ym_id') ); ?>"
                    class="regular-text" placeholder="12345678" />
                <p class="description">Только цифры. Найти в счётчике Яндекс.Метрики.</p>
            </td>
        </tr>
        </table>
        <?php submit_button( 'Сохранить' ); ?>
    </form>
    </div>
    <?php
}

/* -------------------------------------------------------
   5. ЗАГОЛОВКИ БЕЗОПАСНОСТИ
------------------------------------------------------- */
function solderblog_security_headers() {
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );
}
add_action( 'send_headers', 'solderblog_security_headers' );

/* -------------------------------------------------------
   6. УБРАТЬ ЛИШНЕЕ ИЗ <head>
------------------------------------------------------- */
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/* -------------------------------------------------------
   7. ВРЕМЯ ЧТЕНИЯ ДЛЯ КАРТОЧЕК
------------------------------------------------------- */
function solderblog_reading_time( $post_id = null ) {
    $content   = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( wp_strip_all_tags( $content ) );
    return max( 1, (int) ceil( $word_count / 200 ) );
}
