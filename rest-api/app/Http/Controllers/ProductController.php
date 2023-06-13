<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // mengambil data
    public function index(){
        $product = Product::all();

        return response()->json([
            "message" => "Product berhasil diambil",
            "code" => 200,
            "data" => $product
        ]); 
    }

    // mengambil data by id
    public function show($id){
        $product = Product::find($id);

        return response()->json([
            "message" => "Product berhasil diambil",
            "code" => 200,
            "data" => $product
        ]); 
    }

    // menambah data
    public function store(Request $request){
        $data = $request->validate([
            'nama' => 'required',
            'desc' => 'required',
            'foto' => 'image|max:2048',
            'harga' => 'required|numeric',
        ]);

        if($request->hasFile('foto')){
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['foto'] = $imageName;
        }

        $product = Product::create($data);

        return response()->json([
            "message" => "Product berhasil ditambah",
            "code" => 200,
            "data" => $product
        ]); 
    }

    // update data
    public function edit(Request $request, $id){
        $data = $request->validate([
            'nama' => 'required',
            'desc' => 'required',
            'foto' => 'image|max:2048',
            'harga' => 'required|numeric',
        ]);

        if($request->hasFile('foto')){
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['foto'] = $imageName;
        }

        $product = Product::find($id);
        $product->nama = $data['nama'];
        $product->desc = $data['desc'];
        $product->foto = $data['foto'];
        $product->harga = $data['harga'];

        $product->save();

        return response()->json([
            "message" => "Product berhasil diedit",
            "code" => 200,
            "data" => $product
        ]); 
    }

    // hapus data
    public function delete($id){
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            "message" => "Product berhasil dihapus",
            "code" => 200,
        ]); 
    }

    // tampilkan gambar
    public function image($filename){
        $path = public_path("images",$filename);

        if(!file_exists($path)){
            abort(404);
        }

        $file = file_get_contents($path);
        $type = mime_content_type($path);

        return response($file)->header('Content-Type', $type);
    }
}
