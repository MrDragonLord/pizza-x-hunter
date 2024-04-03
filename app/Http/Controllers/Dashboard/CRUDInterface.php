<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

interface CRUDInterface
{
    // create model
    public function create(Request $request);

    // render models to view
    public function render();

    // update model
    public function update(Request $request, $id);

    // delete model
    public function delete($id);

    //validation model
    protected function validation(Request $request);
}
