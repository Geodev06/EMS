<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\ParamEvalQuestion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function _contruct_eval()
    {
        $questions = [];
        $parent_q = ParamEvalQuestion::where('ratable_flag', 'N')
            ->where('active_flag', 'Y')
            ->orderBy('sort_order', 'asc')
            ->get();

        foreach ($parent_q as $val) {
            $children = ParamEvalQuestion::where('ratable_flag', 'Y')
                ->where('parent_id', $val->id)  // Use $val->id to get the parent_id from the parent question
                ->where('active_flag', 'Y')
                ->orderBy('sort_order', 'asc')
                ->get();

            $questions[] = [
                'parent' => $val, // Store the parent question
                'children' => $children // Store the children questions
            ];
        }

        if (sizeof($parent_q) <= 0) {
            return [];
        }

        return $questions;
    }

    public function _send_notification($receiver_id, $message = '')
    {

        $notification = Notification::create([
            'receiver_id' => $receiver_id,
            'message' => $message,
            'created_by' => Auth::user()->id
        ]);

        if ($notification) {
            return true;
        }
        
        return false;
    }
}
