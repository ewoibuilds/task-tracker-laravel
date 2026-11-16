<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_list_shows_only_my_tasks(): void
    {
        $me = User::factory()->create();
        $me->tasks()->create(['title' => 'My task']);
        User::factory()->create()->tasks()->create(['title' => 'Someone else\'s task']);

        $this->actingAs($me)->get('/tasks')
            ->assertOk()
            ->assertSee('My task')
            ->assertDontSee('Someone else');
    }

    public function test_a_task_needs_a_title(): void
    {
        $this->actingAs(User::factory()->create())
            ->post('/tasks', ['title' => ''])
            ->assertSessionHasErrors('title');

        $this->assertDatabaseCount('tasks', 0);
    }

    public function test_titles_are_escaped_when_shown(): void
    {
        $me = User::factory()->create();
        $me->tasks()->create(['title' => '<script>alert(1)</script>']);

        $this->actingAs($me)->get('/tasks')->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_i_can_edit_update_and_delete_my_own_task(): void
    {
        $me = User::factory()->create();
        $task = $me->tasks()->create(['title' => 'Draft']);

        $this->actingAs($me)->get("/tasks/{$task->id}/edit")->assertOk()->assertSee('Draft');
        $this->actingAs($me)->put("/tasks/{$task->id}", ['title' => 'Final'])->assertRedirect('/tasks');
        $this->assertSame('Final', $task->fresh()->title);

        $this->actingAs($me)->delete("/tasks/{$task->id}")->assertRedirect('/tasks');
        $this->assertDatabaseCount('tasks', 0);
    }
}
