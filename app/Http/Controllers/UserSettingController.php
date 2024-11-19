<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSettingStoreRequest;
use App\Http\Requests\UserSettingUpdateRequest;
use App\Models\UserSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserSettingController extends Controller
{
    public function index(Request $request): View
    {
        $userSettings = UserSetting::all();

        return view('userSetting.index', compact('userSettings'));
    }

    public function create(Request $request): View
    {
        return view('userSetting.create');
    }

    public function store(UserSettingStoreRequest $request): RedirectResponse
    {
        $userSetting = UserSetting::create($request->validated());

        $request->session()->flash('userSetting.id', $userSetting->id);

        return redirect()->route('userSettings.index');
    }

    public function show(Request $request, UserSetting $userSetting): View
    {
        $userSettings = UserSetting::all(); // Fetch all user settings from the database

        return view('userSetting.show', compact('userSettings'));
    }

    public function edit(Request $request, UserSetting $userSetting): View
    {
        return view('userSetting.edit', compact('userSetting'));
    }

    public function update(UserSettingUpdateRequest $request, UserSetting $userSetting): RedirectResponse
    {
        $userSetting->update($request->validated());

        $request->session()->flash('userSetting.id', $userSetting->id);

        return redirect()->route('userSettings.index');
    }

    public function destroy(Request $request, UserSetting $userSetting): RedirectResponse
    {
        $userSetting->delete();

        return redirect()->route('userSettings.index');
    }
}
