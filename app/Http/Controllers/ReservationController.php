<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Thing;
use App\Reservation;
use Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{

    public function insert($thing_id, Request $request)
    {
        $start = Carbon::parse($request->input('start'));
        $end = Carbon::parse($request->input('end'));
        if($end < $start) return response('End earlier than start', 409);
        $thing = Thing::with('reservations')->findOrFail($thing_id);
        //check the existing reservations
        if($thing->reservations->count() > 0) {
            foreach ($thing->reservations as $value) {
                //if start inside
                if($start >= $value->start && $start <= $value->end) return response('Start overlapping', 409);
                //if end inside
                if($end >= $value->start && $end <= $value->end) return response('End overlapping', 409);
            }
        }

        //add the reservation
        $reservation = Reservation::create([
            'user_id' => Auth::user()->id,
            'thing_id'=>$thing_id,
            'start' => $start,
            'end' => $end,
            'status' => 'proposed'
        ]);
        return response()->json(['status'=>'ok', 'reservation' => $reservation], 201);
    }

    public function update($id, Request $request)
    {
        $reservation = Reservation::with('thing')->find($id);
        $status = $request->input('status');
        //if user_id === reservations.user_id
        //can cancel
        if(
            Auth::user()->id === $reservation->user_id &&
            $status !== 'canceled'
        ) return response('once reservation done, user can only cancel', 403);

        if(
            Auth::user()->id === $reservation->user_id &&
            $status !== 'canceled'
        ) return response('once reservation done, user can only cancel', 403);

        //if user_id === thing.user_id
        //can accept or reject
        if (
            Auth::user()->id === $reservation->thing->id &&
            ($status === 'proposed' || $status === 'canceled')
        ) return response('you can only accept or reject', 403);

        $reservation->status = $status;
        $reservation->save();

        return response()->json(['message' => 'ok', 'reservation' => $reservation]);
    }
}
