<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function setTheme(Request $request, $theme)
{
    // Check if the theme is valid
    if (in_array($theme, ['light', 'dark'])) {
        // Store the theme in session
        $request->session()->put('theme', $theme);
    }

    return redirect()->back();
}

}
