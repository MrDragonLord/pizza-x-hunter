<?php

namespace App\Exports;

use App\Models\Orders;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    private $dateStart;
    private $dateEnd;

    public function __construct($dateStart, $dateEnd)
    {
        $this->dateStart = date($dateStart);
        $this->dateEnd = date($dateEnd);
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Orders::whereBetween('created_at', [$this->dateStart, $this->dateEnd])->get();
    }
}
