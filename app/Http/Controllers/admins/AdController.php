<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    // REDIRECT METHODS
    public function onlySuggested()
    {
        return view('admins.ads.suggested', ['ads' => Ad::onlySuggested()->get()]);
    }

    public function onlyPublished()
    {
        return view('admins.ads.published', ['ads' => Ad::onlyPublished()->get()]);
    }

    public function onlyCancelled()
    {
        return view('admins.ads.cancelled', ['ads' => Ad::onlyCancelled()->get()]);
    }

    public function onlyHidden()
    {
        return view('admins.ads.inactive', ['ads' => Ad::onlyHidden()->get()]);
    }

    // STATUSES CHANGING METHODS
    public function confirm(Request $request)
    {
        $ad = Ad::find($request->id);
        $result = $ad->update(['status_id' => 1]);

        return $result ? back()->with(['success' => 'Объявление успешно опубликовано']) :
            back()->withErrors(['error' => 'Не удалось опубликовать объявление']);
    }

    public function cancel(Request $request)
    {
        $ad = Ad::find($request->id);
        $result = $ad->update(['status_id' => 3, 'comment' => $request->comment]);

        return $result ? back()->with(['success' => 'Объявление отклонено']) :
            back()->withErrors(['error' => 'Не удалось отклонить объявление']);
    }

    public function hide(Ad $ad)
    {
        $result = $ad->update(['status_id' => 4]);

        return $result ? back()->with(['success' => 'Объявление скрыто']) :
            back()->withErrors(['error' => 'Не удалось скрыть объявление']);
    }
}
