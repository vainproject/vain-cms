<?php

return [

    'contact' >= [

        'mail' => 'payments@rising-gods.de',

    ],

    'providers' => [

        'paypal' => [],

        'paysafe' => [],

        'micropayment' => [],

        'bitcoin' => [
            'address' => '1ACGZg6BjPcYHWHxWgy519usi9Uf8x43Ms',
            'code_url' => 'https://blockchain.info/de/qr?data=1ACGZg6BjPcYHWHxWgy519usi9Uf8x43Ms&size=200'
        ],

        'giropay' => [

            // you can use :user_id for the user id
            'purpose' => 'RG Premium: :user_id',

            'bank' => [
                'name' => 'Volksbank Sauerland eG',
                'bic' => 'GENODEM1NEH',
                'code' => '46660022',
            ],

            'account' => [
                'holder' => 'Rising-Gods UG (haftungsbeschränkt)',
                'iban' => 'DE10466600223514553300',
                'number' => '3514553300',
            ],

        ],

    ],
];