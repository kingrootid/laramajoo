<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class AjaxController extends Controller
{
    public function category(Request $request)
    {
        if ($request->status == "add") {
            if (is_null($request->name)) {
                return ['error' => 1, 'message' => 'Failed Insert New Categories'];
            }
            $validateData = $this->validate(
                $request,
                [
                    'name' => 'required|sometimes',
                ]
            );
            if (Category::create($validateData)) {
                return ['error' => 0, 'message' => 'Success Insert New Categories'];
            } else {
                return ['error' => 1, 'message' => 'Failed Insert New Categories'];
            }
        } else if ($request->status == "edit") {
            if (is_null($request->name)) {
                return ['error' => 1, 'message' => 'Failed Update Categories'];
            }
            $validateData = $this->validate(
                $request,
                [
                    'name' => 'required|sometimes',
                ]
            );
            if (Category::where('id', $request->id)->update($validateData)) {
                return ['error' => 0, 'message' => 'Success Update Categories'];
            } else {
                return ['error' => 1, 'message' => 'Failed Update Categories'];
            }
        } else if ($request->status == "hapus") {
            if (Category::where('id', $request->id)->delete()) {
                return ['error' => 0, 'message' => 'Success Delete Categories'];
            } else {
                return ['error' => 1, 'message' => 'Failed Delete Categories'];
            }
        } else {
            return ['error' => 1, 'message' => 'Undefined Categories'];
        }
    }
    public function product(Request $request)
    {
        if ($request->status == "add") {
            $validateData = $this->validate($request, [
                'name' => 'required|unique:products',
                'categories_id' => 'required',
                'description' => 'required',
                'price' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $validateData['image'] = $fileName;
            $request->image->move(public_path('files'), $fileName);
            if (Product::create($validateData)) {
                return ['error' => 0, 'message' => 'Success Insert New Product'];
            } else {
                return ['error' => 1, 'message' => 'Failed Insert New Product'];
            }
        } else if ($request->status == "edit") {
            $validateData = $this->validate($request, [
                'name' => 'required',
                'categories_id' => 'required',
                'description' => 'required',
                'price' => 'required'
            ]);
            $product = Product::where('id', $request['id'])->first();
            if (empty($request->image)) {
                $validateData['image'] = $product['image'];
            } else {
                $validateData['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
                $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                $validateData['image'] = $fileName;
                $request->image->move(public_path('files'), $fileName);
            }
            if (Product::where('id', $request->id)->update($validateData)) {
                return ['error' => 0, 'message' => 'Success Update Product'];
            } else {
                return ['error' => 1, 'message' => 'Failed Update Product'];
            }
        } else if ($request->status == "hapus") {
            if (Product::where('id', $request->id)->delete()) {
                return ['error' => 0, 'message' => 'Success Delete Product'];
            } else {
                return ['error' => 1, 'message' => 'Failed Delete Product'];
            }
        } else {
            return ['error' => 1, 'message' => 'Undefined Action'];
        }
    }
}
