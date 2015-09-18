<?php

return [
    'title' => [
        'index' => 'Blog',
        'post' => 'Blog: :name',
    ],
    'index' => 'Blog',
    'comment' => [
        'save' => [
            'error' => 'Fehler beim Speichern des Kommentars',
            'success' => 'Kommentar erfolgreich erstellt',
            'button' => 'Abschicken',
        ],
        'delete' => [
            'error' => 'Beim Löschen des Kommentars trat ein Fehler auf',
            'success' => 'Der Kommentar wurde erfolgreich gelöscht'
        ],
        'write' => 'Neuen Kommentar schreiben',
        'placeholder' => 'Hier ist Platz für deinen Kommentar...',
        'count' => ':count Kommentar bisher|:count Kommentare bisher',
        'credits' => 'geschrieben vor :time von ',
    ],
];