<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_sent_to_sign_in(): void
    {
        $this->get('/tasks')->assertRedirect('/login');
    }

    public function test_a_user_can_add_a_task(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/tasks', ['title' => 'Learn policies'])->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', ['title' => 'Learn policies', 'user_id' => $user->id]);
    }

    public function test_nobody_can_edit_someone_elses_task(): void
    {
        $owner = User::factory()->create();
        $task = $owner->tasks()->create(['title' => 'Private']);

        $this->actingAs(User::factory()->create())
            ->put("/tasks/{$task->id}", ['title' => 'Hacked'])
            ->assertForbidden();

        $this->assertSame('Private', $task->fresh()->title);
    }

    public function test_a_task_can_be_marked_done_and_back(): void
    {
        $user = User::factory()->create();
        $task = $user->tasks()->create(['title' => 'Write tests']);

        $this->actingAs($user)->patch("/tasks/{$task->id}/done")->assertRedirect('/tasks');
        $this->assertNotNull($task->fresh()->done_at);

        $this->actingAs($user)->patch("/tasks/{$task->id}/done")->assertRedirect('/tasks');
        $this->assertNull($task->fresh()->done_at);
    }

    public function test_nobody_can_mark_someone_elses_task_done(): void
    {
        $task = User::factory()->create()->tasks()->create(['title' => 'Private']);

        $this->actingAs(User::factory()->create())->patch("/tasks/{$task->id}/done")->assertForbidden();

        $this->assertNull($task->fresh()->done_at);
    }
}
