<?php

namespace Aaran\Common\Tests;

use Aaran\Common\Models\Common;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CommonTest extends TestCase
{
    use DatabaseMigrations;

    public function test_bank_table(): void
    {
        $common = Common::factory()->create();

        $obj = Common::find($common->id);

        $this->assertEquals($common->vname, actual: $obj->vname);
        $this->assertEquals($common->active_id, actual: $obj->active_id);
    }
}
