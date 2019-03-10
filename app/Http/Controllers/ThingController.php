<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Thing;
use Auth;

class ThingController extends Controller
{

    public function index()
    {
        $things = Thing::paginate();
        if($things->count() === 0) return response()->json(['message'=> 'no things yet'], 404);
        return response()->json(['things'=> $things],200);
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $ext = $request->file('photo')->guessExtension();
            $filename = md5(time()).'.'.$ext;
            $request->file('photo')->move(storage_path('app/images_things'), $filename);
        }
        $thing = Thing::create([
            'name' => $request->input('name'),
            'user_id' => Auth::user()->id,
            'desc' => $request->input('desc'),
            'filename' => !empty($filename)?$filename:null
        ]);

        return response()->json(['status'=>'ok', 'thing' => $thing], 201);
    }

    public function get($id)
    {
        $thing = Thing::find($id);

        if($thing===null) return response()->json(['status'=>'bad'], 404);

        return response()->json(['status'=>'ok', 'thing'=>$thing], 200);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $thing = Thing::find($id);

        //check if owner
        if (Auth::user()->id !== $thing->user_id) return response()->json(['message' => 'not an owner of the thing'], 401);

        $thing->name = $request->input('name');
        $thing->desc = $request->input('desc');

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            //delete existing photo
            if($thing->filename !== null) unlink(storage_path('app/images_things').$thing->filename);
            $ext = $request->file('photo')->guessExtension();
            $filename = md5(time()).'.'.$ext;
            $request->file('photo')->move(storage_path('app/images_things'), $filename);
            $thing->filename = $filename;
        }

        $thing->save();

        return response()->json(['status'=>'ok', 'thing' => $thing], 200);
    }

    public function delete($id)
    {
        Thing::findOrFail($id)->delete();
        return response('Deleted successfully', 200);
    }
}
