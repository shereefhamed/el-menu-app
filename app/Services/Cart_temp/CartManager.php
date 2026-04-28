<?php
namespace App\Services\Cart;

use App\Contracts\CartInterface;
use App\Models\Restaurant;
use Illuminate\Support\Collection;

class CartManager implements CartInterface
{
    public function __construct(
        protected SessionCartService $sessionCart,
        protected DatabaseCartService $databaseCart
    ) {
    }

    protected function driver(): CartInterface
    {
        return auth()->check()
            ? $this->databaseCart
            : $this->sessionCart;
    }

    public function add($menuItem, array $data): array
    {
        return $this->driver()->add($menuItem, $data);
    }

    public function items(): Collection
    {
        return $this->driver()->items();
    }

    public function total(): float|int
    {
        return $this->driver()->total();
    }

    public function count(): int
    {
        return $this->driver()->count();
    }

    public function remove(string|int $id): void
    {
        $this->driver()->remove($id);
    }

    public function clear(): void
    {
        $this->driver()->clear();
    }

    public function restaurant(): Restaurant|null
    {
        return $this->driver()->restaurant();
    }

    public function update(array $data): void
    {
        $this->driver()->update($data);
    }


}