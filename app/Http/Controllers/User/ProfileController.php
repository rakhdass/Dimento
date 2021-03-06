<?php

namespace App\Http\Controllers\User;

use App\Models\Task\Task;
use App\Models\User\Follow;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function checkNotifications(){
        $notifications = auth()->user()->notifications;
        $count = 0;
        foreach ($notifications as $notification){
            if ($notification->pivot->read == 0){
                $count++;
                $notification->pivot->read = 1;
                $notification->pivot->save();
            }
        }

        return $count;
    }

    public function getNotifications(){
        $notifications = auth()->user()->notifications;
        foreach ($notifications as $notification){
            if ($notification->pivot->read == 0){
                $notification->pivot->read = 1;
                $notification->pivot->save();
            }
        }
        return view('user.notifications', ['notifications' => $notifications]);
    }

    public function follow(Request $request){
        $user = User::findOrFail($request->id);
        $followCheck = Follow::where('follower_id', auth()->user()->id)
            ->where('following_id', $user->id)
            ->get();

        if (count($followCheck)){

            Follow::where('follower_id', auth()->user()->id)
                ->where('following_id', $user->id)
                ->delete();
            $status = 0;
        }
        else{
            $follow = new Follow;
            $follow->follower_id = auth()->user()->id;
            $follow->following_id = $user->id;
            $follow->save();
            $status = 1;
        }

        return ['status' => $status, 'msg' => 'Done!'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        return "user lisr";
        $users = User::paginate(20);

//        dd($users);
        return view('user.index', ['users' => $users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasks = Task::all();
        $user = User::findOrFail($id);
//        return $user;
        return view('user.view', ['user'=>$user, 'tasks'=>$tasks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        User::where('id', $id)
            ->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'phone'=>$request->phone,
                'phone_privacy'=>$request->phone_privacy,
                'dob'=>$request->dob,
                'email'=>$request->email,
                'email_privacy'=>$request->email_privacy,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (auth()->user()->type == 4){
            $user = User::findOrFail($id);
            $user->forceDelete();
            return redirect()->to('/user');
        }

    }
}
