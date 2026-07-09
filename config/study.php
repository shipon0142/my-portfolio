<?php

return [
    'templates' => [
        'article'    => ['label' => 'Article'],
        'tutorial'   => ['label' => 'Tutorial'],
        'cheatsheet' => ['label' => 'Cheatsheet'],
        'comparison' => ['label' => 'Comparison'],
        'qna'        => ['label' => 'Q&A'],
    ],
    'upload_disk' => env('STUDY_UPLOAD_DISK', 'public'),
    'upload_dir'  => env('STUDY_UPLOAD_DIR',  'study'),
];
