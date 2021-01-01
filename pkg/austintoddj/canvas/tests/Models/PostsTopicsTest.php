<?php

namespace Canvas\Tests\Models;

use Canvas\Models\PostsTopics;
use Canvas\Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class PostsTopicsTest.
 *
 * @covers \Canvas\Models\PostsTopics
 */
class PostsTopicsTest extends TestCase
{
    use RefreshDatabase;

    public function testPostsRelationship(): void
    {
        $this->assertInstanceOf(BelongsTo::class, resolve(PostsTopics::class)->posts());
    }

    public function testTopicRelationship(): void
    {
        $this->assertInstanceOf(BelongsTo::class, resolve(PostsTopics::class)->topic());
    }
}
