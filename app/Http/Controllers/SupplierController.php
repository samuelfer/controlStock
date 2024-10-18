<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupplier;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index',  compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSupplier $request)
    {
        $data = $request->all();

        if($request->hasFile('icone') && $request->file('icone')->isValid()){
            $requestIcon = $request->icone;
            $extension = $requestIcon->extension();
            $iconNome = md5($requestIcon->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestIcon->move(public_path('img/icon'), $iconNome);
            $data['icone'] = $iconNome;
        }
        Supplier::create($data);
        return redirect()->route('suppliers.view')->with('success', 'Fornecedor criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $supplier = Supplier::find($id);
        if (!$supplier) {
            return redirect()->route('suppliers')->with('error', 'Fornecedor não encontrado!');
        }
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return redirect()->route('suppliers')->with('error', 'Fornecedor não encontrado!');
        }
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSupplier $request, string $id)
    {
        try {
            $supplier = Supplier::find($id);
            if (!$supplier) {
                return redirect()->route('suppliers.index')->with('error', 'Fornecedor não encontrado.');
            }
            
            $dados = $request->all();
            
            if ($request->hasFile('icone') && $request->file('icone')->isValid()) {
                if ($supplier->icone && file_exists(public_path('img/icon/' . $supplier->icone))) {
                    unlink(public_path('img/icon/' . $supplier->icone));
                }
                $requestIcon = $request->icone;
                $extension = $requestIcon->extension();
                $iconNome = md5($requestIcon->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestIcon->move(public_path('img/icon'), $iconNome);
                $dados['icone'] = $iconNome;
            }
            $supplier->update($dados);
            return redirect()->route('suppliers.view')->with('success', 'Categoria atualizada com sucesso!');
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
            $supplier = Supplier::find($id);
            if ($supplier->produtos()->count() > 0) {
                return redirect()->back()->with('error', 'Não é possível excluir este fornecedor, pois existem registros vinculados a ele.');
            }
            if ($supplier) {
                if ($supplier->icone) {
                    $imagePath = public_path('img/icon/' . $supplier->icone);
        
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
        
                $supplier->delete();
        
                return redirect()->route('suppliers.view')->with('success', 'Fornecedor apagado com sucesso!');
            } else {
                return redirect()->route('suppliers.view')->with('error', 'Fornecedor não encontrado.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar excluir!');
        }
    }
}
