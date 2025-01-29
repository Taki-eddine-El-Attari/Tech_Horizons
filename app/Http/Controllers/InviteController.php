<?php

namespace App\Http\Controllers;

use App\Models\Theme;

class InviteController
{
    public function indexInvite()
    {
        $themes = Theme::select('name', 'Description' ,'image' , 'created_at')->get();
        return view('Invite.index' , compact('themes'));
    }

    
}
