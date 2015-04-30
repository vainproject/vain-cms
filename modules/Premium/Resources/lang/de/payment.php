<?php

return [
    'bitcoin' => [
        'title' => 'Zahlung via Bitcoin',
        'note' => 'Da sich diese digitale Währung inzwischen weiter verbreitet hat und vollkomen anonym ist bieten wir ab sofort auch Zahlungen per Bitcoin an.',
        'pay' => [
            'address' => 'Zahlt einfach direkt an diese Bitcoin Adresse:',
            'code' => 'Oder die selbe Adresse als QR-Code zum abscannen:',
        ],
        'support' => [
            'introduction' => 'Eine kleine Bitcoin Einführung: :url',
            'wallet' => 'Und ein online-Wallet mit direkter Einzahlungsoption: :url',
        ],
        'here' => 'Hier',
    ],
    'giropay' => [
        'title' => 'Zahlung via Elektronischem Lastschriftverfahren',
        'note' => 'Bitte nutze diesen Zahlungsweg nur, wenn kein anderes Verfahren möglich ist, da es für uns erheblichen Mehraufwand bedeutet. Danke. Die Zuordnung der Zahlungen erfolgt von Hand, kann also u.U. eine Weile dauern.',
        'address' => 'Rechnungsadresse',
        'purpose' => 'Verwendungszweck',
        'bank' => [
            'name' => 'Bank',
            'code' => 'Bankleitzahl',
            'bic' => 'BIC',
        ],
        'account' => [
            'holder' => 'Kontoinhaber',
            'number' => 'Kontonummer',
            'iban' => 'IBAN',
        ],
    ],
    'micropay' => [
        'title' => 'Zahlung via Micropayment',
    ],
    'paypal' => [
        'title' => 'Zahlung via PayPal',
    ],
    'paysafe' => [
        'title' => 'Zahlung via PaySafe Card',
    ],
];