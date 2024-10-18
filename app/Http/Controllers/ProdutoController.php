<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index',  compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateProduct $request)
    {
        $data = $request->all();

        if($request->hasFile('icone') && $request->file('icone')->isValid()){
            $requestIcon = $request->icone;
            $extension = $requestIcon->extension();
            $iconNome = md5($requestIcon->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestIcon->move(public_path('img/icon'), $iconNome);
            $data['icone'] = $iconNome;
        }
        Product::create($data);
        return redirect()->route('products.view')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products')->with('error', 'Produto não encontrado!');
        }
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products')->with('error', 'Produto não encontrado!');
        }
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateProduct $request, string $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return redirect()->route('products.index')->with('error', 'Produto não encontrado.');
            }
            
            $dados = $request->all();
            
            if ($request->hasFile('icone') && $request->file('icone')->isValid()) {
                if ($product->icone && file_exists(public_path('img/icon/' . $product->icone))) {
                    unlink(public_path('img/icon/' . $product->icone));
                }
                $requestIcon = $request->icone;
                $extension = $requestIcon->extension();
                $iconNome = md5($requestIcon->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestIcon->move(public_path('img/icon'), $iconNome);
                $dados['icone'] = $iconNome;
            }
            $product->update($dados);
            return redirect()->route('products.view')->with('success', 'Produto atualizado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar excluir!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);
            if ($product->produtos()->count() > 0) {
                return redirect()->back()->with('error', 'Não é possível excluir este produto, pois existem registros vinculados a ele.');
            }
            if ($product) {
                if ($product->icone) {
                    $imagePath = public_path('img/icon/' . $product->icone);
        
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
        
                $product->delete();
        
                return redirect()->route('product.view')->with('success', 'Produto apagado com sucesso!');
            } else {
                return redirect()->route('product.view')->with('error', 'Produto não encontrado.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar excluir!');
        }
    }
}
