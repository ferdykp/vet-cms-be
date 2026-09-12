<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('Veterinary CMS is ready.');
})->purpose('Display a short application message');
