<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request, $productId)
    {
    //     // Kiểm tra người dùng đã đăng nhập hay chưa
    // if (!Auth::check()) {
    //     return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm vào wishlist.');
    // }
        $userId = auth()->id();
    
        // Kiểm tra sản phẩm đã tồn tại trong wishlist chưa
        $wishlistItem = Wishlist::where('user_id', $userId)
                                ->where('product_id', $productId)
                                ->first();
    
        if ($wishlistItem) {
            // Nếu đã tồn tại, xóa sản phẩm khỏi wishlist
            $wishlistItem->delete();
            $isWishlist = false;
        } else {
            // Nếu chưa tồn tại, thêm sản phẩm vào wishlist
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
            $isWishlist = true;
        }
    
        // Cập nhật tổng số lượng wishlist
        $wishlistCount = Wishlist::where('user_id', $userId)->count();
    
        // Lưu trạng thái vào session
        session(["wishlist_{$productId}" => $isWishlist]);
        session(['wishlist_count' => $wishlistCount]);
    
        return response()->json([
            'isWishlist' => $isWishlist,
            'wishlistCount' => $wishlistCount,
        ]);
    }
    
    

    public function removeFromWishlist($productId)
{
    $user = auth()->user();

    // Tìm sản phẩm trong wishlist của người dùng
    $wishlist = $user->wishlists()->where('product_id', $productId)->first();

    if ($wishlist) {
        // Xóa sản phẩm khỏi wishlist
        $wishlist->delete();
    }

    // Cập nhật trạng thái sản phẩm trong session (đặt lại thành false)
    Session::put("wishlist_{$productId}", false);

    // Cập nhật số lượng sản phẩm trong wishlist (để hiển thị ở vị trí khác, nếu cần)
    $wishlistCount = Wishlist::where('user_id', $user->id)->count();
    Session::put('wishlist_count', $wishlistCount);

    return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi wishlist');
}

public function showWishlist()
{
    $user = auth()->user();
    $products = $user->wishlists()->with('product')->get()->pluck('product');
    
    return view('wishlish.index', compact('products'));
}


}
