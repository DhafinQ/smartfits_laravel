<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedBackController extends Controller
{
    public function index(Request $request){
        if($request->subject){
            $feedbacks = Feedback::where('subjek','like','%'.$request->subject.'%')->get();
        }else{
            $feedbacks = Feedback::all();
        }

        return view('admin-feedbacks.index',compact('feedbacks'));
    }

    public function show(Feedback $feedback){
        return view('admin-feedbacks.show',compact('feedback'));
    }

    public function store(Request $request){
        $validate = $request->validate([
            'user_id' => 'required',
            'subjek' => 'required',
            'deskripsi' => 'required'
        ]);

        $feedback = Feedback::create([
            'user_id' => $validate['user_id'],
            'subjek' => $validate['subjek'],
            'keterangan' => $validate['deskripsi'],
            'status' => 'Pending',
        ]);

        return back()->with('status','feedback-created');
    }

    public function update(Request $request, Feedback $feedback){
        $validate = $request->validate([
            'status' => 'required',
        ]);

        $feedback->update([
            'status' => $validate['status']
        ]);

        return back()->with('status','feedback-updated');
    }
}
