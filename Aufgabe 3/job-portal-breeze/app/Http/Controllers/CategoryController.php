<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $categories = Category::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);

        return view('categories.index', compact('categories', 'search'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        if (Auth::id() !== 1) {
            return redirect()->route('categories.index')->with('error', 'You are not authorized');
        }
        return view('categories.create');
    }

    public function store(Request $request)
    {
        if (Auth::id() !== 1) {
            return redirect()->route('categories.index')->with('error', 'You are not authorized');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories,name',
        ]);

        $category = Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        if (Auth::id() !== 1) {
            return redirect()->route('categories.index')->with('error', 'You are not authorized');
        }

        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::id() !== 1) {
            return redirect()->route('categories.index')->with('error', 'You are not authorized');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }
}
