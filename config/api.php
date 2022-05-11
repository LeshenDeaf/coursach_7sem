<?php

return [
    'kladr' => [
        'keys' => [
            'api_key' => '07fbd62b46521c158b3c90d24d167faaa1ecd205',
            'secret_key' => '4dd6b6a85f691e160072cfdbfc845a0f1631c861',
        ],
        'address' => [
            'suggestion' => 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address',
            'standard' => 'https://cleaner.dadata.ru/api/v1/clean/address',
        ],
    ],
    'fgis' => [
        'address' => [
            'search' => 'https://fgis.gost.ru/fundmetrology/cm/xcdb/vri/select',
            'get' => 'https://fgis.gost.ru/fundmetrology/cm/iaux/vri/'
        ]
    ],
];
