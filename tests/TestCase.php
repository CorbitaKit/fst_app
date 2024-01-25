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
}
