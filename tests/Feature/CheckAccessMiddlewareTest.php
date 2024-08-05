<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class CheckAccessMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_allows_access_for_valid_user()
    {
        $user = User::factory()->create([
            'email' => 'valid@student.ifnmg',
            'acesso_id' => 3,
        ]);

        Auth::login($user);

        $response = $this->get('/home'); // Substitua pela rota correta

        $response->assertStatus(200);
    }

    /** @test */
    public function it_denies_access_for_invalid_user()
    {
        $user = User::factory()->create([
            'email' => 'invalid@example.com',
            'acesso_id' => 1,
        ]);

        Auth::login($user);

        $response = $this->get('/alunos'); // Substitua pela rota correta

        $response->assertStatus(403); // Para denegar acesso, deve retornar 403
    }
}

