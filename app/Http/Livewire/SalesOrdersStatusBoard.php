<?php

namespace App\Http\Livewire;

use App\SalesOrder;
use Asantibanez\LivewireStatusBoard\LivewireStatusBoard;
use Illuminate\Support\Collection;

class SalesOrdersStatusBoard extends LivewireStatusBoard
{
    public function statuses() : Collection
    {
        return collect([
            [
                'id' => 'registered',
                'title' => 'Registered',
            ],
            [
                'id' => 'awaiting_confirmation',
                'title' => 'Awaiting Confirmation',
            ],
            [
                'id' => 'won',
                'title' => 'Won',
            ],
            [
                'id' => 'delivered',
                'title' => 'Delivered',
            ],
            [
                'id' => 'lost',
                'title' => 'Lost',
            ],
        ]);
    }

    public function records() : Collection
    {
        return SalesOrder::orderBy('order')
            ->get()
            ->map(function (SalesOrder $salesOrder) {
                return [
                    'id' => $salesOrder->id,
                    'title' => $salesOrder->client,
                    'status' => $salesOrder->status,
                ];
            });
    }

    public function onStatusSorted($dataId, $statusId, $orderedIds)
    {
        $this->updateSalesOrdersOrder($orderedIds);
    }

    public function onStatusChanged($dataId, $statusId, $fromOrderedIds, $toOrderedIds)
    {
        $salesOrder = SalesOrder::find($dataId);
        $salesOrder->status = $statusId;
        $salesOrder->save();

        $this->updateSalesOrdersOrder($fromOrderedIds);
        $this->updateSalesOrdersOrder($toOrderedIds);
    }

    public function updateSalesOrdersOrder($orderedIds)
    {
        $order = 0;

        collect($orderedIds)
            ->map(function ($id) {
                return SalesOrder::find($id);
            })
            ->map(function (SalesOrder $salesOrder) use (&$order) {
                $order++;
                $salesOrder->order = $order;
                $salesOrder->save();

                return $salesOrder;
            });
    }
}
