<?php
return array(
    'view_manager'=>array(
        'template_map'=>array(
            'abcd'=>'123',
        ),
    ),
    'resources'=>array(
        'ElementsInit'=>array(
            'js'=>array(
                //array('init',dirname(__FILE__).'/../view/js/init.js',false,VE_VERSION,true),

                ),
        ),
    ),
    'elements'=>array(
        'VeCore'=>array(
            'VeRow',
            'VeCol',
            'VeText',
            'VeImage',
            'VeButton',
            'VeQuote',
            'VeOrderList',
            'VeUnOrderList',
            'VeVideo',
            'VeSlider',
            'VeIcon',
            'VeForm',
            'VeFormElements',

            'VeWpRss',
            'VeWpPages',
            'VeWpCalendar',
           // 'VeTextWithHeader',
            'VeWpArchives',
            'VeWpCategories',
            'VeWpLinks',
            'VeWpMeta',
            'VeWpNavMenu',

            'VeWpRecentComments',
            'VeWpRecentPosts',

            'VeWpSearch',
            'VeWpTagCloud',
            'VeCustom',
        ),
    ),
    'features'=>array(
        'VeCore'=>array(
            'CssEditor',
            'CssAdvanced',
            'FormParse',
        )
    ),
);