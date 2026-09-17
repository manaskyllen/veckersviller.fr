<?php

return [

    'navigation' => [
        'content' => 'Contenu',
        'documents' => 'Documents',
    ],

    'common' => [
        'created_at' => 'Créé le',
    ],

    'dashboard' => [

        'title' => 'Tableau de bord',

        'stats' => [
            'alerts' => 'Alertes',
            'alerts_description' => 'Alertes créées',

            'posts' => 'Actualités',
            'posts_description' => 'Actualités publiées',

            'documents' => 'Documents',
            'documents_description' => 'Documents disponibles',
        ],

        'recent' => [
            'posts_title' => 'Actualités récentes',
            'posts_description' => 'Les dernières actualités publiées.',

            'documents_title' => 'Documents récents',
            'documents_description' => 'Les derniers documents ajoutés.',

            'view_all' => 'Voir tout',

            'no_posts' => 'Aucune actualité.',
            'no_documents' => 'Aucun document.',
        ],
    ],

    'alerts' => [
        'navigation_label' => 'Alertes',
        'singular' => 'alerte',
        'plural' => 'alertes',

        'sections' => [
            'content' => 'Contenu',
            'schedule' => 'Période d’affichage',
        ],

        'fields' => [
            'title' => 'Titre',
            'content' => 'Contenu',
            'starts_at' => 'Début',
            'ends_at' => 'Fin',
        ],
    ],

    'posts' => [
        'navigation_label' => 'Actualités',
        'singular' => 'actualité',
        'plural' => 'actualités',

        'sections' => [
            'content' => 'Contenu',
            'images' => 'Images',
        ],

        'fields' => [
            'title' => 'Titre',
            'description' => 'Contenu',
            'published_at' => 'Date de publication',
            'images' => 'Images',
            'image' => 'Image',
            'alt_text' => 'Texte alternatif',
        ],

        'actions' => [
            'add_image' => 'Ajouter une image',
        ],
    ],

    'documents' => [
        'navigation_label' => 'Documents',
        'singular' => 'document',
        'plural' => 'documents',

        'sections' => [
            'document' => 'Document',
        ],

        'fields' => [
            'title' => 'Titre',
            'type' => 'Type',
            'document_date' => 'Date du document',
            'file' => 'Fichier',
        ],
    ],

    'document_types' => [
        'navigation_label' => 'Types de documents',
        'singular' => 'type de document',
        'plural' => 'types de documents',

        'sections' => [
            'type' => 'Type de document',
        ],

        'fields' => [
            'name' => 'Nom',
            'sort_order' => 'Ordre',
            'documents_count' => 'Nombre de documents',
        ],
    ],

];
