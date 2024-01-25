<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class JournalTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_if_citizen_can_create_a_journal()
    {
        $citizen = $this->generateCitizen();

        $user = $this->generateUser();
        Sanctum::actingAs($user);
        $journal = [
            'title' => 'Test Title',
            'date' => '2024-01-25',
            'content' => 'test content',
            'citizen_id' => $citizen->id
        ];

        $this->post(route('journals.store'), $journal)->assertStatus(201);

        $this->assertDatabaseHas('journals', $journal);
    }

    public function test_if_user_can_update_a_journal()
    {
        $citizen = $this->generateCitizen();

        $user = $this->generateUser();
        Sanctum::actingAs($user);

        $journal = $this->generateJournal();

        $new_journal = [
            'title' => 'New Title',
            'content' => 'New Content',
            'date' => '2024-01-26',

        ];

        $this->put(route('journals.update', $journal->id), $new_journal)->assertStatus(200);
        $this->assertDatabaseHas('journals', $new_journal);
    }

    public function test_if_user_can_delete_journal()
    {
        $journal = $this->generateJournal();
        $user = $this->generateUser();
        Sanctum::actingAs($user);

        $this->delete(route('journals.destroy', $journal->id))->assertStatus(204);
        $this->assertDatabaseMissing('journals', ['id' => $journal->id]);
    }

    public function test_if_can_fetch_a_single_journal()
    {
        $journal = $this->generateJournal();
        $user = $this->generateUser();

        Sanctum::actingAs($user);
        $response = $this->get(route('journals.show', $journal->id))->assertStatus(200);
        $response->assertJson([
            'id' => $journal->id,
            'title' => $journal->title,
            'content' => $journal->content,
            'date' => $journal->date,
            'citizen_id' => $journal->citizen_id,
        ]);
    }
}
