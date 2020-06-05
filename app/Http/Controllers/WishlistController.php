<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $lists = Wishlist::all();
        if ($request->wantsJson()) {
            return response()->json($lists, 200);
        }
        return view('pages.wishlists')->with(['wishlists' => $lists]);
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

    public function store(Request $request)
    {
        $list = new Wishlist();
        $list->name = $request->get('name');
        $list->goal = $request->get('goal');
        $list->priority = $request->get('priority');
        $list->save();

        return response(['message' => 'Wishlist are created successfully!'], 200);
    }
}
