<?php

return [
    'title' => [
        'index' => 'Blog',
        'posts' => 'Posts',
        'categories' => 'Kategorien'
    ],
    'posts' => [
        'field' => [
            'id' => '#',
            'slug' => 'Slug',
            'author' => 'Autor',
            'created_at' => 'Erstellt',
            'published_at' => 'Veröffentlicht',
            'concealed_at' => 'Versteckt',
            'category_id' => 'Kategorie',
            'keywords' => 'Schlüsselwörter',
            'description' => 'Beschreibung',
            'title' => 'Titel',
            'text' => 'Text'
        ],
        'action' => [
            'confirm' => 'Bestätigen',
            'abort' => 'Abbrechen',
            'destroy' => 'Löschen',
            'edit' => 'Bearbeiten',
            'save' => 'Speichern',
            'create' => 'Erstellen'
        ],
        'delete' => [
            'message' => 'Willst du diesen Post wirklich löschen?',
            'success' => 'Der Post wurde erfolgreich gelöscht.',
            'error' => 'Der Post konnte nicht gelöscht werden.'
        ],
        'save' => [
            'error' => 'Fehler beim Speichern des Posts.',
            'success' => 'Der Post wurde erfolgreich gespeichert.'
        ],
        'section' => [
            'general' => 'Allgemeine Informationen',
            'dates' => 'Zeitangaben'
        ],
        'title' => [
            'create' => 'Erstelle einen neuen Post'
        ]
    ]
];