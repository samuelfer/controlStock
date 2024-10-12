<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index',  compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCategory $request)
    {
        $data = $request->all();

        if($request->hasFile('icone') && $request->file('icone')->isValid()){
            $requestIcon = $request->icone;
            $extension = $requestIcon->extension();
            $iconNome = md5($requestIcon->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestIcon->move(public_path('img/icon'), $iconNome);
            $data['icone'] = $iconNome;
        }
        Category::create($data);
        return redirect()->route('categories.view')->with('success', 'Categoria criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('categories')->with('error', 'Categoria não encontrada!');
        }
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('categories')->with('error', 'Categoria não encontrada!');
        }
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCategory $request, string $id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return redirect()->route('categories.index')->with('error', 'Categoria não encontrada.');
            }
            
            $dados = $request->all();
            
            if ($request->hasFile('icone') && $request->file('icone')->isValid()) {
                if ($category->icone && file_exists(public_path('img/icon/' . $category->icone))) {
                    unlink(public_path('img/icon/' . $category->icone));
                }
                $requestIcon = $request->icone;
                $extension = $requestIcon->extension();
                $iconNome = md5($requestIcon->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestIcon->move(public_path('img/icon'), $iconNome);
                $dados['icone'] = $iconNome;
            }
            $category->update($dados);
            return redirect()->route('categories.view')->with('success', 'Categoria atualizada com sucesso!');
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
            $category = Category::find($id);
            if ($category->produtos()->count() > 0) {
                return redirect()->back()->with('error', 'Não é possível excluir esta categoria, pois existem produtos vinculados a ela.');
            }
            if ($category) {
                if ($category->icone) {
                    $imagePath = public_path('img/icon/' . $category->icone);
        
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
        
                $category->delete();
        
                return redirect()->route('categories.view')->with('success', 'Categoria apagada com sucesso!');
            } else {
                return redirect()->route('categories.view')->with('error', 'Categoria não encontrada.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar excluir!');
        }
    }
}
