<?php

namespace App\Http\Controllers\admin;
use Session;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\AdminRole;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Traits\GeneralTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\createProductRequest;
use App\Http\Requests\updateProductRequest;
use Auth;

class adminProductController extends Controller
{
    use GeneralTraits;
    public function index(request $request){
        Session::put('page','product');
        $products=Product::paginate(5);
        if(!empty($request->get('search'))){
            $products = Product::where('product_name', 'like','%'.$request->get('search').'%')->paginate(5)->appends($request->get('search'));
        }
        $cmsPagesModuleCount=AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'products'])->count();
        $pageModule=array();
        if(Auth::guard('admin')->user()->type=="2"){
            $pageModule['view_access']="on";
            $pageModule['edit_access']="on";
            $pageModule['full_access']="on";
        }elseif($cmsPagesModuleCount==0){
            $message="this feature is restricted for you!";
            return redirect()->route("adminHome")->with('error',$message);
        }else{
            $pageModule = AdminRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'products'])->first()->toArray();
        }
        return view('admin.pages.products.index',compact('products','pageModule'));
    }
    // public function search(Request $request){
    //     if($request->ajax()){
    //         $products = Product::where("product_name","like","%{$request->search}%")
    //         ->orWhere("final_price","like","%{$request->search}%")
    //         ->orderBy('id','asc')
    //         ->paginate(3);
    //         return view('admin.pages.products.pagination',compact('products'));
    //     }
    // }
    public function create(){
        Session::put('page','product');
        $categories = Category::select("category_name","id")->get();
        $brands = Brand::select("brand_name","id")->get();
        return view('admin.pages.products.create',compact('categories','brands'));
    }
    public function submitCreate(createProductRequest $request){
        $data=$request->validated();
        if(!empty($data['product_discount'])){
            $data['discount_type']="product";
        }elseif(Category::select('category_discount')->where('id',$data['category_id'])->first()->category_discount>0){
            $getCategoryDiscount=Category::select('category_discount')->where('id',$data['category_id'])->first()->category_discount;
            $data['discount_type']='category';
            $data['final_price']= $data['product_price'] - ($data['product_price'] * $getCategoryDiscount)/100;
        }elseif(Brand::select('brand_discount')->where('id',$data['brand_id'])->first()->category_discount>0){
            $getBrandDiscount=Brand::select('brand_discount')->where('id',$data['brand_id'])->first()->brand_discount>0;
            $data['discount_type']='brand';
            $data['final_price']=$data['product_price'] - ($data['product_price'] * $getBrandDiscount)/100;
        }

        $data['main_image']=GeneralTraits::uploadProductImage('main_image');
        if(isset($data['image_1'])){
            $data['image_1']=GeneralTraits::uploadProductImage('image_1');
        }
        if(isset($data['image_2'])){
            $data['image_2']=GeneralTraits::uploadProductImage('image_2');
        }
        if(!isset($data['product_discount'])){
            $data['product_discount']=0;
        }
        // if(isset($data['image_3'])){
        //     $img=request()->file('image_3');
        //     $ext =$img->getClientOriginalExtension();
        //     $imageName3='product-'.rand(1111,99999).'.'.$ext;
        //     $file=request()->file($requestName)->move(public_path('admin/assets/img/products'),$imageName3);
        //     $data['image_3']=$imageName3;
        // }
        if(!isset($data['product_code'])){
        $data['product_code'] = Str::random();
        }
        Product::create($data);
        return redirect()->route('adminProduct')->with('success',"The Product was created");
    }
    public function updateStatus(Request $request){
            if($request->ajax()){
                $data=$request->all();
                if($data['status']=="Active"){
                    $status=0;
                }else{
                    $status=1;
                }
                Brand::where('id',$data['product_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'brand_id'=>$data['product_id']]);
            }
    }
    public function edit($id){
        Session::put('page','product');
        $product=Product::findOrFail($id);
        $categories= Category::select('id','category_name')->get();
        $brands=Brand::select('id','brand_name')->get();
        return view('admin.pages.products.update',compact('product','categories','brands'));
    }
    // public function update(UpdateProductRequest $request, $id){
    //     $product = Product::findOrFail($id);
    //     $data = $request->validated();

    //     $this->handleDiscountCalculation($data);
    //     $this->handleMediaFile($data, $product);

    //     $product->update($data);

    //     return redirect()->route('adminProduct')->with('success', "The Product was updated successfully");
    // }
    // private function handleDiscountCalculation(&$data)
    // {
    //     if (!empty($data['product_discount'])) {
    //         $data['discount_type'] = "product";
    //     } else {
    //         $categoryDiscount = Category::select('category_discount')
    //             ->where('id', $data['category_id'])
    //             ->value('category_discount');

    //         if ($categoryDiscount > 0) {
    //             $data['discount_type'] = 'category';
    //             $data['product_discount']=$categoryDiscount;
    //             $data['final_price'] = $data['product_price'] - ($data['product_price'] * $categoryDiscount) / 100;
    //         } else {
    //             $brandDiscount = Brand::select('brand_discount')
    //                 ->where('id', $data['brand_id'])
    //                 ->value('brand_discount');

    //             if ($brandDiscount > 0) {
    //                 $data['discount_type'] = 'brand';
    //                 $data['product_discount']=$brandDiscount;
    //                 $data['final_price'] = $data['product_price'] - ($data['product_price'] * $brandDiscount) / 100;
    //             }
    //         }
    //     }
    // }
    // private function handleMediaFile($data,$product){
    //     // $this->uploadMediaFile('product_video',$data,$product,'admin/assets/videos');
    //     $this->uploadMediaFile('main_image',$data,$product,'admin\assets\img\products');
    //     $this->uploadMediaFile('image_1',$data,$product,'admin\assets\img\products');
    //     $this->uploadMediaFile('image_2',$data,$product,'admin\assets\img\products');
    // }
    // private function uploadMediaFile($field, &$data, $product, $path)
    // {
    //     // if (isset($data[$field])) {
    //     //     if (file_exists(public_path($path . "\\" . $product->{$field}))) {
    //     //         unlink(public_path($path . "\\" . $product->{$field}));
    //     //     }
    //     //     $file = $data[$field];
    //     //     $fileName = 'product-'. rand(1111,99999) . '.' . $file->extension();
    //     //     $file->move(public_path($path), $fileName);
    //     //     $data[$field] = $fileName;

    //     // }
    //     if (isset($data[$field])) {
    //         $originalFile = $data[$field];

    //         // Construct correct path for storage
    //         $fileName = 'product-' . rand(1111, 99999) . '.' . $originalFile->extension();
    //         $filePath = public_path($path . "\\" . $fileName);
    //         // Move the file to the desired location
    //         $originalFile->move($filePath);
    //         // Store the correct path in the database
    //         $data[$field] = $fileName;
    //         // Optionally delete temporary file if applicable
    //         if (file_exists($originalFile)) {
    //             unlink($originalFile);
    //         }
    //     }
    // }

    public function update(updateProductRequest $request,$id) {
        $product = Product::findOrFail($id);
        $data=$request->validated();
        if(!empty($data['product_discount'])){
            $data['discount_type']="product";
        }elseif(Category::select('category_discount')->where('id',$data['category_id'])->first()->category_discount>0){
            $getCategoryDiscount=Category::select('category_discount')->where('id',$data['category_id'])->first()->category_discount;
            $data['discount_type']='category';
            $data['product_discount']=$getCategoryDiscount;
            $data['final_price']= $data['product_price'] - ($data['product_price'] * $getCategoryDiscount)/100;
        }elseif(Brand::select('brand_discount')->where('id',$data['brand_id'])->first()->category_discount>0){
            $getBrandDiscount=Brand::select('brand_discount')->where('id',$data['brand_id'])->first()->brand_discount>0;
            $data['discount_type']='brand';
            $data['product_discount']=$getBrandDiscount;
            $data['final_price']=$data['product_price'] - ($data['product_price'] * $getBrandDiscount)/100;
        }
        if(!isset($data['product_code'])){
            $data['product_code'] = Str::random();
            }
        if(isset($data['main_image'])){
             if(file_exists($product->main_image)){
                unlink(public_path('admin\assets\img\products\\'.$product->main_image));
             }
                $img=$data['main_image'];
                $fileNameMainImage='product-'.rand(1111,99999).".".$img->extension();
                $img->move(public_path('admin/assets/img\products/'),$fileNameMainImage);
                $data["main_image"]=$fileNameMainImage;

        }
        if(isset($data['image_1'])){
             if(file_exists($product->product_video)){
                unlink(public_path('admin\assets\img\products\\'.$product->product_video));
             }
                $img1=$data['image_1'];
                $fileNameImage1='product-'.rand(1111,99999).".".$img1->extension();
                $img1->move(public_path('admin/assets/img/products/'),$fileNameImage1);
                $data["image_1"]=$fileNameImage1;

        }
        if(isset($data['image_2'])){
             if(file_exists($product->image_2)){
                unlink(public_path('admin\assets\img\products\\'.$product->image_2));
             }
                $img2=$data['image_2'];
                $fileNameImage2='product-'.rand(1111,99999).".".$img2->extension();
                $img2->move(public_path('admin/assets/img/products/'),$fileNameImage2);
                $data["image_2"]=$fileNameImage2;
        }
        $product->update($data);
        return redirect()->route('adminProduct')->with('success',"The Product was updated successfully");


    }
    public function destroy($id){
        Product::where('id',$id)->delete();
        return back()->with('danger', 'This product has been deleted');
    }
    public function destroyVideo($id){
        $productVideo=Product::find($id);
            if(file_exists(public_path("admin/assets/videos/$productVideo->product_video"))){
                unlink(public_path("admin/assets/videos/$productVideo->product_video"));
            }
            Product::where('id',$id)->update(['product_video'=>""]);
            return redirect()->back()->with('error',"The product video was deleted");
    }
    public function destroyImage2($id){
        $productImage2=Product::find($id);
            if(file_exists(public_path('admin\assets\img\products\\'.$productImage2->image_2))){
                unlink(public_path('admin\assets\img\products\\'.$productImage2->image_2));
            }
            Product::where('id',$id)->update(['image_2'=>""]);
            return redirect()->back()->with('error',"The product video was deleted");
    }
    public function destroyMainImage($id){
        $productMainImage=Product::find($id);
        if(file_exists(public_path('admin\assets\img\products\\'.$productMainImage->main_image))){
                unlink(public_path('admin\assets\img\products\\'.$productMainImage->main_image));
            }
            Product::where('id',$id)->update(['main_image'=>""]);
            return redirect()->back()->with('error',"The product video was deleted");
    }
    public function destroyImage1($id){
        $productImage1=Product::find($id);
            if(file_exists(public_path('admin\assets\img\products\\'.$productImage1->image_1))){
                unlink(public_path('admin\assets\img\products\\'.$productImage1->image_1));
            }
            Product::where('id',$id)->update(['image_1'=>""]);
            return redirect()->back()->with('error',"The product video was deleted");
    }
}
