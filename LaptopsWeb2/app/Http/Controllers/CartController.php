<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Slide;

class CartController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0-9]{10}$/', // Assuming phone number is 10 digits
            'address1' => 'required|string|max:255',
            'address2' => 'required|string|max:255',
            'payment_method' => 'required|string'
        ]);

        // Process the data if validation passes
        // Save or use the data as needed
    }
    public function removeProduct($id)
    {
        $cartItem = Cart::find($id); // Tìm sản phẩm trong giỏ hàng bằng ID

        if ($cartItem) {
            $cartItem->delete(); // Xóa sản phẩm
            return response()->json(['success' => true]); // Trả về phản hồi JSON thành công
        }

        return response()->json(['success' => false], 404); // Nếu không tìm thấy, trả về 404 
    }

    // Các phương thức của controller
    public function getListCart()
    {
        $user = Auth::user();
        $slides = Slide::orderBy('updated_at', 'desc')->take(25)->get();
        if ($user) {
            $carts = Cart::with('product')->get();
            return view('user.cart.cart', compact('carts', 'user'));
        }
        return view('user.home_list.home', compact('slides')); 
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // Lấy sản phẩm theo ID
        return view('product.show', compact('product')); // Trả về view với sản phẩm
    }
    // Trong Controller của bạn
    public function showCart()
    {

        $selectedProducts = Cart::with('product')->get();

        return view('cart.index', compact('selectedProducts'));
    }
    public function deleteProductQuantity(Request $request, $productId, $full_name, $phone, $address)
    {
        // Nhận số lượng cần xóa từ yêu cầu
        $quantityToDelete = $request->input('quantity', 1); // Mặc định là 1 nếu không có giá trị

        // Lấy sản phẩm từ giỏ hàng
        $cartItem = Cart::where('id', $productId)->first();

        if ($cartItem) {
            // Lấy sản phẩm từ bảng Product dựa trên product_id từ giỏ hàng
            $product = Product::find($cartItem->product_id);


            if ($full_name || $phone || $address) {
                Order::create([
                    'category_id' => $product->id_type, // Giả định product có thuộc tính category_id
                    'product_id' => $product->id,
                    'name' => $full_name, 
                    'phone' => $phone, // Thêm thông tin khách hàng cần thiết
                    'quantity' => $cartItem->quantity,
                    'address' => $address, // Thêm địa chỉ nếu có
                    'total' => $cartItem->quantity * $product->unit_price, // Tổng giá trị (giá * số lượng)
                    'price' => $product->unit_price, // Giá của sản phẩm
                    'status' => 'approved', // Trạng thái đơn hàng mặc định
                ]);
            }

            if ($product) {
                // Giảm số lượng trong kho của sản phẩm
                if ($product->quantity >= $quantityToDelete) {
                    $product->quantity -= $quantityToDelete;
                    $product->save();
                } else {
                    return response()->json(['error' => 'Số lượng trong kho không đủ'], 400);
                }
            }

            if ($cartItem->quantity > $quantityToDelete) {
                // Giảm số lượng sản phẩm trong giỏ hàng
                $cartItem->quantity -= $quantityToDelete;
                $cartItem->save();

                return response()->json(['message' => 'Số lượng sản phẩm đã được cập nhật'], 200);
            } else {
                // Xóa sản phẩm nếu số lượng trong giỏ hàng <= số lượng cần xóa
                $cartItem->delete();

                return response()->json(['message' => 'Sản phẩm đã bị xóa khỏi giỏ hàng'], 200);
            }

        }

        return response()->json(['error' => 'Không tìm thấy sản phẩm'], 404);
    }
    public function addProductToCart(Request $request)
{
    // Validate dữ liệu đầu vào
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id', // Kiểm tra product_id tồn tại trong bảng products
        'quantity' => 'required|integer|min:1' // Số lượng phải là số nguyên và >= 1
    ]);

    // Lấy thông tin sản phẩm và người dùng
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'Bạn phải đăng nhập để thêm sản phẩm vào giỏ hàng'], 401);
    }

    // Tìm sản phẩm trong kho
    $product = Product::find($productId);

    if (!$product || $product->quantity < $quantity) {
        return response()->json(['error' => 'Sản phẩm không đủ số lượng trong kho'], 400);
    }

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng của người dùng chưa
    $cartItem = Cart::where('id', $user->id)
        ->where('product_id', $productId)
        ->first();

    if ($cartItem) {
        // Nếu đã tồn tại, tăng số lượng
        $cartItem->quantity += $quantity;
        $cartItem->save();
    } else {
        // Nếu chưa, thêm mới
        Cart::create([
            'id' => $user->id,
            'product_id' => $productId,
            'quantity' => $quantity
        ]);
    }

    // Giảm số lượng sản phẩm trong kho
    $product->quantity -= $quantity;
    $product->save();

   // return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng'], 200);
    return redirect()->route('cart.list')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
}
public function index()
{
    $products = Product::all(); // Lấy tất cả sản phẩm từ CSDL
    return view('products.index', compact('products'));
}

}
