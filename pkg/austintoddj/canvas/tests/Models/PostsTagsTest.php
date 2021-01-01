<?php

namespace Canvas\Tests\Models;

use Canvas\Models\PostsTags;
use Canvas\Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class PostsTagsTest.
 *
 * @covers \Canvas\Models\PostsTags
 */
class PostsTagsTest extends TestCase
{
    use RefreshDatabase;

    public function testPostsRelationship(): void
    {
        $this->assertInstanceOf(BelongsTo::class, resolve(PostsTags::class)->posts());
    }

    public function testTagsRelationship(): void
    {
        $this->assertInstanceOf(BelongsTo::class, resolve(PostsTags::class)->tags());
    }
}
