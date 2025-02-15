<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // ✅ Importação do modelo Product
use HasFactory;

class ProductController extends Controller
{
    public function index(){
        return view('product.index');
    }
    
    public function create(){
        return view('product.create');
    }

    public function store(Request $request){
        // Validação dos dados do formulário
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', 'description'=>'required'
        ]);

        // Criar um novo produto no banco de dados
        $newProduct = Product::create($data);

        // Redirecionar para a listagem de produtos
        return redirect(route('product.create'));
    }
}
