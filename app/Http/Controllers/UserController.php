<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getFavorites()
    {
        $user = auth()->user()->load('favorite.items');

        foreach($user->favorite as $favorite)
        {
            $items[] = [
                'item' => $favorite->items
            ];
        }

        return $items;
    }
}
