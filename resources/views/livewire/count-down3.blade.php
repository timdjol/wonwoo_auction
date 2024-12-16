<div wire:poll.1s>
    @php
        $or = \App\Models\Order::where('user_id', 9993)->exists();
            if($or != true){
                \App\Models\Order::create([
                    'user_id' => 9993,
                    'date' => now()->format('Y-m-d H:i')
                ]);
                $last = \App\Models\Order::where('user_id', 9993)->orderBy('created_at', 'DESC')->first();
                $ord = now()->subSecond(20)->diffInSeconds($last->created_at);
            } else {
             $ord = now()->subSecond(20)->diffInSeconds($order->created_at ?? now());
            }
            if($ord == 0){
                redirect()->route('pause3');
            }
            if($ord > 20){
                    $ord = 20;
                    redirect()->route('pause3');
                }

    @endphp
    <div id="clock" class="alert alert-danger">
        <span id="seconds">{{ $ord }}</span>
    </div>
</div>
