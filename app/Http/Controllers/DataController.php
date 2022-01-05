<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function category(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Category::all())->addIndexColumn()->addColumn('action', function ($row) {
                $actionBtn = "<a class='btn btn-icon waves-effect btn-warning' href='javascript:;' onclick='edit(" . $row['id'] . ")'><i class='fa fa-edit''></i></a> ";
                $actionBtn .= "<a class='btn btn-icon waves-effect btn-danger' href='javascript:;' onclick='hapus(" . $row['id'] . ")'><i class='fa fa-trash''></i></a>";
                return $actionBtn;
            })->rawColumns(['action'])->make(true);
        }
    }
    public function getCategory($id)
    {
        return Category::where('id', $id)->get()->first()->toArray();
    }
    public function product(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Product::all())->addIndexColumn()->addColumn('category', function ($row) {
                $data = Category::where('id', $row['categories_id'])->first();
                return (empty($data) ? 'Data tidak ditemukan' : $data->toArray()['name']);
            })->editColumn('description', function ($row) {
                return nl2br(htmlspecialchars_decode($row['description']));
            })->editColumn('price', function ($row) {
                return $this->rupiah($row['price']);
            })->editColumn('image', function ($row) {
                $image_url = asset('files') . '/' . $row['image'];
                return "<img src='$image_url'>";
            })->addColumn('action', function ($row) {
                $actionBtn = "<a class='btn btn-icon waves-effect btn-warning' href='javascript:;' onclick='edit(" . $row['id'] . ")'><i class='fa fa-edit''></i></a> ";
                $actionBtn .= "<a class='btn btn-icon waves-effect btn-danger' href='javascript:;' onclick='hapus(" . $row['id'] . ")'><i class='fa fa-trash''></i></a>";
                return $actionBtn;
            })->rawColumns(['action', 'description', 'image'])->make(true);
        }
    }
    public function getProduct($id)
    {
        return Product::where('id', $id)->get()->first()->toArray();
    }
    public function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }
}
