<?php

// форма
add_action( 'the_content', 'ajax_file_upload_html' );

// скрипт
add_action( 'wp_footer', 'ajax_file_upload_jscode' );

// AJAX обработчик
add_action( 'wp_ajax_'.'ajax_fileload',        'ajax_file_upload_callback' );
add_action( 'wp_ajax_nopriv_'.'ajax_fileload', 'ajax_file_upload_callback' );

// HTML код формы
function ajax_file_upload_html( $text ){
    // выходим не наша страница...
    if( $GLOBALS['post']->post_name !== 'after-sale-service-main' )
        return $text;

    return $text .= '
		<input type="file" multiple="multiple" accept="image/*">
		<button class="upload_files" style="display: none">Загрузить файл</button>
		<div class="ajax-reply" ></div>
	';
}



// JS код
function ajax_file_upload_jscode(){
    ?>
    <script>
        jQuery(document).ready(function($){

            // ссылка на файл AJAX  обработчик
            var ajaxurl = '<?= admin_url('admin-ajax.php') ?>';
            var nonce   = '<?= wp_create_nonce('uplfile') ?>';

            var files; // переменная. будет содержать данные файлов

            // заполняем переменную данными, при изменении значения поля file
            $('input[type=file]').on('change', function(){
                files = this.files;
            });

            // обработка и отправка AJAX запроса при клике на кнопку upload_files
            $('.upload_files').on( 'click', function( event ){

                event.stopPropagation(); // остановка всех текущих JS событий
                event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

                // ничего не делаем если files пустой
                if( typeof files == 'undefined' ) return;

                // создадим данные файлов в подходящем для отправки формате
                var data = new FormData();
                $.each( files, function( key, value ){
                    data.append( key, value );
                });

                // добавим переменную идентификатор запроса
                data.append( 'action', 'ajax_fileload' );
                data.append( 'nonce', nonce );
                //data.append( 'post_id', $('body').attr('class').match(/postid-([0-9]+)/)[1] );
                data.append( 'post_id', $('body').attr('class') );

                var $reply = $('#clientfileurl');

                // AJAX запрос
                $reply.text( 'Loading...' );
                $.ajax({
                    url         : ajaxurl,
                    type        : 'POST',
                    data        : data,
                    cache       : false,
                    dataType    : 'json',
                    // отключаем обработку передаваемых данных, пусть передаются как есть
                    processData : false,
                    // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
                    contentType : false,
                    // функция успешного ответа сервера
                    success     : function( respond, status, jqXHR ){
                        // ОК
                        if( respond.success ){
                            $.each( respond.data, function( key, val ){
                                $reply.append( '<p>'+ val +'</p>' );
                            } );
                        }
                        // error
                        else {
                            $reply.text( 'Failure: ' + respond.error );
                        }
                    },
                    // функция ошибки ответа сервера
                    error: function( jqXHR, status, errorThrown ){
                        $reply.text( 'Failure AJAX request: ' + status );
                    }

                });

            });

        })
    </script>
    <?php
}

// обработчик AJAX запроса
function ajax_file_upload_callback(){
    check_ajax_referer( 'uplfile', 'nonce' ); // защита

    if( empty($_FILES) )
        wp_send_json_error( 'No files...' );

    $post_id = (int) $_POST['post_id'];

    // ограничим размер загружаемой картинки
    $sizedata = getimagesize( $_FILES['upfile']['tmp_name'] );
    $max_size = 300;
    if( $sizedata[0]/*width*/ > $max_size || $sizedata[1]/*height*/ > $max_size )
        wp_send_json_error( __('Size < = '. $max_size .'px in width or height...','px') );

    // обрабатываем загрузку файла
    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    // фильтр допустимых типов файлов - разрешим только картинки
    add_filter( 'upload_mimes', function( $mimes ){
        return [
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png',
        ];
    } );

    $uploaded_imgs = array();

    foreach( $_FILES as $file_id => $data ){
        $attach_id = media_handle_upload( $file_id, $post_id );

        // ошибка
        if( is_wp_error( $attach_id ) )
            $uploaded_imgs[] = 'Load failed `'. $data['name'] .'`: '. $attach_id->get_error_message();
        else
            $uploaded_imgs[] = wp_get_attachment_url( $attach_id );
    }

    wp_send_json_success( $uploaded_imgs );

}

add_shortcode( 'ajaxload', 'the_content' );