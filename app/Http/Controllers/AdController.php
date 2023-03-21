<?php

namespace App\Http\Controllers;

use App\Models\Ad;

class AdController extends Controller
{
    // INDEX METHODS
    public function index()
    {
        return view('index');
    }

    public function preCreate()
    {
        return view('ads.preCreate');
    }

    // ADMIN PANEL METHODS
    public function onlySuggested()
    {
        return view('admins.ads.suggested', ['ads' => Ad::onlySuggested()]);
    }

    public function onlyPublished()
    {
        return view('admins.ads.published', ['ads' => Ad::onlyPublished()]);
    }
    public function onlyInactive()
    {
        return view('admins.ads.inactive', ['ads' => Ad::onlyInactive()]);
    }

    // STATUSES METHODS
    public function confirm(Ad $ad)
    {
        $result = $ad->update(['status_id' => 1]);

        return $result ? back()->with(['success' => 'Объявление успешно опубликовано']) :
            back()->withErrors(['error' => 'Не удалось опубликовать объявление']);
    }

    public function cancel(Ad $ad)
    {
        $result = $ad->update(['status_id' => 3]);

        return $result ? back()->with(['success' => 'Объявление отклонено']) :
            back()->withErrors(['error' => 'Не удалось отклонить объявление']);
    }

    public function inactive(Ad $ad)
    {
        $result = $ad->update(['status_id' => 4]);

        return $result ? back()->with(['success' => 'Объявление скрыто']) :
            back()->withErrors(['error' => 'Не удалось скрыть объявление']);
    }
}
