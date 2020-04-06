<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $lists = Wishlist::all();
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
}
