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
            'concealed_at' => 'Versteckt'
        ],
        'action' => [
            'confirm' => 'Bestätigen',
            'abort' => 'Abbrechen',
            'destroy' => 'Löschen',
            'edit' => 'Bearbeiten',
            'save' => 'Speichern'
        ],
        'delete' => [
            'message' => 'Willst du diesen Post wirklich löschen?',
            'success' => 'Der Post wurde erfolgreich gelöscht.',
            'error' => 'Der Post konnte nicht gelöscht werden.'
        ],
        'section' => [
            'general' => 'Allgemeine Informationen'
        ]
    ]
];