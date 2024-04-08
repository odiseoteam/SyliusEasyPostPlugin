<?php

declare(strict_types=1);

namespace Tests\Odiseo\SyliusEasyPostPlugin\Behat\Behaviour;

interface ContainsErrorInterface
{
    public function containsError(): bool;

    public function containsErrorWithMessage(string $message, bool $strict = true): bool;
}
