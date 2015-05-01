<?php
/**
 * no hesitation, those information are either accessible
 * for anyone anyway or they are sandbox only
 */
return [

    'contact' >= [

        'mail' => 'payments@rising-gods.de',

    ],

    'providers' => [

        /**
         * PAYPAL PAYMENT PROVIDER
         */
        'paypal' => [
            'enabled' => true,

            'client_id' => 'AQCxoxAXMrMMOmmyp1VXUdLsGUGihivaU-XlPwmr6yJ7QtNrayLsFPo9wfkG',
            'client_secret' => 'EAyNxxAFP7aIrP1S_GskVhc7z03DI65IAo-Q_SGmURzfuZZIHNojVkOZeR3i',

            // ipn response url
            'ipn' => [
                'sandbox' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
                'live' => 'https://www.paypal.com/cgi-bin/webscr'
            ],

            // native paypal config options
            'settings' => [
                'mode' => 'sandbox',

                'log' => [
                    'LogEnabled' => true,
                    'FileName' => storage_path('logs/paypal-'. date('Y-m-d') .'.log'),
                    'LogLevel' => 'FINE'
                ],
            ],
        ],

        /**
         * PAYSAFE PAYMENT PROVIDER
         */
        'paysafe' => [
            'enabled' => true,

            'endpoint' => 'https://cashpay.cashrun.com/risinggods/psc/psc_start.php',
        ],

        /**
         * MICROPAYMENT PAYMENT PROVIDER
         */
        'micropayment' => [
            'enabled' => true,
        ],

        /**
         * BITCOIN PAYMENT PROVIDER
         */
        'bitcoin' => [
            'enabled' => true,

            'address' => '1ACGZg6BjPcYHWHxWgy519usi9Uf8x43Ms',
            'code_url' => 'https://blockchain.info/de/qr?data=1ACGZg6BjPcYHWHxWgy519usi9Uf8x43Ms&size=200'
        ],

        /**
         * DIRECT DEBIT PAYMENT PROVIDER
         */
        'giropay' => [
            'enabled' => true,

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