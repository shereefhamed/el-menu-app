<?php
namespace App\Contracts;

use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Support\Collection;

interface CartInterface
{
    public const ADDTOCARTERRORMESSAGE = 'You have items from another restaurant!';
    public function add(MenuItem $menuItem, array $data): array;

    public function items(): Collection;

    public function total(): float|int;

    public function count(): int;

    public function remove(string|int $id): void;

    public function clear(): void;

    public function restaurant(): Restaurant|null;

    public function update(array $data): void;
}