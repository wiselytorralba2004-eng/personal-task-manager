<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_redirects_to_tasks(): void
    {
        $this->get('/')->assertRedirect('/tasks');
    }

    public function test_user_can_create_a_task(): void
    {
        $response = $this->post('/tasks', [
            'task_name' => 'Finish Laravel project',
            'description' => 'Complete CRUD functions.',
            'due_date' => '2026-09-27',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'task_name' => 'Finish Laravel project',
            'status' => 'Pending',
        ]);
    }

    public function test_user_can_update_task_status(): void
    {
        $task = Task::create([
            'task_name' => 'Study routes',
            'description' => 'Review web.php',
            'status' => 'Pending',
            'due_date' => '2026-09-28',
        ]);

        $this->patch("/tasks/{$task->id}/status", ['status' => 'Completed'])
            ->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'Completed',
        ]);
    }
}
