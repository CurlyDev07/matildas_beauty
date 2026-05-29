<?php

namespace App\Services;

use App\InventoryMovement;
use App\InventoryStatus;
use App\WarehouseInventory;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class InventoryMovementService
{
    public function recordMovement(array $data)
    {
        return DB::transaction(function () use ($data) {
            $movement = InventoryMovement::create($data);
            $this->applyStockEffect($movement);
            return $movement;
        });
    }

    protected function applyStockEffect(InventoryMovement $movement)
    {
        $effect = optional($movement->movementType)->stock_effect ?: 'none';
        $qty = (float) $movement->quantity;
        $itemId = $movement->inventory_item_id;

        if ($qty <= 0) {
            throw new InvalidArgumentException('Quantity must be greater than zero.');
        }

        if ($effect === 'add') {
            $this->addStock($itemId, $this->defaultStatusId(), $qty);
            return;
        }

        if ($effect === 'subtract') {
            $this->removeStock($itemId, $this->defaultStatusId(), $qty);
            return;
        }

        if ($effect === 'transfer') {
            throw new InvalidArgumentException('Status transfer is not supported after movement status columns were removed.');
        }

        if ($effect === 'none') {
            return;
        }

        throw new InvalidArgumentException('Invalid stock effect.');
    }

    public function reverseMovement(InventoryMovement $movement)
    {
        $effect = optional($movement->movementType)->stock_effect ?: 'none';
        $qty = (float) $movement->quantity;
        $itemId = $movement->inventory_item_id;

        if ($qty <= 0) {
            throw new InvalidArgumentException('Quantity must be greater than zero.');
        }

        if ($effect === 'add') {
            $this->removeStock($itemId, $this->defaultStatusId(), $qty);
            return;
        }

        if ($effect === 'subtract') {
            $this->addStock($itemId, $this->defaultStatusId(), $qty);
            return;
        }

        if ($effect === 'transfer') {
            throw new InvalidArgumentException('Status transfer is not supported after movement status columns were removed.');
        }

        if ($effect === 'none') {
            return;
        }

        throw new InvalidArgumentException('Invalid stock effect.');
    }

    protected function defaultStatusId()
    {
        $status = InventoryStatus::where('slug', 'available')->first();
        if (!$status) {
            $status = InventoryStatus::orderBy('id')->first();
        }
        if (!$status) {
            throw new InvalidArgumentException('No inventory status is available for stock movement.');
        }
        return $status->id;
    }

    public function addStock($itemId, $statusId, $quantity)
    {
        $row = WarehouseInventory::firstOrCreate(
            ['inventory_item_id' => $itemId, 'inventory_status_id' => $statusId],
            ['quantity' => 0, 'reorder_level' => 0]
        );
        $row->quantity = (float) $row->quantity + (float) $quantity;
        $row->save();
    }

    public function removeStock($itemId, $statusId, $quantity)
    {
        $row = WarehouseInventory::firstOrCreate(
            ['inventory_item_id' => $itemId, 'inventory_status_id' => $statusId],
            ['quantity' => 0, 'reorder_level' => 0]
        );
        if ((float) $row->quantity < (float) $quantity) {
            throw new InvalidArgumentException('Insufficient stock.');
        }
        $row->quantity = (float) $row->quantity - (float) $quantity;
        $row->save();
    }
}
