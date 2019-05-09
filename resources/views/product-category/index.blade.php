@extends('layouts.app')
<div class="banner_cat"  style="background: linear-gradient(0deg,rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.8)), url('https://cdn2.house3d.com//app/webroot/assets/secthree_platform1_042841d0d1f43c3cf5b82f0c98086599.jpg');">
    <div class="banner_cat_in">
        <div class="banner_cat_in_tit text-center">
            <h1>PRODUCTS AND SERVICES</h1>
        </div>

        <div class="banner_cat_in_des text-center">
            <p>Designing, Rendering & eCommerce Platforms</p>
        </div>
    </div>
</div>

<section class="secone_services">
    <div class="container-fluid">
        <div class="text-center secone_title">
            <h1>test <br> test test test </h1>
            <div class="line_title"></div>
        </div>
        @foreach($product_categories as $key)
            <div class="h3d-container">
                <div class="row">
                    <div class="col-lg-4 sectwosub_contai">
                        <a class="link_jump" href="../public/{{$key->slug}}">
                            <div class="sectwosub sectwosub1">
                                <div class="sectwosub_img">
                                    <img src="../public/uploads/{{$key->image}}" class="img-fluid">
                                </div>
                                <div class="sectwo_tit text-center">
                                    <h1>{{$key->title_en}}</h1>
                                </div>
                                <div class="sectwo_des text-center">
                                    <p>{{$key->description_en}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>