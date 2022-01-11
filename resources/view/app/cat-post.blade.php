@extends('app.layouts.app')

@section('head-tag')
<title>املاک | پست ها</title>
@endsection

@section('content')
<div class="hero-wrap" style="background-image: url(<?= asset('admin-assets/images/bg_1.jpg') ?>);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">خانه</a></span> <span>بلاگ</span></p>
                <h1 class="mb-3 bread">بلاگ ها</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row d-flex">
            <?php foreach(paginate($posts,4) as $post){ ?>
            <div class="col-md-3 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch">
                    <a href="<?= route('post.home', [$post->id]) ?>" class="block-20"
                        style="background-image: url('<?= asset($post->image) ?>');">
                    </a>
                    <div class="text mt-3 d-block">
                        <h3 class="heading mt-3"><a href="<?= route('post.home', [$post->id]) ?>"><?=  $post->title?></a></h3>
                        <div class="meta mb-3">
                            <div><a href="#"><?= \Morilog\Jalali\Jalalian::forge($post->created_at)->format('%B %d، %Y') ?></a></div>
                            <div><a href="#"><?= $post->parentUser()->first_name . " ". $post->parentUser()->last_name   ?></a></div>
                            <div><a href="#" class="meta-chat"><span class="icon-chat"></span><?= count($post->childComment()->get()) ?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php  } ?>
          
        </div>
        <?= paginateView($posts , 4) ?>
    </div>
</section>


@endsection