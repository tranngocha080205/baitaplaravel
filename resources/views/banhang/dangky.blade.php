@extends('layoutbanhang.master')

@section('content')
<div class="container">
    <div id="content">
        <form action="{{ route('auth.signin') }}" method="post" class="beta-form-checkout">
            @csrf
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <h4>Đăng ký</h4>
                    <div class="space20">&nbsp;</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $err)
                                <p>{{ $err }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="Email address">
                    </div>

                    <div class="form-block">
                        <label for="name">Name*</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control" placeholder="Your name">
                    </div>

                    <div class="form-block">
                        <label for="address">Address*</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" required class="form-control" placeholder="Street Address">
                    </div>

                    <div class="form-block">
                        <label for="phone_number">Phone*</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required class="form-control" placeholder="Phone number">
                    </div>

                    <div class="form-block">
                        <label for="password">Password*</label>
                        <input type="password" id="password" name="password" required class="form-control" placeholder="Password">
                    </div>

                    <div class="form-block text-center">
                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection

@section('css')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BetaDesign</title>
<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/dest/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
<link rel="stylesheet" title="style" href="assets/dest/css/style.css">
<link rel="stylesheet" href="assets/dest/css/animate.css">
<link rel="stylesheet" title="style" href="assets/dest/css/huong-style.css">
@endsection

@section('js')
<script src="assets/dest/js/jquery.js"></script>
<script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
<script src="assets/dest/vendors/animo/Animo.js"></script>
<script src="assets/dest/vendors/dug/dug.js"></script>
<script src="assets/dest/js/scripts.min.js"></script>
<script type="text/javascript">
    $(function() {
        var url = window.location.href;
        $(".main-menu a").each(function() {
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
                $(this).parents('li').addClass('parent-active');
            }
        });
    });
</script>
<script>
    jQuery(document).ready(function($) {
        'use strict';
        jQuery('#style-selector').animate({
            left: '-213px'
        });

        jQuery('#style-selector a.close').click(function(e){
            e.preventDefault();
            var div = jQuery('#style-selector');
            if (div.css('left') === '-213px') {
                jQuery('#style-selector').animate({
                    left: '0'
                });
                jQuery(this).removeClass('icon-angle-left');
                jQuery(this).addClass('icon-angle-right');
            } else {
                jQuery('#style-selector').animate({
                    left: '-213px'
                });
                jQuery(this).removeClass('icon-angle-right');
                jQuery(this).addClass('icon-angle-left');
            }
        });
    });
</script>
@endsection
