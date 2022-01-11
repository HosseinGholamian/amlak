@extends('admin.layouts.app')
@section('head-tag')
<title>ادمین | ویرایش اخبار جدید</title>
@endsection
@section('content')
<div class="content-body">
   <!-- Zero configuration table -->
   <section id="basic-datatable">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">پست</h4>
                  <span><a href="<?= route('admin.post.index') ?>" class="btn btn-success">بازگشت</a></span>
               </div>
               <div class="card-content">
                  <div class="card-body card-dashboard">
                     <form class="row" action="<?= route('admin.post.update',[$post->id]) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="put">
                        <div class="col-md-6">
                           <fieldset class="form-group">
                              <label for="title">عنوان</label>
                              <input value="<?= oldOrValue('title', $post->title) ?>" name="title" type="text" id="title" class="form-control <?= errorClass('title') ?>"
                                 placeholder="نام ...">
                              <?= errorText('title') ?>
                           </fieldset>
                        </div>
                        <div class="col-md-6">
                           <fieldset class="form-group">
                              <label for="published_at">تاریخ انتشار</label>
                              
                              <input value="<?= oldOrValue('published_at', date('Y-m-d',strtotime($post->published_at))) ?>" name="published_at" type="date" id="published_at"
                                 class="form-control  <?= errorClass('published_at') ?>">
                              <?= errorText('published_at') ?>
                           </fieldset>
                        </div>
                        <div class="col-md-6">
                           <fieldset class="form-group">
                              <label for="image">تصویر</label>
                              <input name="image" type="file" id="image" class="form-control-file <?= errorClass('image') ?>">
                              <img src="<?= asset($post->image) ?>" alt="<?= $post->title ?>" width="150" height="100" class="mt-4">
                              <?= errorText('image') ?>
                           </fieldset>
                        </div>
                        <div class="col-md-6">
                           <fieldset class="form-group">
                              <div class="form-group">
                                 <label for="cat_id">دسته</label>
                                 <select name="cat_id" class="select2 form-control <?= errorClass('cat_id') ?>">
                                    <?php foreach ($categories as $category) { ?>
                                    <option value="<?= $category->id ?>"  <?= oldOrValue('parent_id', $post->cat_id) == $category->id ? 'selected' : '' ?>><?= $category->name ?></option>
                                    <?php } ?>
                                 </select>
                                 <?= errorText('cat_id') ?>
                              </div>
                           </fieldset>
                        </div>
                        <div class="col-md-12">
                           <section class="form-group ">
                              <label for="body">متن</label>
                              <textarea class="form-control <?= errorClass('body') ?>" id="body" rows="5" name="body"
                                 placeholder="متن ..."><?= oldOrValue('body', $post->body) ?></textarea>
                           </section>
                           <?= errorText('body') ?>
                        </div>
                        <div class="col-md-6">
                           <section class="form-group">
                              <button type="submit" class="btn btn-primary">ویرایش</button>
                           </section>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
@endsection


@section('script')
<script src="<?= asset('ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'body', {
	filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
	filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
} );
</script>
@endsection