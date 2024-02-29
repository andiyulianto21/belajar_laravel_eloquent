<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertTrue;

class CommentModelTest extends TestCase
{
    public function test_insert(): void
    {
        $comment = new Comment([
            'email' => 'andi@gmail.com',
            'title' => 'Review',
            'comment' => 'kasflsfjasjfkasf',
        ]);

        $result = $comment->save();
        assertTrue($result);
        assertNotNull($comment->id);
    }

    public function test_default_value(): void
    {
        $comment = new Comment([
            'email' => 'andi@gmail.com',
        ]);

        $result = $comment->save();
        assertTrue($result);
        assertNotNull($comment->id);
        assertEquals('default title', $comment->title);
        assertEquals('default comment', $comment->comment);
    }

    public function test_create_method(): void
    {
        $requests = [
            'email' => 'andi@gmail.com',
            'title' => 'Title review',
        ];

        $result = Comment::query()->create($requests);
        assertNotNull($result->id);
        assertNotNull($result->title);
        assertEquals('default comment', $result->comment);
    }
}
