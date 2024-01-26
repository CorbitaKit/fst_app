<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JournalValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_validation_for_required_title()
    {
        $journal = $this->generateDummyDataForJournal();
        $journal['title'] = null;
        $user = $this->generateUser();

        $this->actingAs($user);

        $response = $this->postJson(route('journals.store', $journal))
            ->assertUnprocessable();

        $response->assertJsonValidationErrors(['title']);
    }

    public function test_validation_for_maximum_required_title()
    {
        $journal = $this->generateDummyDataForJournal();
        $journal['title'] = $this->generateMaximumCharacter();

        $user = $this->generateUser();
        $this->actingAs($user);

        $response = $this->postJson(route('journals.store', $journal))
            ->assertUnprocessable();

        $response->assertJsonValidationErrors(['title']);
    }
}
