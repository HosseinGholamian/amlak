@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین  | نمایش کامنت 
</title>
@endsection

@section('content')
<div class="content-body">
    <!-- Zero configuration table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">نظرات</h4>
                        <span><a href="<?= route('admin.comment.index') ?>" class="btn btn-success">بازگشت</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="row">
                                <div class="col-md-12">
                                    <h2><?= $comment->parentUser()->first_name ." ".$comment->parentUser()->last_name  ?></h2>
                                    <p><?= $comment->comment ?></p>
                                </div>

                                <div class="col-md-12 mt-4 pt-4 border-top">
                                    <form action="<?= route('admin.comment.answer' , [$comment->id]) ?>" method="post">
                                        <section class="form-group">
                                            <label for="comment">پاسخ</label>
                                            <textarea class="form-control  <?= errorClass('comment') ?>" id="comment" rows="5" name="comment" placeholder="پاسخ ..."><?= old('comment') ?></textarea>
                                            <?= errorText('comment') ?>
                                        </section>
                                        <div class="col-md-6">
                                            <section class="form-group">
                                                <button type="submit" class="btn btn-primary">ایجاد</button>
                                            </section>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Zero configuration table -->
</div>
@endsection
@section('script')
<script src="<?= asset('ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'comment', {
	filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
	filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
} );
</script>
@endsection