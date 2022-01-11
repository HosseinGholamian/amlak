@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین  | کامنت 
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
                        <span><a href="#" class="btn btn-success disabled">ایجاد</a></span>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="">
                                <table class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>کاربر</th>
                                        <th>نظر</th>
                                        <th>وضعیت</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($comments as $comment){ ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1"><?= $comment->id ?></td>
                                            <td><?= $comment->parentUser()->first_name . " ". $comment->parentUser()->last_name?></td>
                                            <td><?= substr(html_entity_decode($comment->comment),0,50) ?></td>
                                            <td><span class="  <?= $comment->approved == 1 ? 'text-success' :  'text-danger' ?>"><?= $comment->approved == 0 ? "در انتظار تایید" : "تایید شده"  ?></span></td>
                                            <td>
                                               
                                                <a href="<?= route('admin.comment.show' , [$comment->id]) ?>" class="btn btn-success waves-effect waves-light">نمایش</a>
                                                <form  class="d-inline" action="<?= route('admin.comment.approved' , [$comment->id])  ?>"   method="POST">
                                                <input type="hidden" name="_method" value="put">
                                                <button  class="btn  <?= $comment->approved == 0 ? 'btn-warning' :  'btn-danger' ?>      waves-effect waves-light"><?= $comment->approved == 0 ? 'تایید  ' :'لغو تایید'  ?></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php } ?>

                                     
                                    </tbody>
                                </table>
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
