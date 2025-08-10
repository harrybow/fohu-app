<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FestivalController extends Controller
{
    public function index(): View
    {
        $festivals = Festival::all();

        return view('admin.festivals.index', compact('festivals'));
    }

    public function create(): View
    {
        return view('admin.festivals.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'year' => ['required', 'integer'],
        ]);

        Festival::create($data);

        return redirect()->route('admin.festivals.index');
    }

    public function show(Festival $festival): View
    {
        return view('admin.festivals.show', compact('festival'));
    }

    public function edit(Festival $festival): View
    {
        return view('admin.festivals.edit', compact('festival'));
    }

    public function update(Request $request, Festival $festival): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'year' => ['required', 'integer'],
        ]);

        $festival->update($data);

        return redirect()->route('admin.festivals.index');
    }

    public function destroy(Festival $festival): RedirectResponse
    {
        $festival->delete();

        return redirect()->route('admin.festivals.index');
    }
}
