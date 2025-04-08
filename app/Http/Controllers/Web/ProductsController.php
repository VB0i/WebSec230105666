<?php
namespace App\Http\Controllers\Web;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\BoughtProduct;

class ProductsController extends Controller {

	use ValidatesRequests;

	public function __construct()
    {
        $this->middleware('auth:web')->except('list');
    }

	public function list(Request $request) {

		$query = Product::select("products.*");

		$query->when($request->keywords, 
		fn($q)=> $q->where("name", "like", "%$request->keywords%"));

		$query->when($request->min_price, 
		fn($q)=> $q->where("price", ">=", $request->min_price));
		
		$query->when($request->max_price, fn($q)=> 
		$q->where("price", "<=", $request->max_price));
		
		$query->when($request->order_by, 
		fn($q)=> $q->orderBy($request->order_by, $request->order_direction??"ASC"));

		$products = $query->get();

		return view('products.list', compact('products'));
	}

	public function edit(Request $request, Product $product = null) {

		if(!auth()->user()) return redirect('/');

		$product = $product??new Product();

		return view('products.edit', compact('product'));
	}

	public function save(Request $request, Product $product = null) {

		$this->validate($request, [
	        'code' => ['required', 'string', 'max:32'],
	        'name' => ['required', 'string', 'max:128'],
	        'model' => ['required', 'string', 'max:256'],
	        'description' => ['required', 'string', 'max:1024'],
	        'price' => ['required', 'numeric'],
	        'photo' => ['required', 'string', 'max:256'],
	        'quantity' => ['required', 'integer', 'min:0'],
	    ]);

		$product = $product??new Product();
		$product->fill($request->all());
		$product->save();

		return redirect()->route('products_list');
	}

	public function delete(Request $request, Product $product) {

		if(!auth()->user()->hasPermissionTo('delete_products')) abort(401);

		$product->delete();

		return redirect()->route('products_list');
	}
	public function buy(Request $request, Product $product)
	{
		$user = auth()->user();
	
		if (!$user) {
			return redirect('/login');
		}
	
		// Check if the product is in stock
		if ($product->quantity < 1) {
			return back()->with('error', 'Product is out of stock.');
		}
	
		// Check if the user has enough credit
		if ($user->credit < $product->price) {
			return back()->with('error', 'Insufficient credit.');
		}
	
		try {
			// Deduct credit from the user
			$user->credit -= $product->price;
			$user->save();
	
			// Reduce product stock
			$product->quantity -= 1;
			$product->save();
	
			// Create an entry in the bought_products table using Eloquent (no DB facade)
			BoughtProduct::create([
				'user_id' => $user->id,
				'product_id' => $product->id,
				'product_name' => $product->name, // Save the product name
				'product_price' => $product->price, // Save the product price
				'created_at' => now(), // Store the purchase date
			]);
	
			return back()->with('success', 'Product purchased successfully.');
		} catch (\Exception $e) {
			// Log the error (optional)
			\Log::error('Purchase failed: ' . $e->getMessage());
	
			return back()->with('error', 'An error occurred while processing your purchase.');
		}
	}
	

	public function history()
{
    $user = auth()->user();

    // Get all purchases (bought products) with product data
    $purchases = BoughtProduct::where('user_id', $user->id)
        ->with(['product']) // eager load the product relationship
        ->orderBy('created_at', 'desc')
        ->get();

    return view('products.history', compact('purchases'));
}




} 