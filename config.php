<?php

return [
    'production' => false,
    'baseUrl' => '',
    'siteName' => 'viktoras.de',
    'siteAuthor' => 'Viktoras Bezaras',
    'siteUrl' => 'https://viktoras.de',
    'siteDescription' => 'Viktoras Bezaras, Engineering Manager in Leipzig. 18 years of software development, 7 years leading engineering teams, building AI-first development workflows.',
    'siteImage' => 'https://viktoras.de/img/viktoras_3.jpg',

    'collections' => [
        'posts' => [
            'extends' => '_layouts.post',
            'path' => fn ($page) => 'read/' . preg_replace('/^\d{4}-\d{2}-\d{2}-/', '', $page->getFilename()),
        ],
    ],
];
