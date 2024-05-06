<?php

namespace App\Exports;

use App\Models\Orders;
use App\Models\Positions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;

class OrdersExport implements FromCollection, ShouldAutoSize, WithHeadings, WithProperties
{
    private $dateStart;
    private $dateEnd;

    public function __construct($dateStart, $dateEnd)
    {
        $this->dateStart = \DateTime::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
        $this->dateEnd = \DateTime::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Телефон',
            'Имя клиента',
            'Позиции',
            'Цена'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $orders = Orders::whereBetween('created_at', [$this->dateStart, $this->dateEnd])->get();

        $orders = $orders->map(function (Orders $order) {
            $order->phone = (string) $order->user->phone;
            $order->name = $order->user->name;
            $order->positionsList = $order->positions->pluck('name')->implode(', ');
            $order->total = $order->positions->sum(function (Positions $product) {
                return $product->price;
            });

            return $order->only(['phone', 'name', 'positionsList', 'total']);
        });

        return $orders;
    }

    public function properties(): array
    {
        return [
            'creator' => 'Pizza x Hunter',
            'lastModifiedBy' => 'Pizza x Hunter',
            'title' => 'Отчет по заказам',
            'company' => 'Pizza x Hunter',
        ];
    }
}
