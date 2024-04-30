<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller implements CRUDInterface
{
    public function create(Request $request)
    {
        $this->validation($request);

        $orders = Orders::create($request->all());

        return response()->json($orders);
    }

    public function render()
    {
        $search = request()->get('search');

        if ($search) {
            $orders = Orders::where('address', 'LIKE', "%{$search}%")->get();
        } else {
            $orders = Orders::get();
        }

        $orders = $orders->map();

        return response()->json([
            'items' => $orders,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validation($request);

        $position = Orders::find($id);

        $position->update($request->all());
    }

    public function delete($id)
    {
        $position = Orders::Find($id);

        $position->delete();
    }

    public function Validation(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|numeric',
            'address' => 'required|',
        ]);
    }


    public function ExportExcel(Request $request)
    {

    }
}
