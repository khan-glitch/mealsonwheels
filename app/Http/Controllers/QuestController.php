<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function finish($questId)
{
    $quest = Quest::find($questId);
    
    if (!$quest) {
        return response()->json(['success' => false, 'message' => 'Quest not found.']);
    }

    $quest->status = 'Delivered';
    $quest->save();

    return response()->json(['success' => true]);
}

}