<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
class ItemController extends Controller
{
    public function getAllItems($id = null)
    {

        if ($id != null) {
            $items = Item::find($id);
        } else {
            $items = Item::all();
        }

        return response()->json([
            "status" => "Success",
            "items" => $items
        ], 200);
    }


}
