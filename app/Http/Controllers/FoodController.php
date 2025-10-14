<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    // =======================
    // Show all foods for vendor
    // =======================
    public function index()
    {
        $foods = FoodMenu::where('user_id', Auth::id())->get();
        return view('pages.Manage_Food_Subscriptions', compact('foods'));
    }

    // =======================
    // Store new food package
    // =======================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'food_type' => 'required|in:breakfast,lunch,dinner',
            'preference' => 'required|in:veg,non_veg,both',
            'monthly_fee' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:2048',
        ]);

        // ✅ Save image if uploaded
        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('uploads/foods', 'public') 
            : null;

        // ✅ Create new food package
        FoodMenu::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'food_type' => $request->food_type,
            'preference' => $request->preference,
            'monthly_fee' => $request->monthly_fee,
            'description' => $request->description ?? null,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image_url' => $imagePath,
            'approved' => 0
        ]);

        return redirect()->back()->with('success', 'Food package added successfully!');
    }

    // =======================
    // Update existing package
    // =======================
    public function update(Request $request, $id)
    {
        $food = FoodMenu::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'food_type' => 'required|in:breakfast,lunch,dinner',
            'preference' => 'required|in:veg,non_veg,both',
            'monthly_fee' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:2048',
        ]);

        // ✅ Handle image replacement
        if ($request->hasFile('image')) {
            if ($food->image_url && Storage::disk('public')->exists($food->image_url)) {
                Storage::disk('public')->delete($food->image_url);
            }
            $food->image_url = $request->file('image')->store('uploads/foods', 'public');
        }

        // ✅ Update fields
        $food->update([
            'name' => $request->name,
            'food_type' => $request->food_type,
            'preference' => $request->preference,
            'monthly_fee' => $request->monthly_fee,
            'description' => $request->description ?? null,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image_url' => $food->image_url,
        ]);

        return redirect()->back()->with('success', 'Food package updated successfully!');
    }

    // =======================
    // Delete package
    // =======================
    public function destroy($id)
    {
        $food = FoodMenu::where('user_id', Auth::id())->findOrFail($id);

        if ($food->image_url && Storage::disk('public')->exists($food->image_url)) {
            Storage::disk('public')->delete($food->image_url);
        }

        $food->delete();

        return redirect()->back()->with('success', 'Food package deleted successfully!');
    }

    // =======================
    // Show all approved food menus to public (marketplace)
    // =======================
    public function marketplace(Request $request)
    {
        $query = FoodMenu::where('approved', 1);

        if ($request->filled('food_type')) {
            $query->whereIn('food_type', (array) $request->food_type);
        }

        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%'.$request->location.'%');
        }

        $foodMenus = $query->get();

        return view('pages.foodplans', compact('foodMenus'));
    }

    // =======================
    // Show single vendor details
    // =======================
    public function show($id)
    {
        $menu = FoodMenu::with('user')->where('menu_id', $id)->firstOrFail();

        $suggestions = FoodMenu::with('user')
            ->where('menu_id', '!=', $id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.vendor-details', compact('menu', 'suggestions'));
    }
}
