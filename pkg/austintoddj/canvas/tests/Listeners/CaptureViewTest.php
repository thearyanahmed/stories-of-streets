<?php

namespace Canvas\Tests\Listeners;

use Canvas\Events\PostViewed;
use Canvas\Listeners\CaptureView;
use Canvas\Models\Post;
use Canvas\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CaptureViewTest.
 *
 * @covers \Canvas\Listeners\CaptureView
 */
class CaptureViewTest extends TestCase
{
    use RefreshDatabase;

    public function testInstantiation(): void
    {
        $post = factory(Post::class)->create();

        $event = new PostViewed($post);

        $listener = new CaptureView();

        $listener->handle($event);

        $this->assertDatabaseHas('canvas_views', [
            'post_id' => $post->id,
        ]);
    }
}
