<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title') - {{ config('app.name') }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css ') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/slick.css ') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/slick-theme.css ') }}"/>
  <link rel="stylesheet" href="{{ asset('site/css/style.css ') }}">
  <style type="text/css">
    .map-top{
      margin-top: 50px;
    }
  </style>
  @yield('styles')
  @stack('styles')
</head>
<body>
	@include('site.partials.header')
	@yield('content')
	@include('site.partials.footer')
<script src="{{ asset('site/js/jquery.min.js')}}"></script>
@stack('scripts')
<script src="{{ asset('site/js/popper.min.js')}}"></script>
<script src="{{ asset('site/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('site/js/slick.min.js')}}"></script>


<script type="text/javascript">

//community slider
$('.community-list').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
});

//business slider
$('.business-list').slick({
  dots: true,
  //infinite: false,
  speed: 300,
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
});


// counter
var a = 0;
$(window).scroll(function() {

  var oTop = $('.counter-list').offset().top - window.innerHeight;
  if (a == 0 && $(window).scrollTop() > oTop) {
    $('.counter-list li figure').each(function() {
      var $this = $(this),
        countTo = $this.attr('data-count');
      $({
        countNum: $this.text()
      }).animate({
          countNum: countTo
        },

        {

          duration: 1000,
          easing: 'swing',
          step: function() {
            $this.text(Math.floor(this.countNum));
          },
          complete: function() {
            $this.text(this.countNum);
            //alert('finished');
          }

        });
    });
    a = 1;
  }

});



$(document).ready(function(){
	$('.ham').click(function(e){
		e.stopPropagation();
		$('.navigation').toggleClass('slide');
	});

	$(document).click(function(){
		$('.navigation').removeClass('slide');
	});

	$('.navigation').click(function(e){
		e.stopPropagation();
	});

});




</script>



</body>
</html>