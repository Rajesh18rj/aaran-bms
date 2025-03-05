<?php

namespace Aaran\Test\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
Use Illuminate\Foundation\Testing\Concerns\InteractsWithConsole;

uses(RefreshDatabase::class, InteractsWithConsole::class)->in('Feature', 'Unit');


test('it creates a new module when confirmed', function () {
    $this->artisan('aaran:make User --M=LMS --all')
        ->expectsConfirmation("🚀 The module 'LMS' does not exist. Do you want to create it?", 'yes')
        ->assertExitCode(0);
});
