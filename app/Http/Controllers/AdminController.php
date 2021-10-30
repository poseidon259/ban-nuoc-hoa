<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Category;

class AdminController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            return view('admin.dashboard', compact('name'));
        }
    }

    public function product()
    {
        if (Auth::check()) {
            $data = Product::paginate(10);
            $name = Auth::user()->name;
            return view('admin.product.product', compact('name', 'data'));
        } else {
            return redirect()->intended('admin');
        }
    }

    public function editProduct($id)
    {
        $name = Auth::user()->name;
        $category = Category::all();
        if (Auth::check()) {
            $pEdit = Product::where('product_id', $id)->first();

            return view('admin.product.edit', compact('pEdit', 'name', 'category'));
        } else {
            return redirect()->intended('admin');
        }
    }
    public function updateProduct($id, Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'sale' => 'required|numeric|min:0|max:100',
                'price' => 'required|numeric|min:0:',
                'name' =>  'required',
                'description' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' //max 10mb
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'sale.numeric' => 'Sale phải là 1 số thuộc khoảng 0 - 100',
                'price.numeric' => 'Giá phải là 1 số nguyên dương',
                'min' => 'Giá trị nhỏ nhất là 0',
                'image.mimes' => 'Chỉ nhận các file có đuôi .jpeg, .jpg, .png, .gif',
                'image.max' => 'Quá dung lượng cho phép',
                'sale.max' => 'Tối đa là 100'
            ]);

            if ($request->has('image')) {
                $file = $request->image;
                $fileName = $file->getClientOriginalName();

                $oldFile = Product::where('product_id', $id)->first();
                $oldFileName = $oldFile->image;
                if (file_exists(public_path('/frontend/img/product/' . $oldFileName))) {
                    unlink(public_path('/frontend/img/product/' . $oldFileName));
                }
                $file->move(public_path('/frontend/img/product/'), $fileName);
            }
            $newData = [
                'product_name' => $request->name,
                'price' => $request->price,
                'available' => $request->available,
                'description' => $request->description,
                'category_id' => $request->categoryP,
                'gender' => $request->gender,
                'sale' => $request->sale,
                'image' => $fileName
            ];

            Product::where('product_id', $id)
                ->update($newData);

            return redirect()->intended('admin/product')->with('success', 'Sửa thông tin thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function viewInsertP()
    {
        $name = Auth::user()->name;
        $category = Category::all();
        if (Auth::check()) {

            return view('admin.product.insert', compact('name', 'category'));
        } else {
            return redirect()->intended('admin');
        }
    }

    public function insertProduct(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'sale' => 'required|numeric|min:0|max:100',
                'price' => 'required|numeric|min:0:',
                'name' =>  'required',
                'description' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' //max 10mb
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'sale.numeric' => 'Sale phải là 1 số thuộc khoảng 0 - 100',
                'price.numeric' => 'Giá phải là 1 số nguyên dương',
                'min' => 'Giá trị nhỏ nhất là 0',
                'mimes' => 'Chỉ nhận các file có đuôi .jpeg, .jpg, .png, .gif',
                'image.max' => 'Quá dung lượng cho phép',
                'sale.max' => 'Tối đa là 100'
            ]);

            if ($request->has('image')) {
                $file = $request->image;
                $fileName = $file->getClientOriginalName();

                $file->move(public_path('/frontend/img/product/'), $fileName);
            }

            $newData = new Product();
            $newData->product_name = $request->name;
            $newData->price = $request->price;
            $newData->available = $request->available;
            $newData->description = $request->description;
            $newData->category_id = $request->categoryP;
            $newData->gender = $request->gender;
            $newData->sale = $request->sale;
            $newData->image = $fileName;

            $newData->save();
            return redirect()->intended('admin/product')->with('success', 'Thêm mới thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function deleteProduct($id)
    {
        if (Auth::check()) {
            $file = Product::where('product_id', $id)->first();
            $fileName = $file->image;
            if (file_exists(public_path('/frontend/img/product/' . $fileName))) {
                unlink(public_path('/frontend/img/product/' . $fileName));
            }

            Product::where('product_id', $id)
                ->delete();
            return redirect()->intended('admin/product')->with('success', 'Xóa thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function blog()
    {
        if (Auth::check()) {
            $data = Blog::paginate(5);
            $name = Auth::user()->name;
            return view('admin.blog.blog', compact('name', 'data'));
        } else {
            return redirect()->intended('admin');
        }
    }

    public function editBlog($id)
    {
        if (Auth::check()) {
            $data = Blog::where('blog_id', $id)->first();
            $name = Auth::user()->name;
            return view('admin.blog.edit', compact('data', 'name'));
        } else {
            return redirect()->intended('admin');
        }
    }

    public function updateBlog($id, Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png,gif|max:10000',
                'description' => 'required',
                'date' => 'required|after_or_equal:today',
                'author' => 'required'
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'after_or_equal' => 'Ngày tạo phải bằng hoặc sau ngày hiện tại',
                'image.max' => 'Quá dung lượng cho phép',
                'mimes' => 'Chỉ nhận các file có đuôi .jpeg, .jpg, .png, .gif',
            ]);

            if($request->has('image')){
                $file = $request->image;
                $fileName = $file->getClientOriginalName();

                $oldFile = Blog::where('blog_id', $id)->first();
                $oldFileName = $oldFile->img;

                if (file_exists(public_path('/frontend/img/blog/' . $oldFileName))) {
                    unlink(public_path('/frontend/img/blog/' . $oldFileName));
                }

                $file->move(public_path('/frontend/img/blog/'), $fileName);
            }

            $newData = [
                'title' => $request->name,
                'img' => $fileName,
                'description' => $request->description,
                'tag' => $request->tag,
                'created_at' => $request->date,
                'author' => $request->author,
            ];

            Blog::where('blog_id', $id)
                ->update($newData);

            return redirect()->intended('admin/blog')->with('success', 'Cập nhật thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function viewInsertBlog()
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            return view('admin.blog.insert', compact('name'));
        } else {
            return redirect()->intended('admin');
        }
    }

    public function insertBlog(Request $request)
    {
        if (Auth::check()) {

            $request->validate([
                'name' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png,gif|max:10000',
                'description' => 'required',
                'date' => 'required|after_or_equal:today',
                'author' => 'required'
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'after_or_equal' => 'Ngày tạo phải bằng hoặc sau ngày hiện tại',
                'image.max' => 'Quá dung lượng cho phép',
                'mimes' => 'Chỉ nhận các file có đuôi .jpeg, .jpg, .png, .gif',
            ]);

            if($request->has('image')){
                $file = $request->image;
                $fileName = $file->getClientOriginalName();

                $file->move(public_path('/frontend/img/blog/'), $fileName);
            }
            $newData = new Blog();
            $newData->title = $request->name;
            $newData->img = $fileName;
            $newData->description = $request->description;
            $newData->tag = $request->tag;
            $newData->created_at = $request->date;

            $newData->save();

            return redirect()->intended('admin/blog')->with('success', 'Thêm mới thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function deleteBlog($id)
    {
        if (Auth::check()) {
            $file = Blog::where('blog_id', $id)->first();
            $fileName = $file->img;
            if (file_exists(public_path('/frontend/img/blog/' . $fileName))) {
                unlink(public_path('/frontend/img/blog/' . $fileName));
            }
            Blog::where('blog_id', $id)
                ->delete();

            return redirect()->intended('admin/blog')->with('success', 'Xóa thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }


    public function category()
    {
        if (Auth::check()) {
            $category = Category::paginate(10);
            $name = Auth::user()->name;
            return view('admin.category.category', compact('name', 'category'));
        } else
            return redirect()->intended('admin');
    }

    public function editCategory($id)
    {
        if (Auth::check()) {
            $data = Category::where('category_id', $id)->first();
            $name = Auth::user()->name;
            return view('admin.category.edit', compact('name', 'data'));
        } else
            return redirect()->intended('admin');
    }

    public function updateCategory($id, Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required|unique:category,category_name'
            ], [
                'name.required' => 'Không được để trống',
                'name.unique' => 'Tên danh mục đã tồn tại'
            ]);
            $newData = [
                'category_name' => $request->name
            ];

            Category::where('category_id', $id)
                ->update($newData);

            return redirect()->intended('admin/category')->with('success', 'Sửa thành công !');
        } else
            return redirect()->intended('admin');
    }

    public function viewInsertCategory()
    {
        $name = Auth::user()->name;
        if (Auth::check()) {
            return view('admin.category.insert', compact('name'));
        } else
            return redirect()->intended('admin');
    }


    public function insertCategory(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required|unique:category,category_name'
            ], [
                'name.required' => 'Không được để trống',
                'name.unique' => 'Tên danh mục đã tồn tại'
            ]);

            $newData = new Category();
            $newData->category_name = $request->name;

            $newData->save();
            return redirect()->intended('admin/category')->with('success', 'Thêm mới thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }


    public function deleteCategory($id)
    {
        if (Auth::check()) {
            $count = Category::join('product', 'product.category_id', '=', 'category.category_id')
                ->where('category.category_id', $id)->count();

            if ($count == 0) {
                Category::where('category_id', $id)
                    ->delete();
                return redirect()->intended('admin/category')->with('success', 'Xóa thành công !');
            } else {
                return redirect()->intended('admin/category')->with('error', 'Không thể xóa danh mục này !');
            }
        } else
            return redirect()->intended('admin');
    }
}
