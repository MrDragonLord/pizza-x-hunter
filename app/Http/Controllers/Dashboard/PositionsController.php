<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Positions;
use Illuminate\Http\Request;

class PositionsController extends Controller implements CRUDInterface
{
    public function create(Request $request)
    {
        $this->validation($request);

        $position = Positions::create($request->all());

        return response()->json($position);
    }

    public function render()
    {
        $search = request()->get('search');

        if ($search) {
            $positions = Positions::where('name', 'LIKE', "%{$search}%")->get();
        } else {
            $positions = Positions::get();
        }

        return response()->json([
            'items' => $positions,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validation($request);

        $position = Positions::find($id);

        $position->update($request->all());
    }

    public function delete($id)
    {
        $position = Positions::Find($id);

        $position->delete();
    }

    public function Validation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'price' => 'required|numeric|min:1',
            'weight' => 'required|numeric|min:1',
            'discount' => 'numeric|min:0|max:100'
        ]);
    }


    public function ExportExcel(Request $request)
    {

    }
}
