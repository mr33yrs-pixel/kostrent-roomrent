<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the home page with hero content from settings.
     */
    public function home(): View
    {
        $slides = Setting::getByKey('hero_slides', []);
        
        if (empty($slides)) {
            // Default slide if no settings exist
            $slides = [[
                'title' => Setting::getByKey('home_hero_title', __('messages.home.hero_title_1')),
                'highlight' => Setting::getByKey('home_hero_title_highlight', __('messages.home.hero_title_2')),
                'description' => Setting::getByKey('home_hero_description', __('messages.home.hero_description')),
                'image' => Setting::getByKey('home_hero_image'),
            ]];
        }

        return view('home', compact('slides'));
    }

    /**
     * Display the contact page.
     */
    public function contact(): View
    {
        return view('contact');
    }

    /**
     * Switch the application locale.
     * Locale is validated at route level to only allow 'en' or 'id'.
     */
    public function switchLanguage(string $locale): RedirectResponse
    {
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
