<?php

namespace App\Http\Livewire;

use App\SalesOrder;
use Asantibanez\LivewireStatusBoard\LivewireStatusBoard;
use Illuminate\Support\Collection;

class SalesOrdersStatusBoard extends LivewireStatusBoard
{
    public $searchTerm = '';

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
                'id' => 'confirmed',
                'title' => 'Confirmed',
            ],
            [
                'id' => 'delivered',
                'title' => 'Delivered',
            ],
        ]);
    }

    public function records() : Collection
    {
        return SalesOrder::query()
            ->where('client', 'like', "%{$this->searchTerm}%")
            ->orderBy('order')
            ->get()
            ->map(function (SalesOrder $salesOrder) {
                return [
                    'id' => $salesOrder->id,
                    'title' => $salesOrder->client,
                    'client' => $salesOrder->client,
                    'total' => $salesOrder->total,
                    'status' => $salesOrder->status,
                ];
            });
    }

    public function styles()
    {
        $baseStyles = parent::styles();

        $baseStyles['wrapper'] = 'w-full flex space-x-4 overflow-x-auto';

        $baseStyles['statusWrapper'] = 'flex-1';

        $baseStyles['status'] = 'bg-gray-200 rounded px-2 flex flex-col flex-1';

        $baseStyles['record'] = 'shadow bg-white p-2 rounded border text-sm text-gray-800';

        $baseStyles['statusRecords'] = 'space-y-2 px-1 pt-2 pb-2';

        $baseStyles['statusHeader'] = 'text-sm font-medium py-2 text-gray-700';

        $baseStyles['ghost'] = 'bg-gray-400';

        return $baseStyles;
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

    public function addSalesOrder()
    {
        factory(SalesOrder::class)->create();
    }

    public function withdrawOffer($recordId)
    {
        SalesOrder::find($recordId)->delete();
    }

    public function updateSalesOrdersOrder($orderedIds)
    {
        collect($orderedIds)
            ->each(function ($id, $index) {
                return SalesOrder::find($id)->update([
                    'order' => $index,
                ]);
            });
    }
}
