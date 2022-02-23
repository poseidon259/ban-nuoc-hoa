<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use App\Models\Input;
use App\Models\InputDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class AdminController extends Controller
{
    //
    public function sendMail(Request $request) {
        if(Auth::check()) {
            $data = Order::find($request->id);
            $newMail = new SendMail($data);

            Mail::to($data->email)->send($newMail);
            if(count(Mail::failures()) > 0) {
                return redirect()->intended('admin/order')->with('error', 'Đã có lỗi !! Không thể gửi !!');
            }
            $updateData = [
                'status' => 1
            ];

            Order::where('id', $request->id)
                ->update($updateData);
            return redirect()->intended('admin/order')->with('success', 'Email đã được gửi đến địa chỉ '.$data->email);
        } else {
            return redirect('admin/login');
        }
    }
    public function index()
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            $doanhthungay = 0;
            $doanhthuthang = 0;
            $dataNgay = Order::join('order_detail', 'order_id', '=', 'id')
                        ->where('status', 1)
                        ->where('created_at','=' ,date('Y-m-d'))
                        ->get();
            foreach ($dataNgay as $value) {
                $doanhthungay += $value->price * $value->quantity;
            }

            $dataThang = Order::join('order_detail', 'order_id', '=', 'id')
                        ->where('status', 1)
                        ->whereMonth('created_at','=' ,date('m'))
                        ->get();
            foreach ($dataThang as $value) {
                $doanhthuthang += $value->price * $value->quantity;
            }

            $donchoxacnhan = Order::where('status', 0)->count();
            $dangvanchuyen = Order::where('status', 1)->count();
            
            $doanhthunam = [];
            for($i = 0; $i < 12; $i++) {
                $temp =Order::join('order_detail', 'order_id', '=', 'id')
                        ->where('status', 1)
                        ->whereMonth('created_at','=' ,$i+1)
                        ->get();
                $doanhthutemp = 0;
                foreach ($temp as $value) {
                    $doanhthutemp += $value->price * $value->quantity;
                }
                array_push($doanhthunam, $doanhthutemp);
            }
            return view('admin.dashboard', compact('name', 'doanhthungay', 'doanhthuthang', 'doanhthunam', 'donchoxacnhan', 'dangvanchuyen'));
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function product()
    {
        if (Auth::check()) {
            $data = Product::paginate(10);
            $name = Auth::user()->name;

            foreach ($data as $key => $value) {
                $soLuongNhap = InputDetail::where('product_id', $value->product_id)->sum('quantity');
                $soLuongNhap = is_null($soLuongNhap) ? 0 : $soLuongNhap;
                $soLuongXuat = OrderDetail::where('product_id', $value->product_id)->sum('quantity');
                $soLuongXuat = is_null($soLuongXuat) ? 0 : $soLuongXuat;
                
                $quantity = is_null($soLuongNhap - $soLuongXuat) ? 0 : $soLuongNhap - $soLuongXuat;
                $value->quantity = $quantity;
                $value->save();
            }
            return view('admin.product.product', compact('name', 'data'));
        } else {
            return redirect()->intended('admin');
        }
    }

    public function editProduct($id)
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            $category = Category::all();
            if (Auth::user()->role < 2) {
                $pEdit = Product::where('product_id', $id)->first();

                return view('admin.product.edit', compact('pEdit', 'name', 'category'));
            }
            return redirect()->intended('admin/product')->with('error', 'Bạn không có quyền chỉnh sửa sản phẩm này');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function updateProduct($id, Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'sale' => 'required|numeric|min:0|max:1',
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
                'sale.max' => 'Giảm giá tối đa là 1'
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
                'description' => $request->description,
                'category_id' => $request->categoryP,
                'gender' => $request->gender,
                'sale' => $request->sale,
                'image' => $fileName
            ];

            Product::where('product_id', $id)
                ->update($newData);

            return redirect()->intended('admin/product')->with('success', 'Sửa thông tin sản phẩm có mã '.$id.' thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function viewInsertP()
    {
        $name = Auth::user()->name;
        $category = Category::all();
        if (Auth::check()) {

            if (Auth::user()->role < 2) {
                return view('admin.product.insert', compact('name', 'category'));
            }
            return redirect()->intended('admin/product')->with('error', 'Bạn không có quyền thêm mới sản phẩm');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function insertProduct(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'sale' => 'required|numeric|min:0|max:1',
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
                'sale.max' => 'Giảm giá tối đa là 1'
            ]);

            if ($request->has('image')) {
                $file = $request->image;
                $fileName = $file->getClientOriginalName();

                $file->move(public_path('/frontend/img/product/'), $fileName);
            }

            $newData = new Product();
            $newData->product_name = $request->name;
            $newData->price = $request->price;
            $newData->description = $request->description;
            $newData->category_id = $request->categoryP;
            $newData->gender = $request->gender;
            $newData->sale = $request->sale;
            $newData->image = $fileName;

            $newData->save();
            return redirect()->intended('admin/product')->with('success', 'Thêm mới sản phẩm có mã thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function deleteProduct($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role < 2) {
                $file = Product::where('product_id', $id)->first();
                $fileName = $file->image;
                if (file_exists(public_path('/frontend/img/product/' . $fileName))) {
                    unlink(public_path('/frontend/img/product/' . $fileName));
                }

                Product::where('product_id', $id)
                    ->delete();
                return redirect()->intended('admin/product')->with('success', 'Xóa sản phẩm có mã '.$id.' thành công !');
            } else {
                return redirect()->intended('admin/product')->with('error', 'Bạn không có quyền xóa sản phẩm này');
            }
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
            if (Auth::user()->role < 2) {
                $name = Auth::user()->name;
                $data = Blog::where('blog_id', $id)->first();
                return view('admin.blog.edit', compact('name', 'data'));
            } else {
                return redirect()->intended('admin/blog')->with('error', 'Bạn không có quyền chỉnh sửa bài viết này');
            }
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

            if ($request->has('image')) {
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

            return redirect()->intended('admin/blog')->with('success', 'Cập nhật bài viết có mã '.$id.' thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function viewInsertBlog()
    {
        if (Auth::check()) {
            if (Auth::user()->role < 2) {
                $name = Auth::user()->name;
                return view('admin.blog.insert', compact('name'));
            } else {
                return redirect()->intended('admin/blog')->with('error', 'Bạn không có quyền thêm mới bài viết');
            }
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

            if ($request->has('image')) {
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

            return redirect()->intended('admin/blog')->with('success', 'Thêm mới bài viết thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function deleteBlog($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role < 2) {
                $oldFile = Blog::where('blog_id', $id)->first();
                $oldFileName = $oldFile->img;

                if (file_exists(public_path('/frontend/img/blog/' . $oldFileName))) {
                    unlink(public_path('/frontend/img/blog/' . $oldFileName));
                }

                Blog::where('blog_id', $id)->delete();

                return redirect()->intended('admin/blog')->with('success', 'Xóa bài viết có mã '.$id.' thành công !');
            } else {
                return redirect()->intended('admin/blog')->with('error', 'Bạn không có quyền xóa bài viết này');
            }
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
            $admin_role = Auth::user()->role;
            $name = Auth::user()->name;
            $data = Category::where('id', $id)->first();

            if ($admin_role < 2) {
                return view('admin.category.edit', compact('name', 'data'));
            } else {
                return redirect()->intended('admin/category')->with('error', 'Bạn không có quyền sửa danh mục này');
            }
        } else
            return redirect()->intended('admin');
    }

    public function updateCategory($id, Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required|unique:category,category_name,' . $id,
            ], [
                'name.required' => 'Không được để trống',
                'name.unique' => 'Tên danh mục đã tồn tại'
            ]);
            $newData = [
                'category_name' => $request->name
            ];

            Category::where('id', $id)
                ->update($newData);

            return redirect()->intended('admin/category')->with('success', 'Sửa danh mục có mã '.$id.' thành công !');
        } else
            return redirect()->intended('admin');
    }

    public function viewInsertCategory()
    {

        if (Auth::check()) {
            $admin_role = Auth::user()->role;
            $name = Auth::user()->name;

            if ($admin_role < 2) {
                return view('admin.category.insert', compact('name'));
            } else {
                return redirect()->intended('admin/category')->with('error', 'Bạn không có quyền thêm danh mục');
            }
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
            return redirect()->intended('admin/category')->with('success', 'Thêm mới danh mục thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }


    public function deleteCategory($id)
    {
        if (Auth::check()) {
            $count = Category::join('product', 'product.category_id', '=', 'category.id')
                ->where('category.id', $id)->count();

            $admin_role = Auth::user()->role;
            if ($admin_role < 2) {
                if ($count == 0) {
                    Category::where('id', $id)
                        ->delete();
                    return redirect()->intended('admin/category')->with('success', 'Xóa danh mục có mã '.$id.' thành công !');
                } else {
                    return redirect()->intended('admin/category')->with('error', 'Không thể xóa danh mục có mã '.$id.' do đang có sản phẩm !');
                }
            } else {
                return redirect()->intended('admin/category')->with('error', 'Bạn không có quyền xóa danh mục này');
            }
        } else
            return redirect()->intended('admin');
    }

    public function user()
    {
        if (Auth::check()) {
            $user = User::paginate(10);
            $name = Auth::user()->name;
            return view('admin.user.user', compact('name', 'user'));
        } else
            return redirect()->intended('admin');
    }

    public function viewInsertUser()
    {

        if (Auth::check()) {
            $name = Auth::user()->name;
            if (Auth::user()->role < 2) {
                return view('admin.user.insert', compact('name'));
            } else {
                return redirect()->intended('admin/user')->with('error', 'Bạn không có quyền thêm mới tài khoản quản trị');
            }
        } else {
            return redirect()->intended('admin');
        }
    }

    public function insertUser(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required|unique:users|min:6|max:100',
                'email' => 'required|unique:users|email',
                'date' => 'required|after_or_equal:today',
                'password' => 'required|min:6|max:50',
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'email' => 'Vui lòng nhập email chính xác',
                'name.min' => 'Tên tối thiểu gồm 6 kí tự',
                'name.max' => 'Tên tối đa là 100 kí tự',
                'password.min' => 'Mật khẩu tối thiểu gồm 6 kí tự',
                'password.max' => 'Mật khẩu tối đa là 50 kí tự',
                'after_or_equal' => 'Ngày tạo phải lớn hơn hoặc bằng ngày hiện tại',
                'name.unique' => 'Tên đăng nhập đã tồn tại',
                'email.unique' => 'Email đã tồn tại'
            ]);


            $newData = new User();
            $newData->name = $request->name;
            $newData->email = $request->email;
            $newData->password = bcrypt($request->password);
            $newData->created_at = $request->date;
            $newData->role = $request->role;
            $newData->save();

            return redirect()->intended('admin/user')->with('success', 'Thêm mới tài khoản thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }


    public function editUser($id)
    {
        if (Auth::check()) {
            $admin_role = Auth::user()->role;
            if ($admin_role < 2) {
                $user = User::where('id', $id)->first();
                $name = Auth::user()->name;
                if ($admin_role < $user->role) {
                    return view('admin.user.edit', compact('name', 'user'));
                } else {
                    return redirect()->intended('admin/user')->with('error', 'Bạn không có quyền sửa tài khoản này');
                }
            } else {
                return redirect()->intended('admin/user')->with('error', 'Bạn không có quyền chỉnh sửa tài khoản quản trị');
            }
        } else
            return redirect()->intended('admin');
    }

    public function updateUser($id, Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required|unique:users,id,' . $id . '|min:6|max:100',
                'email' => 'required|unique:users,id,' . $id . '|email',
                'date' => 'required|after_or_equal:today',
                'password' => 'required|min:6|max:50',
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'email' => 'Vui lòng nhập email chính xác',
                'name.min' => 'Tên tối thiểu gồm 6 kí tự',
                'name.max' => 'Tên tối đa là 100 kí tự',
                'password.min' => 'Mật khẩu tối thiểu gồm 6 kí tự',
                'password.max' => 'Mật khẩu tối đa là 50 kí tự',
                'after_or_equal' => 'Ngày tạo phải lớn hơn hoặc bằng ngày hiện tại',
                'name.unique' => 'Tên đăng nhập đã tồn tại',
                'email.unique' => 'Email đã tồn tại'
            ]);
            $newData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'created_at' => $request->date,
                'role' => $request->role,
            ];

            User::where('id', $id)
                ->update($newData);

            return redirect()->intended('admin/user')->with('success', 'Sửa thông tin tài khoản thành công !');
        } else
            return redirect()->intended('admin');
    }


    public function deleteUser($id)
    {
        if (Auth::check()) {
            $admin_role = Auth::user()->role;
            if ($admin_role < 2) {
                $user = User::where('id', $id)->first();
                if ($admin_role < $user->role) {
                    $user->delete();
                    return redirect()->intended('admin/user')->with('success', 'Xóa tài khoản có mã '.$id.' thành công !');
                } else {
                    return redirect()->intended('admin/user')->with('error', 'Bạn không có quyền xóa người dùng này');
                }
            } else {
                return redirect()->intended('admin/user')->with('error', 'Bạn không có quyền xóa người dùng này');
            }
        } else
            return redirect()->intended('admin');
    }

    public function input()
    {
        if (Auth::check()) {
            $data = Input::orderby('created_at', 'desc')->paginate(6);
            $name = Auth::user()->name;
            return view('admin.input.input', compact('name', 'data'));
        } else
            return redirect()->intended('admin');
    }

    public function viewInsertInput()
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            return view('admin.input.insert', compact('name'));
        } else {
            return redirect()->intended('admin');
        }
    }

    public function insertInput(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'date' => 'required|after_or_equal:today',
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'after_or_equal' => 'Ngày tạo phải lớn hơn hoặc bằng ngày hiện tại'
            ]);

            $newData = new Input();
            $newData->emp_name = $request->name;
            $newData->created_at = $request->date;
            $newData->address = $request->address;
            $newData->save();

            return redirect()->intended('admin/input')->with('success', 'Thêm mới phiếu nhập thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function viewEditInput($id)
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            $data = Input::where('id', $id)->first();

            return view('admin.input.edit', compact('name', 'data'));
        } else
            return redirect()->intended('admin');
    }

    public function updateInput($id, Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'date' => 'required|after_or_equal:today',
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'after_or_equal' => 'Ngày tạo phải lớn hơn hoặc bằng ngày hiện tại'
            ]);

            $newData = [
                'emp_name' => $request->name,
                'address' => $request->address,
                'created_at' => $request->date
            ];

            Input::where('id', $id)
                ->update($newData);

            return redirect()->intended('admin/input')->with('success', 'Sửa hóa đơn có mã '.$id.' thành công !');
        } else
            return redirect()->intended('admin');
    }

    public function deleteInput($id)
    {
        if (Auth::check()) {
            $data = Input::where('id', $id)->first();
            $data->delete();
            return redirect()->intended('admin/input')->with('success', 'Xóa hóa đơn có mã '.$id.' thành công !');
        } else
            return redirect()->intended('admin');
    }

    public function inputDetail()
    {
        if (Auth::check()) {
            $data = InputDetail::orderby('input_id', 'asc')->paginate(10);
            $name = Auth::user()->name;
            return view('admin.inputDetail.inputDetail', compact('name', 'data'));
        } else
            return redirect()->intended('admin');
    }


    public function viewInsertInputDetail()
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            $input = Input::all();
            $product = Product::all();
            return view('admin.inputDetail.insert', compact('name', 'input', 'product'));
        } else {
            return redirect()->intended('admin');
        }
    }

    public function insertInputDetail(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'id' => 'required',
                'pid' => 'required',
                'quantity' => 'required|numeric|min:1',
                'price' => 'required|numeric|min:1'
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'numeric' => 'Dữ liệu phải là số',
                'quantity.min' => 'Số lượng phải lớn hơn 0',
                'price.min' => 'Giá phải lớn hơn 0',
            ]);
            $checkData = InputDetail::where('input_id', $request->id)->where('product_id', $request->pid)->count();
            if($checkData > 0) {
                return redirect()->intended('admin/inputDetail')->with('error', 'Sản phẩm có mã '.$request->pid.' đã được nhập trong phiếu nhập có mã '.$request->id);
            } else {
                $newData = new InputDetail();
                $newData->input_id = $request->id;
                $newData->product_id = $request->pid;
                $newData->quantity = $request->quantity;
                $newData->price = $request->price;
                $newData->save();

                return redirect()->intended('admin/inputDetail')->with('success', 'Thêm mới thành công sản phẩm có mã '.$request->pid.' vào phiếu nhập '.$request->id.' !');
            }
        } else {
            return redirect()->intended('admin');
        }
    }

    public function deleteInputDetail($id, $pid)
    {
        if (Auth::check()) {
            InputDetail::where('input_id', $id)->where('product_id', $pid)->delete();
            return redirect()->intended('admin/inputDetail')->with('success', 'Xóa thành công sản phẩm có mã '.$pid.' vào hóa đơn '.$id.' !');
        } else
            return redirect()->intended('admin');
    }

    public function viewEditInputDetail($id, $pid)
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            $data = InputDetail::where('input_id', $id)->where('product_id', $pid)->first();

            return view('admin.inputDetail.edit', compact('name', 'data'));
        } else
            return redirect()->intended('admin');
    }

    public function updateInputDetail($id, $pid, Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'quantity' => 'required|numeric|min:1',
                'price' => 'required|numeric|min:1'
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'numeric' => 'Dữ liệu phải là số',
                'quantity.min' => 'Số lượng phải lớn hơn 0',
                'price.min' => 'Giá phải lớn hơn 0',
            ]);

            $newData = [
                'quantity' => $request->quantity,
                'price' => $request->price
            ];

            InputDetail::where('input_id', $id)->where('product_id', $pid)
                ->update($newData);

            return redirect()->intended('admin/inputDetail')->with('success', 'Sửa thành công sản phẩm có mã '.$pid.' vào hóa đơn '.$id.' !');
        } else
            return redirect()->intended('admin');
    }

    public function order()
    {
        if (Auth::check()) {
            $data = Order::orderby('status', 'asc')->paginate(6);
            $name = Auth::user()->name;
            return view('admin.order.order', compact('name', 'data'));
        } else
            return redirect()->intended('admin');
    }

    public function viewInsertOrder()
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            return view('admin.order.insert', compact('name'));
        } else {
            return redirect()->intended('admin');
        }
    }

    public function insertOrder(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'address' => 'required',
                'date' => 'required|after_or_equal:today'
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'email' => 'Email không hợp lệ',
                'numeric' => 'Số điện thoại phải là số',
                'after_or_equal' => 'Ngày tạo phải lớn hơn hoặc bằng ngày hiện tại'
            ]);

            $newData = new Order();
            $newData->firstname = $request->firstname;
            $newData->lastname = $request->lastname;
            $newData->email = $request->email;
            $newData->phone = $request->phone;
            $newData->note = $request->note;
            $newData->created_at = $request->date;
            $newData->address = $request->address;
            $newData->save();

            return redirect()->intended('admin/order')->with('success', 'Thêm mới hóa đơn thành công !');
        } else {
            return redirect()->intended('admin');
        }
    }

    public function viewEditOrder($id)
    {
        if (Auth::check()) {
            $check = Order::where('id', $id)->count();
            $name = Auth::user()->name;
            if($check != 0 ) {
                $data = Order::where('id', $id)->first();
                return view('admin.order.edit', compact('name', 'data'));
            } else
                return redirect()->intended('admin/order')->with('error', 'Không tìm thấy hóa đơn có mã ' .$id. ' !');
        } else
            return redirect()->intended('admin');
    }

    public function updateOrder($id, Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'address' => 'required',
                'date' => 'required|after_or_equal:today'
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'email' => 'Email không hợp lệ',
                'numeric' => 'Số điện thoại phải là số',
                'after_or_equal' => 'Ngày tạo phải lớn hơn hoặc bằng ngày hiện tại'
            ]);

            $newData = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'created_at' => $request->date,
                'note' => $request->note,
                'status' => 0
            ];

            Order::where('id', $id)
                ->update($newData);

            return redirect()->intended('admin/order')->with('success', 'Sửa thành công hóa đơn có mã '.$id.' !');
        } else
            return redirect()->intended('admin');
    }

    public function deleteOrder($id)
    {
        if (Auth::check()) {
            $check = Order::where('id', $id)->count();
            if($check != 0 ) {
                Order::where('id', $id)->delete();
                return redirect()->intended('admin/order')->with('success', 'Xóa thành công hóa đơn có mã '.$id.' !');
            } else
                return redirect()->intended('admin/order')->with('error', 'Không tìm thấy dữ liệu !');
        } else
            return redirect()->intended('admin');
    }

    public function orderDetail()
    {
        if (Auth::check()) {
            $data = OrderDetail::orderby('order_id', 'asc')->paginate(6);
            $name = Auth::user()->name;
            return view('admin.order_detail.orderDetail', compact('name', 'data'));
        } else
            return redirect()->intended('admin');
    }

    public function viewInsertOrderDetail()
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            $order = Order::all();
            $product = Product::all();
            return view('admin.order_detail.insert', compact('name', 'order', 'product'));
        } else {
            return redirect()->intended('admin');
        }
    }

    public function insertOrderDetail(Request $request)
    {
        if (Auth::check()) {
            $maxQuantity = Product::where('product_id', $request->pid)->first()->quantity;
            $request->validate([
                'id' => 'required',
                'pid' => 'required',
                'quantity' => 'required|numeric|min:1|max:'.$maxQuantity,
                'price' => 'required|numeric|min:1'
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'numeric' => 'Dữ liệu phải là số',
                'quantity.min' => 'Số lượng sản phẩm phải lớn hơn 0',
                'quantity.max' => 'Số lượng sản phẩm trong kho không đủ',
                'price.min' => 'Giá sản phẩm phải lớn hơn 0',
            ]);
            $checkData = OrderDetail::where('order_id', $request->id)->where('product_id', $request->pid)->count();
            if($checkData > 0) {
                return redirect()->intended('admin/orderDetail')->with('error', 'Sản phẩm này đã có trong hóa đơn '.$request->id. ' !');
            } else {
                $newData = new OrderDetail();
                $newData->order_id = $request->id;
                $newData->product_id = $request->pid;
                $newData->quantity = $request->quantity;
                $newData->price = $request->price;
                $newData->save();

                return redirect()->intended('admin/orderDetail')->with('success', 'Thêm mới thành công sản phẩm có mã '.$request->pid.' vào hóa đơn '.$request->id.' !');
            }
        } else {
            return redirect()->intended('admin');
        }
    }

    public function viewEditOrderDetail($id, $pid)
    {
        if (Auth::check()) {
            $name = Auth::user()->name;
            $data = OrderDetail::where('order_id', $id)->where('product_id', $pid)->first();

            return view('admin.order_detail.edit', compact('name', 'data'));
        } else
            return redirect()->intended('admin');
    }

    public function updateOrderDetail($id, $pid, Request $request)
    {
        if (Auth::check()) {
            $maxQuantity = Product::where('product_id', $request->pid)->first()->quantity;
            $request->validate([
                'quantity' => 'required|numeric|min:1|max:'.$maxQuantity,
                'price' => 'required|numeric|min:1'
            ], [
                'required' => 'Không được bỏ trống bất kỳ trường dữ liệu nào',
                'numeric' => 'Dữ liệu phải là số',
                'quantity.min' => 'Số lượng sản phẩm phải lớn hơn 0',
                'quantity.max' => 'Số lượng sản phẩm trong kho không đủ',
                'price.min' => 'Giá sản phẩm phải lớn hơn 0',
            ]);

            $newData = [
                'quantity' => $request->quantity,
                'price' => $request->price
            ];

            OrderDetail::where('order_id', $id)->where('product_id', $pid)
                ->update($newData);

            return redirect()->intended('admin/orderDetail')->with('success', 'Sửa thành công sản phẩm có mã '.$request->pid.' vào hóa đơn '.$request->id.' !');
        } else
            return redirect()->intended('admin');
    }

    public function deleteOrderDetail($id, $pid)
    {
        if (Auth::check()) {
            OrderDetail::where('order_id', $id)->where('product_id', $pid)->delete();
            return redirect()->intended('admin/orderDetail')->with('success', 'Xóa thành công sản phẩm có mã '.$pid.' vào hóa đơn '.$id.' !');
        } else
            return redirect()->intended('admin');
    }

}
