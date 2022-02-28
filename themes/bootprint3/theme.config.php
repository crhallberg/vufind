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
            'addthis-bookmark' => 'Fugue:bookmark_add.png',
            // 'barcode' => inherited from parent theme
            'cart' => 'Fugue:bookbag.png',
            'cart-add' => 'Fugue:bookbag_add.png',
            'cart-empty' => 'Fugue:bookbag_empty.png',
            'cart-remove' => 'Fugue:bookbag_delete.png',
            'check' => 'Fugue:tick.png',
            'cite' => 'Fugue:asterisk_orange.png',
            // 'collapse' => inherited from parent theme
            'collapse-close' => 'Fugue:bullet_arrow_up.png',
            'collapse-open' => 'Fugue:bullet_arrow_down.png',
            'cover-replacement' => 'Fugue:images.png',
            'currency-eur' => 'Fugue:money_euro.png',
            'currency-gbp' => 'Fugue:money_pound.png',
            // 'currency-inr' => inherited from parent theme
            'currency-jpy' => 'Fugue:money_yen.png',
            // 'currency-krw' => inherited from parent theme
            // 'currency-rmb' => inherited from parent theme
            // 'currency-rub' => inherited from parent theme
            // 'currency-try' => inherited from parent theme
            'currency-usd' => 'Fugue:money_dollar.png',
            // 'currency-won' => inherited from parent theme
            'currency-yen' => 'Fugue:money_yen.png',
            // 'dropdown-caret' => inherited from parent theme
            'export' => 'Fugue:link_go.png',
            'export-rtl' => 'Fugue:link_go_rtl.png',
            'external-link' => 'Fugue:link.png',
            'facet-checked' => 'Fugue:tick.png',
            'facet-exclude' => 'Fugue:cross.png',
            'facet-unchecked' => 'Fugue:tick_faded.png',
            'feedback' => 'Fugue:email.png',
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
            'format-file' => 'Fugue:page.png',
            'format-flashcard' => 'Fugue:lightning.png',
            'format-floppydisk' => 'Fugue:disk.png',
            'format-folder' => 'Fugue:folder.png',
            'format-globe' => 'Fugue:world.png',
            'format-journal' => 'Fugue:page.png',
            'format-kit' => 'Fugue:box.png',
            'format-manuscript' => 'Fugue:page_white_text.png',
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
            'format-slide' => 'Fugue:shape_move_forwards.png',
            'format-software' => 'Fugue:page_white_cd.png',
            'format-soundcassette' => 'Fugue:sound.png',
            'format-sounddisc' => 'Fugue:cd.png',
            'format-soundrecording' => 'Fugue:sound.png',
            'format-tapecartridge' => 'Fugue:sound.png',
            'format-tapecassette' => 'Fugue:music.png',
            'format-tapereel' => 'Fugue:film.png',
            'format-transparency' => 'Fugue:shape_move_forwards.png',
            'format-unknown' => 'Fugue:page_red.png',
            'format-video' => 'Fugue:film.png',
            'format-videocartridge' => 'Fugue:film.png',
            'format-videocassette' => 'Fugue:film.png',
            'format-videodisc' => 'Fugue:cd.png',
            'format-videoreel' => 'Fugue:film.png',
            'hierarchy-tree' => 'Fugue:treeCurrent.png',
            // 'lightbox-close' => inherited from parent theme,
            'more' => 'Fugue:arrow_right.png',
            'more-rtl' => 'Fugue:arrow_left.png',
            'my-account' => 'Fugue:user.png',
            // 'my-account-notification' => 'Alias:notification',
            // 'my-account-warning' => 'Alias:warning',
            'notification' => 'Fugue:bell.png',
            'options' => 'Fugue:cog.png',
            'overdrive' => 'Fugue:drive_web.png',
            'overdrive-download' => 'Fugue:drive_web.png',
            // 'overdrive-help' => inherited from parent theme,
            'overdrive-return' => 'Fugue:arrow_right.png',
            'overdrive-return-rtl' => 'Fugue:arrow_left.png',
            // 'overdrive-success' => 'Alias:check',
            // 'overdrive-warning' => 'Alias:warning',
            'page-first' => 'Fugue:resultset_first.png',
            'page-first-rtl' => 'Fugue:resultset_last.png',
            'page-last' => 'Fugue:resultset_last.png',
            'page-last-rtl' => 'Fugue:resultset_first.png',
            'page-next' => 'Fugue:resultset_next.png',
            'page-next-rtl' => 'Fugue:resultset_previous.png',
            'page-prev' => 'Fugue:resultset_previous.png',
            'page-prev-rtl' => 'Fugue:resultset_next.png',
            'place-hold' => 'Fugue:flag_red.png',
            'place-hold-rtl' => 'Fugue:flag_red_rtl.png',
            'place-ill-request' => 'Fugue:arrow_switch.png',
            'place-recall' => 'Fugue:flag_red.png',
            'place-recall-rtl' => 'Fugue:flag_red_rtl.png',
            'place-storage-retrieval' => 'Fugue:lorry.png',
            'print' => 'Fugue:printer.png',
            'profile' => 'Fugue:user.png',
            // 'profile-card-delete' => 'Alias:ui-delete',
            // 'profile-card-edit' => 'Alias:ui-edit',
            'profile-change-password' => 'Fugue:key.png',
            // 'profile-delete' => 'Alias:ui-delete',
            // 'profile-edit' => 'Alias:ui-edit',
            'profile-email' => 'Fugue:email.png',
            'profile-sms' => 'Fugue:phone.png',
            'qrcode' => 'Fugue:qrcode.png',
            'search' => 'Fugue:magnifier.png',
            // 'search-delete' => 'Alias:ui-delete',
            'search-rss' => 'Fugue:rss.png',
            // 'search-save' => 'Alias:ui-save',
            'send-email' => 'Fugue:email.png',
            'send-sms' => 'Fugue:phone.png',
            'sign-in' => 'Fugue:door_in.png',
            'sign-out' => 'Fugue:door_out.png',
            // 'spinner' => inherited from parent theme,
            // 'status-indicator' => inherited from parent theme
            'status-pending' => 'Fugue:time.png',
            'status-ready' => 'Fugue:bell.png',
            'status-retrieval' => 'Fugue:lorry.png',
            // 'tag-add' => 'Alias:ui-add',
            // 'tag-remove' => 'Alias:ui-remove',
            'tree-context' => 'Fugue:treeCurrent.png',
            'truncate-less' => 'Fugue:arrow_up.png',
            'truncate-more' => 'Fugue:arrow_down.png',
            'ui-add' => 'Fugue:add.png',
            'ui-cancel' => 'Fugue:cancel.png',
            'ui-close' => 'Fugue:cross.png',
            'ui-delete' => 'Fugue:bin.png',
            // 'ui-dots-menu' => inherited from parent theme
            'ui-edit' => 'Fugue:edit.png',
            // 'ui-menu' => inherited from parent theme
            'ui-remove' => 'Fugue:cross.png',
            'ui-save' => 'Fugue:disk.png',
            'user-checked-out' => 'Fugue:book.png',
            'user-favorites' => 'Fugue:star.png',
            'user-holds' => 'Fugue:flag_red.png',
            'user-holds-rtl' => 'Fugue:flag_red_rtl.png',
            'user-ill-request' => 'FontAwesome:exchange',
            'user-ill-requests' => 'Fugue:arrow_switch.png',
            'user-list' => 'Fugue:list.png',
            'user-list-add' => 'Fugue:book-bookmark.png',
            // 'user-list-delete' => 'Alias:ui-delete',
            // 'user-list-edit' => 'Alias:ui-edit',
            // 'user-list-entry-edit' => 'Alias:ui-edit',
            // 'user-list-remove' => 'Alias:ui-remove',
            'user-loan-history' => 'Fugue:clock.png',
            'user-public-list-indicator' => 'Fugue:world.png',
            'user-storage-retrievals' => 'Fugue:lorry.png',
            'view-grid' => 'Fugue:view_grid.png',
            'view-list' => 'Fugue:view_list.png',
            'warning' => 'Fugue:error.png',
        ]
    ]
];
