<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testTaskCreation()
    {
        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'Test description',
        ]);
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }
}
