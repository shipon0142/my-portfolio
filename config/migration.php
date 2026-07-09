<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Migration Endpoint Token
    |--------------------------------------------------------------------------
    |
    | Shared secret required by the /api/system/migrate endpoint. Callers must
    | send this value as a Bearer token in the Authorization header. Keep this
    | in sync between the production .env and the GitHub Actions secret
    | MIGRATION_ENDPOINT_TOKEN.
    |
    */

    'token' => env('MIGRATION_ENDPOINT_TOKEN'),

];
