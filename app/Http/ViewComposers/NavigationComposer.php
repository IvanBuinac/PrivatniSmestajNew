<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 19-Jan-18
 * Time: 5:54 PM
 */
namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class NavigationComposer
{
    public function compose(view $view)
    {
        if(!Auth::check())
        {
            return;
        }

        $view->with("user_accommodations", Auth::user()->accommodations->all());
    }
}