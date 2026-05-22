<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [

    //  Laravel doesn't need this to come from .env unless you want to override it.
    'inertia' => false,

    'meta' => [
        'defaults' => [
            'title'        => 'Sunhour Group Co., Ltd', // set false to total remove
            'titleBefore'  => false, // "Page Title | Sunhour Group Co., Ltd"
            'description'  => 'Explore premium Water Purifier, Water Purified ,Water Pump, Water Filter Cambodia, Tiles Cambodia, Building Material, Accessories Cambodia,Toto bathroom, Water Filter Cambodia, Heat Pump, Toto faucet, Water Dispenser Cambodia, Water Machine Cambodia,Toto faucet,Heat Pump,Water Dispenser Cambodia,Water Filter Cambodia, Water Heating System, ការ៉ូ, ក្បាលរូមីណេ, ម៉ូទ័របូមទឹក and more in Cambodia with Sunhour Group Co., Ltd.',
            'separator'    => ' | ', // Result: Water Purifier Cambodia | Sunhour Group Co., Ltd
        'keywords' => [

            // Water Systems
            'Water Purifier',
            'Water Purifier Cambodia',
            'Water Purification',
            'Water Filter',
            'Water Filter Cambodia',
            'Water Dispenser',
            'Water Dispenser Cambodia',
            'Water Heater',
            'Water Heater Cambodia',
            'Water Heating System',
            'Storage Water Heater',
            'Water Pump',
            'Water Pump Cambodia',
            'Water Transfer',
            'Water System Cambodia',
            'Heat Pump',
            'Heat Pump Cambodia',

            // Brands
            'PurePro',
            'PurePro Cambodia',
            'TOTO Cambodia',

            // Bathroom
            'TOTO Bathroom',
            'TOTO Bathroom Cambodia',
            'TOTO Faucet',
            'TOTO Faucet Cambodia',
            'TOTO Bathtub',
            'Bathtub Cambodia',
            'Home Shower',
            'Home Shower Cambodia',
            'Bathroom Accessories Cambodia',

            // Building Materials
            'Tiles Cambodia',
            'Building Material Cambodia',

            // Khmer Keywords
            'សម្ភារក្នុងបន្ទប់ទឹក',
            'គ្រឿងប្រើប្រាស់ក្នុងបន្ទប់ទឹក',
            'ម៉ាស៊ីនបូមទឹក',
            'ម៉ូទ័របូមទឹក',
            'ម៉ាស៊ីនទឹកក្តៅទឹកត្រជាក់',
            'បង្គន់អនាម័យ',
            'ការ៉ូ',
            'ក្បាលរូមីណេ',

        ],
            // 'canonical'    => null, // Uses current URL
            'canonical' => env('APP_URL'),
            'robots'       => 'index, follow', // Allows indexing by search engines
        ],

        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],

    'opengraph' => [
        'defaults' => [
            'title'       => 'Sunhour Group Co., Ltd',
            'description' => 'Premium water and home systems in Cambodia from Sunhour Group Co., Ltd.',
            'url'         => null, // Uses current URL
            'type'        => 'website',
            'site_name'   => 'Sunhour Group Co., Ltd',
            'images'      => [
                'url'    => 'https://sunhourgroup.com.kh/?en/neorestcollections/images/p_mainv_sp.jpg', // ✅ Update with your actual OG image path
            ],
        ],
    ],

    'twitter' => [
        'defaults' => [
            'card' => 'summary_large_image',
            'site' => '@SunHourGroup', // ✅ Update if you have a Twitter handle
        ],
    ],

    'json-ld' => [
        'defaults' => [
            'title'       => 'Sunhour Group Co., Ltd',
            'description' => 'Explore water pumps, solar water, filters, and more from Sunhour Group Co., Ltd in Cambodia.',
            'url'         => null,
            'type'        => 'WebPage',
            'images'      => [
               'url'    => 'https://sunhourgroup.com.kh/?en/neorestcollections/images/p_mainv_sp.jpg', // ✅ Update with your actual OG image path
            ],
        ],
    ],
];



// 'keywords'     => [
//                 'Water Purifier',
//                 'Water Purified',
//                 'Water Dispenser Cambodia',
//                 'Water Heater Cambodia',
//                 'Water Heating System',
//                 'Ariston Cambodia',
//                 'Water Transfer Cambodia',
//                 'Water Transfer',
//                 'Water Filter Cambodia',
//                 'Purepro',
//                 'Purepro Cambodia',
//                 'Toilet Cambodia',
//                 'Faucet Cambodia',
//                 'Heat Pump',
//                 'Heat Pump Cambodia',
//                 'Tiles Phnom Penh',
//                 'Tiles Cambodia',
//                 'Home Shower Cambodia',
//                 'Solar Water Cambodia',
//                 'Bathtub Cambodia',
//                 'Storage Water Cambodia',
//                 'Accessories Cambodia',
//                 'Transfer Pump Cambodia',
//                 'Home Drinking Water Cambodia',
//                 'Water System Cambodia',
//                 'Console',
//                 'Toto Cambodia',
//                 'Bathroom Cambodia',
//                 'Toto bathroom',
//                 'Toto faucet',
//                 'Toto brand',
//                 'Building Material',
//                 'Bathroom Equipment',
//                 'សម្ភារក្នុងបន្ទប់ទឹក',
//                 'Water Heating System',
//                 'Handrail Cambodia',
//                 'គ្រឿងប្រើប្រ្រស់ក្នុងបន្ទប់ទឹក',
//                 'ម៉្រសុីនបូមទឹក',
//                 'ការ៉ូ',
//                 'ក្បាលរូមីណេ',
//                 'ម៉៉ាស៊ីនទឺកក្ដៅទឹកត្រជាក់',
//                 'ម៉ូទ័របូមទឹក',
//                 'បង្គន់អនាម័យ'
//             ],
