<?php

return [
    'enabled' => (bool) env('MATOMO_ENABLE', false),
    'url'     => rtrim(env('MATOMO_URL', ''), '/').'/',
    'site_id' => (int) env('MATOMO_SITE_ID', 1),
];
