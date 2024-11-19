<?php

namespace App\Http\Controllers;

use App\Http\Requests\WratsUserApplicationHistoryStoreRequest;
use App\Http\Requests\WratsUserApplicationHistoryUpdateRequest;
use App\Models\WratsUserApplicationHistory;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WratsUserApplicationHistoryController extends Controller
{
    public function index(Request $request): View
    {
        $wratsUserApplicationHistories = WratsUserApplicationHistory::all();

        return view('wratsUserApplicationHistory.index', compact('wratsUserApplicationHistories'));
    }

    public function create(Request $request): View
    {
        return view('wratsUserApplicationHistory.create');
    }

    public function store(WratsUserApplicationHistoryStoreRequest $request): RedirectResponse
    {
        $wratsUserApplicationHistory = WratsUserApplicationHistory::create($request->validated());

        $request->session()->flash('wratsUserApplicationHistory.id', $wratsUserApplicationHistory->id);

        return redirect()->route('wratsUserApplicationHistories.index');
    }

    public function show(Request $request, WratsUserApplicationHistory $wratsUserApplicationHistory): View
    {
        //get all history items in descending order by created_at timestamp
        $wratsUserApplicationHistories = WratsUserApplicationHistory::orderBy('created_at', 'desc')->get();

        //Group items by date
        $groupedItems = [];
        foreach ($wratsUserApplicationHistories as $record) {
            $date = Carbon::parse($record->created_at)->toDateString();
            $groupedItems[$date][] = $record;
        }

        //pass groupedItems to view
        return view('wratsUserApplicationHistory.show', ['groupedItems' => $groupedItems]);

    }

    public function edit(Request $request, WratsUserApplicationHistory $wratsUserApplicationHistory): View
    {
        return view('wratsUserApplicationHistory.edit', compact('wratsUserApplicationHistory'));
    }

    public function update(WratsUserApplicationHistoryUpdateRequest $request, WratsUserApplicationHistory $wratsUserApplicationHistory): RedirectResponse
    {
        $wratsUserApplicationHistory->update($request->validated());

        $request->session()->flash('wratsUserApplicationHistory.id', $wratsUserApplicationHistory->id);

        return redirect()->route('wratsUserApplicationHistories.index');
    }

    public function destroy(Request $request, WratsUserApplicationHistory $wratsUserApplicationHistory): RedirectResponse
    {
        $wratsUserApplicationHistory->delete();

        return redirect()->route('wratsUserApplicationHistories.index');
    }
}
