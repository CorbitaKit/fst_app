<?php

namespace Tests;

use App\Models\Citizen;
use App\Models\User;
use App\Models\Journal;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function generateCitizen(): Citizen
    {
        return Citizen::factory()->create();
    }

    public function generateUser(): User
    {
        return User::factory()->create();
    }

    public function generateJournal(): Journal
    {
        return Journal::factory()->create();
    }

    public function generateDummyDataForJournal(): array
    {
        $citizen = $this->generateCitizen();
        return [
            'title' => 'Test Title',
            'content' => 'Sample Content',
            'date' => '2024-01-26',
            'citizen_id' => $citizen->id
        ];
    }

    public function generateMaximumCharacter(): string
    {
        return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
    }
}
