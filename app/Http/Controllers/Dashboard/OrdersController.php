<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\User;
use App\Models\Positions;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrdersController extends Controller implements CRUDInterface
{
    public function create(Request $request)
    {
        $this->validation($request);

        $order = Orders::create($request->only(['user_id', 'address']));

        if ($request->has('positions')) {
            $order->positions()->sync($request->positions);
        }

        return response()->json($order);
    }

    public function render()
    {
        $search = request()->get('search');

        if ($search) {
            $orders = Orders::where('address', 'LIKE', "%{$search}%")->get();
        } else {
            $orders = Orders::get();
        }

        $users = User::limit(10)->get();
        $positions = Positions::get();

        return response()->json([
            'items' => $orders,
            'users' => $users,
            'positions' => $positions,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validation($request);

        $order = Orders::findOrFail($id);

        $order->update($request->only(['user_id', 'address']));

        if ($request->has('positions')) {
            $order->positions()->sync($request->positions);
        }

        return response()->json($order);
    }


    public function delete($id)
    {
        $position = Orders::Find($id);

        $position->delete();
    }

    public function Validation(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|numeric|exists:users,id',
            'address' => 'required|string|max:255',
            'positions' => 'sometimes|array',
            'positions.*' => 'numeric|exists:positions,id'
        ]);
    }


    public function ExportExcel(Request $request)
    {
        return Excel::download(
            new OrdersExport(
                $request->get('dateStart'),
                $request->get('dateEnd')
            ),
            'Заказы.xlsx'
        );
    }
}
