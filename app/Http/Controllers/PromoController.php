<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use App\Models\PromoCodeUse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PromoController extends Controller
{

    public function __invoke()
    {

        return Inertia::render('Home');
    }




    public function create()
    {
        return   Inertia::render('Create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'code' => 'required|string|unique:promo_codes,code|max:255',
        'type' => 'required|in:percentage,fixed',
        'value' => 'required|numeric|min:0',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'is_active' => 'required|boolean',
        'max_uses' => 'nullable|integer|min:1',
        'private_users' => 'nullable|json',
        'frequency' => 'nullable|in:daily,weekly',
    ]);

    $promoCode = PromoCode::create($validated);

    return response()->json([
        'message' => 'Promo code created successfully',
        'promo_code' => $promoCode,
    ]);
}



    public function edit(PromoCode $promo)
    {
        return view('promos.edit', compact('promo'));
    }

    public function update(Request $request, PromoCode $promo)
    {
        $request->validate([
            'code' => 'required|string|unique:promo_codes,code,' . $promo->id . '|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'required|boolean',
            'max_uses' => 'nullable|integer|min:1',
            'private_users' => 'nullable|array',
            'private_users.*' => 'integer|exists:users,id',
            'frequency' => 'nullable|in:daily,weekly',
        ]);

        $promo->update($request->all());

        return redirect()->route('promos.index')->with('success', 'Promo code updated successfully.');
    }

    // Удаление промокода
    public function destroy(PromoCode $promo)
    {
        $promo->delete();
        return redirect()->route('promos.index')->with('success', 'Promo code deleted successfully.');
    }

    // Активация промокода пользователем
    public function activate(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $promo = PromoCode::where('code', $request->code)->first();

        if (!$promo) {
            return back()->withErrors(['code' => 'Invalid promo code.']);
        }

        if (!$promo->is_active || $promo->isExpired() || $promo->isOverused()) {
            return back()->withErrors(['code' => 'This promo code cannot be activated.']);
        }

        if (!$promo->canBeUsedByUser(auth()->id())) {
            return back()->withErrors(['code' => 'You are not eligible to use this promo code.']);
        }

        PromoCodeUse::create([
            'promo_code_id' => $promo->id,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Promo code activated successfully!');
    }
}
