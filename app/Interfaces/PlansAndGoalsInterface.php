<?php

namespace App\Interfaces;

interface PlansAndGoalsInterface
{

    public function markAsComplete(int $id): void;

    public function doCreate(array $data): void;

    public function doUpdate(array $data, int $id): void;

    public function doDelete(int $id): void;
}
