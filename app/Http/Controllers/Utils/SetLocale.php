<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetLocale extends Controller
{
    public function __invoke(Request $request,string $locale)
    {
        if(! in_array($locale,['en','bn'])) {
            return res(['message' => __('app.unsupported locale')],422);
        }

        $request->user()->updateCache(['locale' => $locale]);

        $request->user()->setLocale();

        return res(['success' => true, 'message' => __('app.language changed') ]);
    }
}
