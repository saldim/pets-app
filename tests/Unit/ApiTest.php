<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApiTest extends TestCase
{
    public function test_creating_pet()
    {
        $response = $this->postJSON('/api/pet', ['nickname' => 'Йоко', 'phone' => '79857385136', 'full_name' => 'Иванов Иван Иванович', 'breed' => 'Лабрадор', 'age' => '3']);
        $response
            ->assertStatus(201)
            ->assertJsonPath('nickname', 'Йоко');
    }

    public function test_finding_pet()
    {
        $response = $this->json('POST', '/api/pet/find', ['phone' => '79857385136']);

        $response
            ->assertStatus(200);
    }

}
