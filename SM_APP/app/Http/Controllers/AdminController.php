<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Hashing\HashManager;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Email;

class AdminController extends Controller
{
              //Admin List

    public function list(Request $request)
    {
        $data['getRecord'] = User::getAdmin();   //for get data & and go to user model
        
        $data['header_title'] = "Admin List";
        return view('admin.admin.list',$data); 
    }


            //Admin Add

    public function add()
    {

        $data['header_title'] = "Add New Admin";
        return view('admin.admin.add',$data); 

    }


            //Admin add post



    public function insert(Request $request){
        
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success',"Admin Created Successfully");

    } 
    


                //Admin Edit 

    public function AdminEdit($id)
    {
        $data['getRecord'] = User::getSingle($id);  
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Admin";
            return view('admin.admin.edit',$data);
        }
        else
        {
            abort(404);
        }
    }

            //Admin update button

    public function AdminUpdate($id , Request $request){

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);

        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('admin/admin/list')->with('success',"Admin successfully updated");
    }




            //Admin Delete Button

    
    public function AdminDelete($id){

        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success',"Admin successfully deleted");
        
    }


     
}
