<?php
return [
    'extends' => 'bootstrap3',
    'icons' => [
        'sets' => [
            /**
             * Define icon sets here.
             *
             * All sets need:
             * - 'template': which template the icon renders with
             * - 'src': the location of the relevant resource (font, css, images)
             * - 'prefix': prefix to place before each icon name for convenience
             *             (ie. fa fa- for FontAwesome, default "")
             */
            'Fugue' => [
                'template' => 'images',
                'src' => 'icons', // Processed via imageLink
            ],
        ],
        'aliases' => [
            // UI
            'arrow-right' => 'Fugue:arrow_right.png',
            // 'barcode' => inherited from FontAwesome
            'bookmark' => 'Fugue:bookmark_add.png',
            'cancel' => 'Fugue:cancel.png',
            'cart' => 'Fugue:bookbag.png',
            'cart-add' => 'Fugue:bookbag_add.png',
            'cart-empty' => 'Fugue:bookbag_empty.png',
            'cart-remove' => 'Fugue:bookbag_delete.png',
            // 'check' => inherited from FontAwesome
            'checked-out' => 'Fugue:book.png',
            'cite' => 'Fugue:asterisk_orange.png',
            'collapse-close' => 'Fugue:bullet_arrow_up.png',
            'collapse-open' => 'Fugue:bullet_arrow_down.png',
            'cover-replacement' => 'Fugue:images.png',
            'delete' => 'Fugue:bin.png',
            // 'dropdown-caret' => inherited from FontAwesome
            'edit' => 'Fugue:edit.png',
            'email' => 'Fugue:email.png',
            'export' => 'Fugue:link_go.png',
            'external-link' => 'Fugue:link_go.png',
            // 'facet-checked' => inherited from FontAwesome
            // 'facet-exclude' => inherited from FontAwesome
            // 'facet-unchecked' => inherited from FontAwesome
            'favorites' => 'Fugue:star.png',
            'feedback' => 'Fugue:email.png',
            'hold' => 'Fugue:flag_blue.png',
            'ill-request' => 'Fugue:arrow_switch.png',
            'loan-history' => 'Fugue:clock.png',
            // 'menu-bars' => inherited from FontAwesome
            'more' => 'Fugue:arrow_right.png',
            'my-account' => 'Fugue:user.png',
            'options' => 'Fugue:cog.png',
            'overdrive' => 'Fugue:drive_web.png',
            'page-first' => 'Fugue:resultset_first.png',
            'page-last' => 'Fugue:resultset_last.png',
            'page-next' => 'Fugue:resultset_next.png',
            'page-prev' => 'Fugue:resultset_prev.png',
            'print' => 'Fugue:printer.png',
            'profile' => 'Fugue:user.png',
            'qrcode' => 'Fugue:qrcode.png',
            'recall' => 'Fugue:flag_blue.png',
            'remove' => 'Fugue:cross.png',
            'return' => 'Fugue:arrow_right.png',
            'rss' => 'Fugue:rss.png',
            'save' => 'Fugue:disk.png',
            'search' => 'Fugue:magnifier.png',
            'sign-in' => 'Fugue:door_in.png',
            'sign-out' => 'Fugue:door_out.png',
            'sms' => 'Fugue:phone.png',
            // 'spinner' => inherited from FontAwesome
            'storage-retrieval' => 'Fugue:lorry.png',
            'tree-context' => 'Fugue:treeCurrent.png',
            'ui-add' => 'Fugue:add.png',
            'user-list' => 'Fugue:star.png',
            'view-grid' => 'Fugue:view_grid.png',
            'view-list' => 'Fugue:view_list.png',
            'warning' => 'Fugue:error.png',
            // Formats (Similar items)
            'format-atlas' => 'Fugue:map.png',
            'format-book' => 'Fugue:book.png',
            'format-braille' => 'Fugue:book.png',
            'format-cdrom' => 'Fugue:cd.png',
            'format-chart' => 'Fugue:chart_bar.png',
            'format-chipcartridge' => 'Fugue:computer.png',
            'format-collage' => 'Fugue:photos.png',
            'format-default' => 'Fugue:book.png',
            'format-disccartridge' => 'Fugue:computer.png',
            'format-drawing' => 'Fugue:edit.png',
            'format-ebook' => 'Fugue:book_link.png',
            'format-electronic' => 'Fugue:page_white_zip.png',
            'format-filmstrip' => 'Fugue:film.png',
            'format-flashcard' => 'Fugue:lightning.png',
            'format-floppydisk' => 'Fugue:disk.png',
            'format-globe' => 'Fugue:world.png',
            'format-journal' => 'Fugue:page.png',
            'format-kit' => 'Fugue:box.png',
            'format-manuscript' => 'Fugue:file_white_text.png',
            'format-map' => 'Fugue:map.png',
            'format-microfilm' => 'Fugue:film.png',
            'format-motionpicture' => 'Fugue:page_white_camera.png',
            'format-musicalscore' => 'Fugue:music.png',
            'format-musicrecording' => 'Fugue:music.png',
            'format-newspaper' => 'Fugue:newspaper.png',
            'format-online' => 'Fugue:book_link.png',
            'format-painting' => 'Fugue:page_white_paint.png',
            'format-photo' => 'Fugue:photo.png',
            'format-photonegative' => 'Fugue:photos.png',
            'format-physicalobject' => 'Fugue:bricks.png',
            'format-print' => 'Fugue:photo.png',
            'format-sensorimage' => 'Fugue:camera.png',
            'format-serial' => 'Fugue:layers.png',
            'format-slide' => 'Fugue:shape_move_forward.png',
            'format-software' => 'Fugue:page_white_cd.png',
            'format-soundcassette' => 'Fugue:sound.png',
            'format-sounddisc' => 'Fugue:cd.png',
            'format-soundrecording' => 'Fugue:sound.png',
            'format-tapecartridge' => 'Fugue:sound.png',
            'format-tapecassette' => 'Fugue:music.png',
            'format-tapereel' => 'Fugue:film.png',
            'format-transparency' => 'Fugue:shape_move_forward.png',
            'format-unknown' => 'Fugue:page_red.png',
            'format-video' => 'Fugue:film.png',
            'format-videocartridge' => 'Fugue:film.png',
            'format-videocassette' => 'Fugue:film.png',
            'format-videodisc' => 'Fugue:cd.png',
            'format-videoreel' => 'Fugue:film.png',
            // Currencies
            'eur' => 'Fugue:money_euro.png',
            'gbp' => 'Fugue:money_pound.png',
            // 'inr' => inherited from FontAwesome
            'jpy' => 'Fugue:money_yen.png',
            // 'krw' => inherited from FontAwesome
            // 'rmb' => inherited from FontAwesome
            // 'rub' => inherited from FontAwesome
            // 'try' => inherited from FontAwesome
            'usd' => 'Fugue:money_dollar.png',
            // 'won' => inherited from FontAwesome
            'yen' => 'Fugue:money_yen.png',
        ]
    ]
];
