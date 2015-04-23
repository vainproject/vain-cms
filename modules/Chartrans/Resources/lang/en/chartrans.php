<?php

return [
    'title' => [
        'index' => 'Character Transfer'
    ],
    'step' => [
        'num' => [
            'one' => 'Step 1',
            'two' => 'Step 2',
            'three' => 'Step 3',
            'four' => 'Step 4',
            'five' => 'Step 5',
        ],
        'description' => [
            'one' => 'Choose realm and account.',
            'two' => 'Where do you come from?',
            'three' => 'Upload your screenshots.',
            'four' => 'Select your race, class and equipment!',
            'five' => 'Check everything, nearly done...',
        ],
        'one' => [
            'caption' => 'Where to create your new character?',
            'account' => [
                'valid' => 'This account can be used.',
                'invalid' => 'This account is not qualified.'
            ]
        ],
        'two' => [
            'caption' => [
                'top' => 'Name some details of your prior server',
                'private' => 'Private server information',
                'official' => 'Retail server information'
            ],
            'field' => [
                'source_server_website' => 'Website of the server:',
                'source_server_realm' => 'Name of the source realm:',
                'source_account_name' => 'Name of the account you want to transfer from:',
                'source_character_name' => 'Name of the character you want to transfer:',
                'source_server_account_characters' => 'All characters on that account (max. 10, divided by whitespace):',
                ''
            ],
            'type' => [
                'private' => 'Private server',
                'official' => 'Official servers'
            ],
        ],
        'button' => [
            'forward' => 'Next step',
            'backwards' => 'Previous step'
        ]
    ],
    'field' => [
        'destination_realm' => 'Realm'
    ]
];