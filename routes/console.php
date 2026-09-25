<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('Small steps become finished projects.');
})->purpose('Display a simple inspirational message');
