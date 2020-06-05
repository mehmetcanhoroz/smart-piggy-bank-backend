<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $lists = Wishlist::orderByDesc('id')->get();
        if ($request->wantsJson()) {
            return response()->json($lists, 200);
        }
        return view('pages.wishlists')->with(['wishlists' => $lists]);
    }

    public function createShow()
    {
        return view('pages.create_wishlists');
    }

    public function store(Request $request)
    {
        $wish = new Wishlist();

        $wish->name = $request->get('name');
        $wish->goal = $request->get('goal');
        $wish->priority = $request->get('priority');
        $wish->save();

        return redirect(route('dashboard.wishlists.index'))->with('message', 'Wishlist is created!');
    }

    public function delete($id)
    {
        $list = Wishlist::find($id);

        if ($list) {
            $list->delete();
            return response(['message' => 'Wishlist were deleted successfully!'], 200);
        } else {
            return response(['message' => 'Wishlist couldn\'t find, so not deleted!'], 404);
        }
    }
}
