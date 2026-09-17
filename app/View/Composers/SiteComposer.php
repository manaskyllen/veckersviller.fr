<?php

namespace App\View\Composers;

use App\Models\Alert;
use Illuminate\View\View;

class SiteComposer
{
    public function compose(View $view): void
    {
        $alert = Alert::query()
            ->where('starts_at', '<=', now())
            ->where('ends_at', '>=', now())
            ->latest('starts_at')
            ->first();

        $view->with('siteAlert', $alert);
    }
}
