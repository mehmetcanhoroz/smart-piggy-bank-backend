<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
//            sleep(3);
            $users = User::withCount(['transactions', 'coins'])->orderBy('id', 'desc')->get();
            return $users;
        }
        $users = User::with(['transactions', 'coins'])->get();
        return view('pages.users')->with(['users' => $users]);
    }

    public function detail(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        return view('pages.edit_user')->with(['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $tempUser = $user = User::where('id', $id)->first();

        $user->name = $request->get('name');

        if ($request->get('password')) {
            $user->password = encrypt($request->password);
        }

        if ($request->get('parent')) {
            $user->is_parent = true;
        } else {
            if ($tempUser->is_parent && User::where('is_parent', 1)->get()->count() == 1) {
            } else {
                $user->is_parent = false;
            }
        }
        $user->save();
        return redirect(route('dashboard.users.index'))->with(['message' => 'User has been updated!']);
    }

    public function delete($id)
    {
        //dd($request);
        $user = null;
        //if (Auth::user()->is_parent) {
        $user = User::find($id);
        //} else {
        //return response(['message' => 'You don\'t have permission to delete user!'], 403);
        //}
        if ($user) {
            if (User::where('is_parent', 1)->get()->count() == 1)
                if ($user->is_parent)
                    return response(['message' => 'The last parent user can\'t be deleted!'], 403);
                else {
                    $user->delete();
                    return response(['message' => 'User and related data deleted successfully!'], 200);
                }
        } else {
            return response(['message' => 'User couldn\'t find, so not deleted!'], 404);
        }

    }

    public function test()
    {
        return DB::table("transactions")
            ->select(DB::raw("weekday(created_at) as day_transaction"), DB::raw("(COUNT(*)) as total_transaction"))
            ->orderBy('day_transaction')
            ->groupBy('day_transaction')
            ->get();
    }
}
