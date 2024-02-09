<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\authController;
use App\Http\Controllers\front\homeController;
use App\Http\Controllers\front\profileController;
use App\Http\Controllers\admin\adminCmsController;
use App\Http\Controllers\auth\adminAuthController;
use App\Http\Controllers\admin\adminOrderController;
use App\Http\Controllers\admin\adminHomeController;
use App\Http\Controllers\admin\adminBrandController;
use App\Http\Controllers\admin\adminBannerController;
use App\Http\Controllers\admin\adminCouponController;
use App\Http\Controllers\admin\adminProductController;
use App\Http\Controllers\front\frontProductController;
use App\Http\Controllers\front\contactUsController;
use App\Http\Controllers\front\ratingController;
use App\Http\Controllers\front\wishlistController;
use App\Http\Controllers\front\cartController;
use App\Http\Controllers\admin\adminCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
    Route::get('/', [homeController::class , 'index'])->name('home');
    Route::get('/login',[authController::class,'login'])->name('login');
    Route::post('/submitlogin',[authController::class,'submitLogin'])->name('submitLogin');
    Route::get('/register',[authController::class,'register'])->name('register');
    Route::post('/submitregister',[authController::class,'submitRegister'])->name('submitRegister');
    Route::get('/logout',[authController::class,'logout'])->name('logout');
    Route::get('/forgot-password',[authController::class,'forgotPassword'])->name('forgot.password');
    Route::post('/submit-forgot-password',[authController::class,'submitForgotPassword'])->name('submit.forgot.password');
    Route::get('/reset-password/{id}',[authController::class,'resetPassword'])->name('reset.password');
    Route::post('/submit-reset-password/{id}',[authController::class,'SubmitResetPassword'])->name('submit.reset.password');
    Route::get('/profile',[profileController::class,'index'])->name('profile');
    route::get('/AdminLogin',[adminAuthController::class,'login'])->name('adminLogin');
    route::post('/submitAdminLogin',[adminAuthController::class,'submitLogin'])->name('submitAdminLogin');
    Route::get('page/{page}',[adminCmsController::class,'show'])->name('cms.show');
    Route::post('/add-to-wishlist',[wishlistController::class,'addToWishlist'])->name('add.wishlist');
    Route::controller(frontProductController::class)->prefix('product')->group(function (){
        Route::get('/{category_name?}','index')->name('front.products');
        Route::get('/show/{id}','show')->name('front.product.show');
    });
    Route::controller(ratingController::class)->prefix('rating')->group(function (){
        Route::post('/submitRate','store')->name('rate.store');
    });
    Route::controller(contactUsController::class)->prefix('contact-US')->group(function (){
        Route::get('/','create')->name('contact.create');
        Route::post('/submit-form','store')->name('contact.store');
    });


    Route::middleware('auth:web')->group(function(){
        Route::get('/wishlist/index',[wishlistController::class,'index'])->name('index.wishlist');
        Route::get('/wishlist/delete/{id}',[wishlistController::class,'destroy'])->name('wishlist.delete');
        Route::controller(cartController::class)->prefix('cart')->group(function (){
            Route::get('/index','index')->name('cart.index');
            Route::post('/add/{id}','store')->name('cartStore');
            Route::get('/delete/{id}','destroy')->name('deleteCart');
            Route::post('/update/{id}','update')->name('cart.update');
            Route::get('/incrementQuantity/{id}/','incrementQuantity')->name('increment.cart.quantity');
            Route::get('/decrementQuantity/{id}/','decrementQuantity')->name('decrement.cart.quantity');
            Route::get('/checkout','checkout')->name('front.checkout');
            Route::post('/submit-checkout','submitCheckout')->name('front.submit.checkout');
            Route::get('/thankyou','thankyou')->name('thankyou');
            Route::post('/submitCoupon','submitCoupon')->name('submit.coupon');
        });
        Route::controller(cartController::class)->prefix('order')->group(function (){
            Route::get('/history','myHistory')->name('order.history');
            Route::get('/details/{id}','orderDetails')->name('order.details');
        });
    });
    Route::middleware('auth:admin')->group(function(){

        Route::get('/adminhome',[adminHomeController::class , 'index'])->name('adminHome');
        Route::post('/submitCreateCategory',[adminCategoryController::class , 'submitCreate'])->name('submitCreateCategory');
        Route::get('/updatepassword',[adminAuthController::class , 'updatePassword'])->name('updatePassword');
        Route::post('/submitupdatepassword',[adminAuthController::class , 'submitUpdatePassword'])->name('submitUpdate');
        Route::post('/checkCurrentPassword',[adminAuthController::class , 'checkCurrentPassword'])->name('checkCurrentPassword');
        Route::get('/updatedetails',[adminAuthController::class , 'updateDetails'])->name('updateDetails');
        Route::post('/submitupdatedetails',[adminAuthController::class , 'submitUpdateDetails'])->name('submitUpdateDetails');
        Route::get('/admincms',[adminCmsController::class , 'index'])->name('adminCms');
        Route::post('/updatecmsstatus',[adminCmsController::class , 'updateCmsStatus'])->name('updateCmsStatus');
        Route::get('/createCms',[adminCmsController::class , 'create'])->name('createCms');
        Route::post('/submitCreateCms',[adminCmsController::class , 'submitCreate'])->name('submitCreateCms');
        Route::get('/updateCms/{id}',[adminCmsController::class , 'update'])->name('updateCms');
        Route::post('/submitupdateCms/{id}',[adminCmsController::class , 'submitUpdate'])->name('submitUpdateCms');
        Route::get('/deleteCms/{id}',[adminCmsController::class , 'deleteCms'])->name('deleteCms');
        Route::get('/adminlogout',[adminAuthController::class,'adminLogout'])->name('adminLogout');
        Route::get('/subadmins',[adminAuthController::class,'subAdmins'])->name('subAdmins');
        Route::post('/updatesubadminState/{id}',[adminAuthController::class,'updateSubadminState'])->name('updateSubadminState');
        Route::get('/delelteSubadmin/{id}',[adminAuthController::class,'deleteSubadmin'])->name('deleteSubadmin');
        Route::get('/add-subadmin',[adminAuthController::class,'addSubadmins'])->name('addSubadmins');
        Route::post('/submit-add-subadmins',[adminAuthController::class,'submitAddSubadmins'])->name('submitAddSubadmins');
        Route::get('/update-roles/{id}',[adminAuthController::class,'updateRoles'])->name('updateRoles');
        Route::post('/submit-update-roles/{id}',[adminAuthController::class,'submitUpdateRoles'])->name('submitUpdateRoles');
        Route::get('adminCategory',[adminCategoryController::class , 'index'])->name('adminCategory');
        Route::get('/createCategory',[adminCategoryController::class , 'create'])->name('createCategory');
        Route::post('/submitcreateCategory',[adminCategoryController::class , 'submitCreateCategory'])->name('submitCreateCategory');
        Route::get('/editCategory/{id}',[adminCategoryController::class , 'edit'])->name('editCategory');
        Route::post('/submiteditCategory/{id}',[adminCategoryController::class , 'update'])->name('updateCategory');
        Route::post('/updateStatusCategory',[adminCategoryController::class , 'updateStatus'])->name('updateCategoryStatus');
        Route::get('/deleteCategory/{id}',[adminCategoryController::class , 'destroy'])->name('deleteCategory');
        Route::get('/deleteCategoryImage/{id}',[adminCategoryController::class , 'destroyImage'])->name('deleteCategoryImage');
        Route::get('/admin-brand',[adminBrandController::class , 'index'])->name('adminBrand');
        Route::get('/create-brand',[adminBrandController::class , 'create'])->name('createBrand');
        Route::post('/submit-create-brand',[adminBrandController::class , 'submitCreate'])->name('submitCreateBrand');
        Route::get('/edit-brand/{id}',[adminBrandController::class , 'edit'])->name('editBrand');
        Route::post('/update-brand/{id}',[adminBrandController::class , 'update'])->name('updateBrand');
        Route::post('/update-brand-status',[adminBrandController::class , 'updateStatus'])->name('updateBrandStatus');
        Route::get('/delete-brand/{id}',[adminBrandController::class , 'destroy'])->name('deleteBrand');
        Route::get('/delete-brand-logo/{id}',[adminBrandController::class , 'destroyImage'])->name('deleteBrandImage');
        Route::get('/delete-brand-image/{id}',[adminBrandController::class , 'destroyLogo'])->name('deleteBrandLogo');
        Route::get('/admin-product',[adminProductController::class,"index"])->name('adminProduct');
        Route::get('/create-product',[adminProductController::class,"create"])->name('createProduct');
        Route::post('/submit-create-product',[adminProductController::class,"submitCreate"])->name('submitCreateProduct');
        Route::post('/update-product-status',[adminProductController::class,"updateStatus"])->name('updateProductStatus');
        Route::get('/delete-product/{id}',[adminProductController::class,"destroy"])->name('deleteProduct');
        Route::get('/edit-product/{id}',[adminProductController::class , 'edit'])->name('editProduct');
        Route::post('/update-product/{id}',[adminProductController::class , 'update'])->name('updateProduct');
        Route::get('/delete-product-video/{id}',[adminProductController::class , 'destroyVideo'])->name('deleteProductVideo');
        Route::get('/delete-product-main-image/{id}',[adminProductController::class , 'destroyMainImage'])->name('deleteProductMainImage');
        Route::get('/delete-product-image-1/{id}',[adminProductController::class , 'destroyImage1'])->name('deleteProductImage1');
        Route::get('/delete-product-image-2/{id}',[adminProductController::class , 'destroyImage2'])->name('deleteProductImage2');
        Route::get('/admin-banner',[adminBannerController::class,"index"])->name('adminBanner');
        Route::get('create-banner',[adminBannerController::class,"create"])->name('createBanner');
        Route::post('/submit-create-banner',[adminBannerController::class,"store"])->name('storeBanner');
        Route::post('/update-banner-status',[adminBannerController::class,"updateStatus"])->name('updateBannerStatus');
        Route::get('/edit-banner/{id}',[adminBannerController::class,"edit"])->name('editBanner');
        Route::post('/update-banner/{id}',[adminBannerController::class,"update"])->name('updateBanner');
        Route::get('/delete-banner/{id}',[adminBannerController::class,"destroy"])->name('deleteBanner');
        Route::get('/crm/index',[authController::class,"index"])->name('cms.index');
        Route::post('send-coupon/{id}',[authController::class,"send"])->name('cms.send.coupon');
        Route::controller(adminCouponController::class)->prefix('coupon')->group(function (){
            Route::get('/index','index')->name('coupon.index');
            Route::get('/create','create')->name('coupon.create');
            Route::post('/store-coupon','store')->name('coupon.store');
            Route::get('/edit/{id}','edit')->name('coupon.edit');
            Route::post('/update/{id}','update')->name('coupon.update');
            Route::get('/destroy/{id}','destroy')->name('coupon.delete');
        });
        Route::controller(adminOrderController::class)->prefix('order')->group(function (){
            Route::get('/index','index')->name('order.index');
            Route::get('/update/{id}','update')->name('admin.order.update');
            Route::get('/submit-update/{id}','submitUpdate')->name('submit.update.order');
            Route::get('/print-pdf/{id}','printPdf')->name('print.pdf');
        });
        Route::get('/index',[ratingController::class,'index'])->name('rate.index');
        Route::get('/updateStatus/{id}',[ratingController::class,'updateStatus'])->name('rate.update.status');
        Route::get('/contacts/index',[ContactUsController::class,'index'])->name('contact.index');
        Route::get('/contacts/delete/{id}',[ContactUsController::class,'destroy'])->name('contact.delete');
    });



