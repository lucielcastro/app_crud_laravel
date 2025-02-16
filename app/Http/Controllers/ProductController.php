<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // ✅ Importação do modelo Product
use HasFactory;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('product.index', ['products' => $products]);
    }
    
    public function create(){
    
        return view('product.create');
    }
 
    public function store(Request $request){
        // Validação dos dados do formulário
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', 'description'=>'nullable'
        ]);

        // Criar um novo produto no banco de dados
        $newProduct = Product::create($data);

        // Redirecionar para a listagem de produtos
        return redirect(route('product.index'));
    }
    public function edit(Product $product){
        return view('product.edit', ['product' => $product]);

    }
    public function update(Product $product, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', 'description'=>'nullable'
        ]);
        $product->update($data);
        return redirect(route('product.index'))->with('success', 'Product update succesffully');

    }
}
