<?php

namespace Canvas\Tests\Http\Controllers;

use Canvas\Tests\TestCase;

/**
 * Class HomeControllerTest.
 *
 * @covers \Canvas\Http\Controllers\HomeController
 */
class HomeControllerTest extends TestCase
{
    /** @test */
    public function testScriptVariables(): void
    {
        $this->withoutMix();

        $this->actingAs($this->admin, 'canvas')
             ->get(config('canvas.path'))
             ->assertSuccessful()
             ->assertViewIs('canvas::layout')
             ->assertViewHas('config')
             ->assertSee('canvas');
    }
}
