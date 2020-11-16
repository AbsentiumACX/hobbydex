<?php

namespace Tests\Feature;

use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CharacterTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_can_show_the_create_character_page ()
    {
        $user = User::factory()->create();
        $this
            ->actingAs($user)
            ->get(route('character.create'))
            ->assertStatus(200)
            ->assertSee('Name')
            ->assertSee('Generation');
    }

    /** @test */
    public function it_can_create_the_character ()
    {
        $user = User::factory()->create();
        $data = [
            'name' => $this->faker->word(),
            'generation' => 1,
        ];

        $this
            ->actingAs($user)
            ->post(route('character.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('character.index'));
    }
}
