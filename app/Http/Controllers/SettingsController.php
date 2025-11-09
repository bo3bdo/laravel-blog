<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsRequest;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        $this->authorize('viewAny', Setting::class);

        $settings = [
            'site_name' => Setting::get('site_name', config('app.name', 'Blog')),
            'site_description' => Setting::get('site_description', 'A clean and simple blog'),
            'home_title' => Setting::get('home_title', 'Blog Posts'),
            'home_description' => Setting::get('home_description', 'Discover our latest articles and insights'),
            'footer_text' => Setting::get('footer_text', 'Powered by Laravel & Tailwind CSS'),
        ];

        return view('settings.index', compact('settings'));
    }

    public function update(UpdateSettingsRequest $request): RedirectResponse
    {
        $this->authorize('update', Setting::class);

        $validated = $request->validated();

        Setting::set('site_name', $validated['site_name'], 'string', 'Site name displayed in header and title');
        Setting::set('site_description', $validated['site_description'], 'text', 'Site meta description');
        Setting::set('home_title', $validated['home_title'], 'string', 'Home page title');
        Setting::set('home_description', $validated['home_description'], 'text', 'Home page description');
        Setting::set('footer_text', $validated['footer_text'], 'text', 'Footer text');

        Setting::clearCache();

        return redirect()->route('settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
