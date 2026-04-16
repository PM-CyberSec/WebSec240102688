<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(Request $request)
    {
        $query = Product::query();

        $query->when($request->keywords, function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->keywords . '%')
                ->orWhere('code', 'like', '%' . $request->keywords . '%');
        });

        $query->when($request->min_price, function ($q) use ($request) {
            return $q->where('price', '>=', $request->min_price);
        });

        $query->when($request->max_price, function ($q) use ($request) {
            return $q->where('price', '<=', $request->max_price);
        });

        $orderBy = $request->order_by ?? 'created_at';
        $direction = $request->order_direction ?? 'DESC';
        $query->orderBy($orderBy, $direction);

        $products = $query->paginate(12);

        return view('Products', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:255', 'unique:products,code'],
            'name' => ['required', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'photo' => ['required', 'image', 'max:4096'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'in:available,empty'],
            'description' => ['nullable', 'string'],
        ]);

        $photoName = time() . '_' . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(public_path('images'), $photoName);

        Product::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'model' => $validated['model'] ?? null,
            'photo' => $photoName,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('products.index')->with('status', 'Product added successfully.');
    }
}
