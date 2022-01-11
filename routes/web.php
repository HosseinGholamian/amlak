<?php

use System\Router\Web\Route;


// Public Routs
Route::get("/", "HomeController@index", "index.home");
Route::get("/home", "HomeController@index", "home.home");
Route::get("/about", "HomeController@about", "about.home");
Route::get("/ads/{id}", "HomeController@ads", "ads.home");
Route::get("/post/{id}", "HomeController@post", "post.home");
Route::post("/post/comment/{id}", "HomeController@postComment", "post.comment.home");
Route::get("/ads", "HomeController@allAds", "all.ads.home");
Route::get("/posts", "HomeController@allPost", "all.post.home");
Route::get("/category/{id}", "HomeController@category", "category.home");
Route::get("/search", "HomeController@search", "search.home");

// End Public Routs


//Admin Section
Route::get("/admin", "Admin\AdminController@index", "admin.index");

//Category Routes
Route::get("/admin/category", "Admin\CategoryController@index", "admin.category.index");
Route::get("/admin/category/create", "Admin\CategoryController@create", "admin.category.create");
Route::post("/admin/category/store", "Admin\CategoryController@store", "admin.category.store");
Route::get("/admin/category/edit/{id}", "Admin\CategoryController@edit", "admin.category.edit");
Route::put("/admin/category/update/{id}", "Admin\CategoryController@update", "admin.category.update");
Route::delete("/admin/category/delete/{id}", "Admin\CategoryController@destroy", "admin.category.delete");
//End Category Routes

//Post Routes
Route::get('/admin/post', "Admin\PostController@index", 'admin.post.index');
Route::get("/admin/post/create", "Admin\PostController@create", "admin.post.create");
Route::post("/admin/post/store", "Admin\PostController@store", "admin.post.store");
Route::get("/admin/post/edit/{id}", "Admin\PostController@edit", "admin.post.edit");
Route::put("/admin/post/update/{id}", "Admin\PostController@update", "admin.post.update");
Route::delete("/admin/post/delete/{id}", "Admin\PostController@destroy", "admin.post.delete");
//End Post Routes



//Adds Routes
Route::get('/admin/ads', "Admin\AdsController@index", 'admin.ads.index');
Route::get("/admin/ads/create", "Admin\AdsController@create", "admin.ads.create");
Route::post("/admin/ads/store", "Admin\AdsController@store", "admin.ads.store");
Route::get("/admin/ads/edit/{id}", "Admin\AdsController@edit", "admin.ads.edit");
Route::put("/admin/ads/update/{id}", "Admin\AdsController@update", "admin.ads.update");
Route::delete("/admin/ads/delete/{id}", "Admin\AdsController@destroy", "admin.ads.delete");

Route::get("/admin/ads/gallery/{id}", "Admin\AdsController@gallery", "admin.ads.gallery");
Route::post("/admin/ads/store-gallery-image/{id}", "Admin\AdsController@storeGalleryImage", "admin.ads.store.gallery.image");
Route::delete("/admin/ads/delete-gallery-image/{id}", "Admin\AdsController@deleteGalleryImage", "admin.ads.delete.gallery.image");
//End Adds Routes


//Slide Routes
Route::get('/admin/slide', "Admin\SlideController@index", 'admin.slide.index');
Route::get("/admin/slide/create", "Admin\SlideController@create", "admin.slide.create");
Route::post("/admin/slide/store", "Admin\SlideController@store", "admin.slide.store");
Route::get("/admin/slide/edit/{id}", "Admin\SlideController@edit", "admin.slide.edit");
Route::put("/admin/slide/update/{id}", "Admin\SlideController@update", "admin.slide.update");
Route::delete("/admin/slide/delete/{id}", "Admin\SlideController@destroy", "admin.slide.delete");
//End Slide


//Slide Comment
Route::get('/admin/comment', "Admin\CommentController@index", 'admin.comment.index');
Route::get("/admin/comment/show/{id}", "Admin\CommentController@show", "admin.comment.show");
Route::put("/admin/comment/approved/{id}", "Admin\CommentController@approved", "admin.comment.approved");
Route::post("/admin/comment/answer/{id}", "Admin\CommentController@answer", "admin.comment.answer");
//End Comment 


//User Routes
Route::get('/admin/user', "Admin\UserController@index", 'admin.user.index');
Route::get("/admin/user/edit/{id}", "Admin\UserController@edit", "admin.user.edit");
Route::put("/admin/user/update/{id}", "Admin\UserController@update", "admin.user.update");
Route::get("/admin/user/userActive/{id}", "Admin\UserController@userActive", "admin.user.userActive");
//End User


//End Admin Section




//Auth routes
Route::get('/login', "Auth\LoginController@view", 'auth.login.view');
Route::post('/login', "Auth\LoginController@login", 'auth.login');
Route::get('/register', "Auth\RegisterController@view", 'auth.register.view');
Route::post('/register', "Auth\RegisterController@register", 'auth.register');
Route::get('/activation/{activate-token}', "Auth\RegisterController@activation", 'auth.activation');
Route::get('/forgot', "Auth\ForgotController@view", 'auth.forgot.view');
Route::post('/forgot', "Auth\ForgotController@forgot", 'auth.forgot');
Route::get('/reset-password/{token}', "Auth\ResetPasswordController@view", 'auth.reset-password.view');
Route::post('/reset-password/{token}', "Auth\ResetPasswordController@resetPassword", 'auth.reset-password');
Route::get('/logout', "Auth\LogoutController@logout", 'auth.logout');




//End Auth routes