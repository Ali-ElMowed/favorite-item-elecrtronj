<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use ResourceBundle;

class CategoryController extends Controller
{
    public function getAllCategories($id = null)
    {

        if ($id != null) {
            $categories = Category::find($id);
        } else {
            $categories = Category::all();
        }

        return response()->json([
            "status" => "Success",
            "categories" => $categories
        ], 200);
    }

    public function addCategory(Request $request){

        $category = new Category;

        $category -> cat_name = $request -> cat_name;
        $category -> save();

        return response() -> json([
            'status'=>'success'
        ],200);
    }

    public function updateCategory(Request $request, $id){

        $category = Category::find($id);
        if($category){

            $category -> cat_name = $request -> cat_name;
            $category->update();

            return response()->json([
                'status'=>'Updated succesfully',
            ],200);
        }else{
            return response()->json([
                'status'=>"Not found"
            ],200);
        }
    }

    public function destroyCategory($id){

        $category = Category::find($id);

        if($category){

            $category->delete();

            return response()->json([
                'status'=>"Category Deleted"
            ],200);
        }else{
            return response()->json([
                'status'=>'Not found'
            ],200);
        }
    }

    // public function getItems(Category $category){
    //     return $category->load('items');
    // }

    public function getItems($id){
        dd(auth()->user()->name);
        $category = Category::where('id',$id)->with('items')->first();

        return self::returnResponse('success',200,$category);
    }

    public function returnResponse($status,$code,$data = null)
    {
        return response()->json([
            'status'=>$status,
            'data' => $data
        ],$code);
    }
}
