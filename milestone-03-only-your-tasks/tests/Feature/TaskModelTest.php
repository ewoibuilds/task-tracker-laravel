<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_many_tasks_and_each_task_knows_its_user(): void
    {
        $user = User::factory()->create();
        $task = $user->tasks()->create(['title' => 'Learn relationships']);

        $this->assertTrue($task->user->is($user));
        $this->assertCount(1, $user->tasks);
        $this->assertNull($task->done_at);
    }

    public function test_user_id_cannot_be_mass_assigned(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();

        $task = $owner->tasks()->create(['title' => 'Mine', 'user_id' => $other->id]);

        $this->assertSame($owner->id, $task->user_id);
    }

    public function test_deleting_a_user_deletes_their_tasks(): void
    {
        $user = User::factory()->create();
        $user->tasks()->create(['title' => 'Temporary']);

        $user->delete();

        $this->assertSame(0, Task::count());
    }
}
