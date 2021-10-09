<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsuarioController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('users.users', ['auth' => $user]);
    }

    public function manageUsers()
    {
        $user = null;
        return view('users.usersManage', ['user' => $user]);
    }

    public function editUsers($id)
    {
        $user = User::with('user')->find($id);
        return view('users.usersManage', ['user' => $user]);
    }

    public function create(Request $request)
    {
        try {
            
            $request->validate(["name"=>"required", "email"=>"required"]);
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return response()->json(['message' => 'Usuario creado satisfactoriamente']);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function update(Request $request){
        try {
            $request->validate(["name"=>"required", "email"=>"required"]);
            $user = User::find($request->input('id'));
            if( !is_null($request->input('name')) ){
                $user->name = $request->input('name');
            }
            if( !is_null($request->input('email')) ){
                $user->email = $request->input('email');
            }
            if( !is_null($request->input('password')) ){
                $user->password = Hash::make($request->input('password'));
            }

            $user->save();

            return response()->json(['message' => 'Usuario actualizado satisfactoriamente']);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function delete(Request $request){
        try {
            $user = User::find($request->input('id'));
            $user->delete();
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function list(Request $request){
        try {
            $listUsers = User::with('user')->orderBy('created_at', 'desc')->paginate($request->input('size'));
            return response()->json($listUsers);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function searchByParams(Request $request)
    {
        try {
            $size = $request->input('size');
            $input = $request->input('input');

            $users = User::with('user')
            ->where('name','like',"%$input%")
            ->orWhere('email','like',"%$input%")
            ->orderBy('created_at', 'desc')
            ->paginate($request->input('size'));

            return response()->json($users);
        } catch (\Exception $e) {
           throw $e;
        }
    }

  /*   public function search(Request $request){

        try {

            $dataToSearch = $request->input('search');
            $size = $request->input('size');

            $response = User::with('user')
            ->whereHas('user', function ($query) use ($dataToSearch) { $query->where('rol', 'like', '%'.$dataToSearch.'%');})
            ->orWhere('name', 'like', '%'.$dataToSearch.'%')
            ->orWhere('email', 'like', '%'.$dataToSearch.'%')
            ->orderBy('created_at', 'desc')
            ->paginate($size);
            return response()->json($response);
        } catch (\Exception $e) {
           throw $e;
        }

    } */
}
