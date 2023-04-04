<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    // REDIRECT TO PAGE WITH SUGGESTED ADS
    public function onlySuggested()
    {
        return view('admins.ads.suggested', ['ads' => Ad::onlySuggested()->get()]);
    }

    // REDIRECT TO PAGE WITH PUBLISHED ADS
    public function onlyPublished()
    {
        return view('admins.ads.published', ['ads' => Ad::onlyPublished()->get()]);
    }

    // REDIRECT TO PAGE WITH CANCELLED ADS
    public function onlyCancelled()
    {
        return view('admins.ads.cancelled', ['ads' => Ad::onlyCancelled()->get()]);
    }

    // PUBLISH METHOD
    public function publish(Request $request)
    {
        $ad = Ad::find($request->id);
        $result = $ad->update(['status_id' => 1]);

        return $result ? back()->with(['success' => 'Объявление успешно опубликовано']) :
            back()->withErrors(['error' => 'Не удалось опубликовать объявление']);
    }

    // CANCEL METHOD
    public function cancel(Request $request)
    {
        $ad = Ad::find($request->id);
        $result = $ad->update(['status_id' => 3, 'comment' => $request->comment]);

        return $result ? back()->with(['success' => 'Объявление отклонено']) :
            back()->withErrors(['error' => 'Не удалось отклонить объявление']);
    }

    // HIDE METHOD
    public function hide(Ad $ad)
    {
        $result = $ad->update(['status_id' => 4]);

        return $result ? back()->with(['success' => 'Объявление скрыто']) :
            back()->withErrors(['error' => 'Не удалось скрыть объявление']);
    }
}
