@extends('admin.layouts.app')
@section('head-tag')
    <title>ادمین | ویرایش دسته بندی </title>
@endsection

@section('content')
    <div class="content-body">
        <!-- Zero configuration table -->
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">آگهی</h4>
                            <span><a href="<?= route("admin.ads.create") ?>" class="btn btn-success">ایجاد</a></span>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">

                                <div class="">
                                    <table class="table zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>عنوان</th>
                                                <th>دسته</th>
                                                <th>آدرس</th>
                                                <th>تصویر</th>
                                                <th>مشخصات</th>
                                                <th>تگ</th>
                                                <th>کاربر</th>
                                                <th style="width: 22rem;">تنظیمات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ads as $ads) { ?>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1"><?= $ads->id ?></td>
                                                    <td><?= $ads->title ?> </td>
                                                    <td><?= $ads->parentCat()->name ?></td>
                                                    <td><?= $ads->address ?> </td>
                                                    <td><img style="width: 90px;"
                                                            src="<?= asset($ads->image) ?>" alt=""></td>
                                                    <td>
                                                        <ul>
                                                            <li>floor : <?= $ads->floor ?></li>
                                                            <li>year :<?= $ads->year ?> </li>
                                                            <li>storeroom : <?= $ads->storeroom ?></li>
                                                            <li>balcony :<?= $ads->balcony ?> </li>
                                                            <li>area :<?= $ads->area ?> </li>
                                                            <li>room :<?= $ads->room ?>  </li>
                                                            <li>toilet : <?= $ads->toilet ?>  </li>
                                                            <li>parking :<?= $ads->parking ?> </li>
                                                        </ul>
                                                    </td>
                                                    <td><?= $ads->tag ?>  </td>
                                                    <td><?= $ads->ParentUser()->first_name . ' ' . $ads->ParentUser()->last_name ?></td>
                                                    <td style="width: 22rem;">
                                                        <a href="<?= route('admin.ads.gallery', ['id'=>$ads->id]) ?>" class="btn btn-warning waves-effect waves-light">گالری</a>
                                                        <a href="<?= route('admin.ads.edit', ['id'=>$ads->id]) ?>" class="btn btn-info waves-effect waves-light">ویرایش</a>
                                                        <form class="d-inline" action="<?= route('admin.ads.delete', ['id'=>$ads->id]) ?>" method="post">
                                                            <input type="hidden" name="_method" value="delete">
                                                            <button type="submit"
                                                                class="btn btn-danger waves-effect waves-light">حذف</button>
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
