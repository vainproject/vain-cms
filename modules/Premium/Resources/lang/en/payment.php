<?php

return [
    'bitcoin' => [
        'title' => 'Payment via Bitcoin',
        'note' => 'Since this digital currency has spread out more and more and is also fully anonymous, we now offer payment via Bitcoin.',
        'pay' => [
            'address' => 'Just pay directly to these Bitcoin address:',
            'code' => 'Or, scan the same address as a QR code:',
        ],
        'support' => [
            'introduction' => 'A small Bitcoin introduction: :url',
            'wallet' => 'And a online wallet with deposit option: :url',
        ],
        'here' => 'Here',
    ],
    'giropay' => [
        'title' => 'Payment via direct debit',
        'note' => 'Please use this payment only when no other method is possible, since it means a significant working overhead for us. Thank You. The assignment of payments is done by hand, so it can possibly take a while.',
        'address' => 'Billing address',
        'purpose' => 'Purpose',
        'bank' => [
            'bank' => 'Bank',
            'code' => 'Bank code',
            'bic' => 'BIC',
        ],
        'account' => [
            'holder' => 'Account holder',
            'number' => 'Account number',
            'iban' => 'IBAN',
        ],
    ],
    'micropay' => [

    ],
    'paypal' => [

    ],
    'paysafe' => [
        'title' => 'Payment via PaySafe Card',
    ],
];