<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserConnection;
use View;
use DB;
use Auth;
use Response;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //get all user which have not in your connection
        $userid=Auth::user()->id;
        $sqlQuery = "SELECT  id,name, email
                        FROM users AS u
                        WHERE NOT EXISTS (SELECT * FROM user_connections AS f
                                          WHERE (f.user_id = u.id AND f.friend_id = ".$userid." )
                                          OR (f.user_id = ".$userid." AND f.friend_id = u.id)
                                         )
                        AND u.id <> ".$userid."";
         $suggested_users = DB::select(DB::raw($sqlQuery));  


        //get all send requests
        $send_requests   = UserConnection::with('send_rquests')->where(['user_id'=>Auth::user()->id,'status'=>'pending'])->get();
        //get all recived requests
        $recieved_requests = UserConnection::with('receive_rquests')->where(['friend_id'=>Auth::user()->id,'status'=>'pending'])->get();
        //get all connected friends
        $connected =auth()->user()->friends();
        return view('home',compact('suggested_users','send_requests','recieved_requests','connected'));
    }
     

   public function Ajax_Post(Request $request)
   {
     $data=explode(",",$request->exampleVariable);//comma separated value converted to array
     //$data[0] and $data[1] basically sender user id  and reciver user id and data[3] is function  name
     switch($data[3])
     {
        case 'sendRequest':
        $this->send_request($data);
        break;
        case 'deleteRequest':
        $this->delete_request($data);
        break;
        case 'acceptRequest':
        $this->accept_request($data);
        break;
        case 'removeConnected':
        $this->removeConnection($data);
        break;
     }
   }
    
    //send connection request
    public function send_request($data)
    {
        //$data[0] and $data[1] basically sender user id  and reciver user id
        $res=UserConnection::create(['user_id'=>$data[0],'friend_id'=>$data[1],'status'=>'pending']);
        if($res)
        {
            return Response::json(['status'=>'success']);
        }
        else{
            return Response::json(['status'=>'error']);
        }

    }
    //delte connection request
    public function delete_request($data)
    {
        //$data[0] and $data[1] basically sender user id  and reciver user id
        $res=UserConnection::where(['user_id'=>$data[0],'friend_id'=>$data[1],'send_request'=>'1','status'=>'pending'])->delete();
        if($res)
        {
            return Response::json(['status'=>'success']);
        }
        else{
            return Response::json(['status'=>'error']);
        }
    }

    //accept request
    public function accept_request($data)
    {
        //$data[0] and $data[1] basically sender user id  and reciver user id
        $res=UserConnection::where(['user_id'=>$data[1],'friend_id'=>$data[0],'status'=>'pending'])->update(['status'=>'connected']);
        if($res)
        {
            return Response::json(['status'=>'success']);
        }
        else{
            return Response::json(['status'=>'error']);
        }
    }

    //remove connections code 
    public function removeConnection($data)
    {
        //$data[0] and $data[1] basically sender user id  and reciver user id
        $res=UserConnection::where(['user_id'=>$data[0],'friend_id'=>$data[1],'status'=>'connected'])->orWhere(['user_id'=>$data[1],'friend_id'=>$data[0],'status'=>'connected'])->delete();
        if($res)
        {
            return Response::json(['status'=>'success']);
        }
        else{
            return Response::json(['status'=>'error']);
        }
    }
    
}
