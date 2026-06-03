<?php

use App\Models\User;

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('dashboard is accessible by authenticated users', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertStatus(200);
    $response->assertSee('Dashboard');
});

test('dashboard is accessible by guest users', function () {
    $response = $this->get('/dashboard');

    $response->assertStatus(200);
    $response->assertSee('Dashboard');
});


