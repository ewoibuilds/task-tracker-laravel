<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_nobody_can_open_edit_change_or_delete_someone_elses_task(): void
    {
        $task = User::factory()->create()->tasks()->create(['title' => 'Private']);
        $stranger = User::factory()->create();

        $this->actingAs($stranger)->get("/tasks/{$task->id}/edit")->assertForbidden();
        $this->actingAs($stranger)->put("/tasks/{$task->id}", ['title' => 'Changed'])->assertForbidden();
        $this->actingAs($stranger)->delete("/tasks/{$task->id}")->assertForbidden();

        $this->assertSame('Private', $task->fresh()->title);
    }
}
