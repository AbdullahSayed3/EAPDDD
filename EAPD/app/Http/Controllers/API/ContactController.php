<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'message_type'=>'required',
            'message'=>'required|string'
        ]);
        try{

          $data = $request->only('name','email','message_type','message');
          $message =  ContactUs::create($data);
          return response()->json([
                'status' => true,
                'message' => 'Message Sent successfully',
                'data' => [
                    'name'=>$message->name,
                    'email'=>$message->email,
                    'message_type'=>$message->message_type,
                    'message'=>$message->message
                ]
            ],200);
        }catch(Exception $e)
        {
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage(),
                'data'=>null
            ],500);
        }
    }
}
