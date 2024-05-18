<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Positions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PositionsController extends Controller implements CRUDInterface
{
    public function create(Request $request)
    {
        $this->validation($request);

        $position = Positions::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'weight' => $request->input('weight'),
            'discount' => $request->input('discount'),
        ]);
        $image = $request->file('image');
        Storage::disk('public_uploads')->putFileAs('/positions', $image, "$position->id.webp");

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

        if ($image = $request->file('image')) {
            Storage::disk('public_uploads')->putFileAs('/positions', $image, "$position->id.webp");


            $position->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'weight' => $request->input('weight'),
                'discount' => $request->input('discount'),
            ]);
        } else {
            $position->update($request->all());
        }

    }

    public function delete($id)
    {
        $position = Positions::Find($id);

        $position->delete();
    }

    public function Validation(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|mimes:webp',
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
