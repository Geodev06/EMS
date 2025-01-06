<?php

namespace App\Livewire;

use App\Models\Notification as Notif;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Notification extends Component
{

    #[On('seen')]
    public function seen($id)
    {
        Notif::find($id)->update(['seen_flag' => 1]);
    }

    public function render()
    {
        $notifications = Notif::where('receiver_id', Auth::user()->id)->where('seen_flag', 0)->get();

        $unread_count = 0;

        if (count($notifications) > 0) {
            foreach ($notifications as $i => $v) {
                if ($v['seen_flag'] == 0) {
                    $unread_count += 1;
                }
            }
        }
        return view('livewire.notification', compact('notifications', 'unread_count'));
    }
}
