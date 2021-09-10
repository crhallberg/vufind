<?php
return [
    'extends' => 'root',
    'css' => [
        //'vendor/bootstrap.min.css',
        //'vendor/bootstrap-accessibility.css',
        //'bootstrap-custom.css',
        'compiled.css',
        'print.css:print',
        'flex-fallback.css::lt IE 10', // flex polyfill
    ],
    'js' => [
        /**
         * Entries in this section can either be specified as array or as string.
         * Array format is preferred.
         *
         * Available array options:
         * - file: the path to the file
         * - load_after: Use this to explicitly load the file after the given other
         *   file. This may NOT be used together with a priority setting.
         * - priority: an optional priority (lower value means higher priority).
         *      Default convention for VuFind's own themes:
         *          - 1xx => vendor (third-party code)
         *          - 2xx => VuFind library (general-purpose code)
         *          - 3xx => VuFind scripts (highly VuFind-specific code)
         * - position: 'header' (default) or 'footer'
         * - conditional: e.g. 'lt IE 10'
         *
         * Entries with neither priority nor load_after will be loaded after all
         * other entries.
         *
         * Strings are supported for backwards compatibility reasons. examples:
         * - 'example.js' => same as ['file' => 'example.js']
         * - 'example.js:lt IE 10' => same as
         *   ['file' => 'example.js', 'conditional' => 'lt IE 10']
         */
        ['file' => 'vendor/jquery.min.js', 'priority' => 110],
        ['file' => 'vendor/bootstrap.min.js', 'priority' => 120],
        ['file' => 'vendor/bootstrap-accessibility.min.js', 'priority' => 130],
        ['file' => 'vendor/validator.min.js', 'priority' => 140],
        ['file' => 'lib/form-attr-polyfill.js', 'priority' => 210], // input[form] polyfill, cannot load conditionally, since we need all versions of IE
        ['file' => 'lib/autocomplete.js', 'priority' => 220],
        ['file' => 'common.js', 'priority' => 310],
        ['file' => 'lightbox.js', 'priority' => 320],
    ],
    'less' => [
        'active' => false,
        'compiled.less'
    ],
    'favicon' => 'vufind-favicon.ico',
    'helpers' => [
        'factories' => [
            'VuFind\View\Helper\Bootstrap3\CopyToClipboardButton' => 'Laminas\ServiceManager\Factory\InvokableFactory',
            'VuFind\View\Helper\Bootstrap3\Flashmessages' => 'VuFind\View\Helper\Root\FlashmessagesFactory',
            'VuFind\View\Helper\Bootstrap3\Highlight' => 'Laminas\ServiceManager\Factory\InvokableFactory',
            'VuFind\View\Helper\Bootstrap3\LayoutClass' => 'VuFind\View\Helper\Bootstrap3\LayoutClassFactory',
            'VuFind\View\Helper\Bootstrap3\Search' => 'Laminas\ServiceManager\Factory\InvokableFactory',
        ],
        'aliases' => [
            'copyToClipboardButton' => 'VuFind\View\Helper\Bootstrap3\CopyToClipboardButton',
            'flashmessages' => 'VuFind\View\Helper\Bootstrap3\Flashmessages',
            'highlight' => 'VuFind\View\Helper\Bootstrap3\Highlight',
            'layoutClass' => 'VuFind\View\Helper\Bootstrap3\LayoutClass',
            'search' => 'VuFind\View\Helper\Bootstrap3\Search'
        ]
    ],
    'icons' => [
        'defaultSet' => 'FontAwesome',
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
            'FontAwesome' => [
                'template' => 'font',
                'prefix' => 'fa fa-',
                'src' => 'vendor/font-awesome.min.css',
            ],
            'Collapse' => [
                'template' => 'collapse',
            ],
            /* For an example of an images set, see Bootprint's theme.config.php. */
        ],
        'aliases' => [
            /**
             * Icons can be assigned or overriden here
             *
             * Format: 'icon' => [set:]icon
             * Icons assigned without set will use the defaultSet.
             *
             * All of the items below have been specified with FontAwesome to allow
             * for a strong inheritance safety net but this is not required.
             */
            // UI
            'barcode' => 'FontAwesome:barcode',
            'bookmark' => 'FontAwesome:bookmark-o',
            'cancel' => 'FontAwesome:ban',
            'cart' => 'FontAwesome:suitcase',
            'cart-add' => 'FontAwesome:plus',
            'cart-empty' => 'FontAwesome:times',
            'cart-remove' => 'FontAwesome:minus-circle',
            'check' => 'FontAwesome:check',
            'checked-out' => 'FontAwesome:book',
            'cite' => 'FontAwesome:asterisk',
            'collapse' => 'Collapse:_', // no icon needed, uses two below
            'collapse-close' => 'FontAwesome:chevron-up',
            'collapse-open' => 'FontAwesome:chevron-down',
            'cover-replacement' => 'FontAwesome:question',
            'delete' => 'FontAwesome:trash-o',
            'dot' => 'FontAwesome:dot',
            'dropdown-caret' => 'FontAwesome:caret-down',
            'edit' => 'FontAwesome:edit',
            'email' => 'FontAwesome:envelope',
            'export' => 'FontAwesome:external-link',
            'external-link' => 'FontAwesome:external-link',
            'facet-checked' => 'FontAwesome:check-square-o',
            'facet-exclude' => 'FontAwesome:times',
            'facet-unchecked' => 'FontAwesome:square-o',
            'favorites' => 'FontAwesome:star',
            'feedback' => 'FontAwesome:envelope',
            'hold' => 'FontAwesome:flag',
            'ill-request' => 'FontAwesome:exchange',
            'loan-history' => 'FontAwesome:history',
            'menu-bars' => 'FontAwesome:bars',
            'more' => 'FontAwesome:long-arrow-right',
            'more-rtl' => 'FontAwesome:long-arrow-left',
            'my-account' => 'FontAwesome:user-circle-o',
            'notification' => 'FontAwesome:bell',
            'options' => 'FontAwesome:gear',
            'overdrive' => 'FontAwesome:download',
            'page-first' => 'FontAwesome:angle-double-left',
            'page-first-rtl' => 'FontAwesome:angle-double-right',
            'page-last' => 'FontAwesome:angle-double-right',
            'page-last-rtl' => 'FontAwesome:angle-double-left',
            'page-next' => 'FontAwesome:angle-right',
            'page-next-rtl' => 'FontAwesome:angle-left',
            'page-prev' => 'FontAwesome:angle-left',
            'page-prev-rtl' => 'FontAwesome:angle-right',
            'print' => 'FontAwesome:print',
            'profile' => 'FontAwesome:user',
            'qrcode' => 'FontAwesome:qrcode',
            'recall' => 'FontAwesome:flag',
            'remove' => 'FontAwesome:times',
            'return' => 'FontAwesome:arrow-right',
            'return-rtl' => 'FontAwesome:arrow-left',
            'rss' => 'FontAwesome:rss',
            'save' => 'FontAwesome:bookmark-o',
            'search' => 'FontAwesome:search',
            'sign-in' => 'FontAwesome:sign-in',
            'sign-out' => 'FontAwesome:sign-out',
            'sms' => 'FontAwesome:phone',
            'spinner' => 'FontAwesome:spinner fa-spin',
            'status_ready' => 'FontAwesome:bell',
            'status_pending' => 'FontAwesome:clock-o',
            'storage-retrieval' => 'FontAwesome:flag',
            'tree-context' => 'FontAwesome:sitemap',
            'ui-add' => 'FontAwesome:plus-circle',
            'ui-close' => 'FontAwesome:times',
            'ui-dots-menu' => 'FontAwesome:ellipsis-h',
            'user-list' => 'FontAwesome:star',
            'view-grid' => 'FontAwesome:th',
            'view-list' => 'FontAwesome:list',
            'warning' => 'FontAwesome:exclamation-triangle',
            // Formats (Similar items)
            'format-atlas' => 'FontAwesome:compass',
            'format-book' => 'FontAwesome:book',
            'format-braille' => 'FontAwesome:hand-o-up',
            'format-cdrom' => 'FontAwesome:laptop',
            'format-chart' => 'FontAwesome:signal',
            'format-chipcartridge' => 'FontAwesome:laptop',
            'format-collage' => 'FontAwesome:picture-o',
            'format-default' => 'FontAwesome:book',
            'format-disccartridge' => 'FontAwesome:laptop',
            'format-drawing' => 'FontAwesome:picture-o',
            'format-ebook' => 'FontAwesome:file-text-o',
            'format-electronic' => 'FontAwesome:file-archive-o',
            'format-file' => 'FontAwesome:file-o',
            'format-filmstrip' => 'FontAwesome:film',
            'format-flashcard' => 'FontAwesome:bolt',
            'format-floppydisk' => 'FontAwesome:save',
            'format-folder' => 'FontAwesome:folder',
            'format-globe' => 'FontAwesome:globe',
            'format-journal' => 'FontAwesome:file-text-o',
            'format-kit' => 'FontAwesome:briefcase',
            'format-manuscript' => 'FontAwesome:file-text-o',
            'format-map' => 'FontAwesome:compass',
            'format-microfilm' => 'FontAwesome:film',
            'format-motionpicture' => 'FontAwesome:video-camera',
            'format-musicalscore' => 'FontAwesome:music',
            'format-musicrecording' => 'FontAwesome:music',
            'format-newspaper' => 'FontAwesome:file-text-o',
            'format-online' => 'FontAwesome:laptop',
            'format-painting' => 'FontAwesome:picture-o',
            'format-photo' => 'FontAwesome:picture-o',
            'format-photonegative' => 'FontAwesome:picture-o',
            'format-physicalobject' => 'FontAwesome:archive',
            'format-print' => 'FontAwesome:picture-o',
            'format-sensorimage' => 'FontAwesome:picture-o',
            'format-serial' => 'FontAwesome:file-text-o',
            'format-slide' => 'FontAwesome:film',
            'format-software' => 'FontAwesome:laptop',
            'format-soundcassette' => 'FontAwesome:headphones',
            'format-sounddisc' => 'FontAwesome:laptop',
            'format-soundrecording' => 'FontAwesome:headphones',
            'format-tapecartridge' => 'FontAwesome:laptop',
            'format-tapecassette' => 'FontAwesome:headphones',
            'format-tapereel' => 'FontAwesome:film',
            'format-transparency' => 'FontAwesome:film',
            'format-unknown' => 'FontAwesome:question',
            'format-video' => 'FontAwesome:video-camera',
            'format-videocartridge' => 'FontAwesome:video-camera',
            'format-videocassette' => 'FontAwesome:video-camera',
            'format-videodisc' => 'FontAwesome:laptop',
            'format-videoreel' => 'FontAwesome:video-camera',
            // Currencies
            'eur' => 'FontAwesome:eur',
            'gbp' => 'FontAwesome:gbp',
            'inr' => 'FontAwesome:inr',
            'jpy' => 'FontAwesome:jpy',
            'krw' => 'FontAwesome:krw',
            'rmb' => 'FontAwesome:rmb',
            'rub' => 'FontAwesome:rub',
            'try' => 'FontAwesome:try',
            'usd' => 'FontAwesome:usd',
            'won' => 'FontAwesome:won',
            'yen' => 'FontAwesome:yen',
        ],
    ],
];
