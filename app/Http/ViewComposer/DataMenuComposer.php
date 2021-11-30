<?php


namespace App\Http\ViewComposer;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DataMenuComposer
{

    /**
     * @param View $view
     * @return void
     */
    public function compose (View $view) {

        $user = Auth::user();
        $view->with('user', $user);
    }

}
