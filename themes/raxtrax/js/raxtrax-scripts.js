// START SCRIPTS

/* See if the browser supports css3 attributes
*/
var supports = function() {
   var div = document.createElement('div'),
      vendors = 'Khtml Ms O Moz Webkit'.split(' '),
      len = vendors.length;

   return function(prop) {
      if ( prop in div.style ) return true;

      prop = prop.replace(/^[a-z]/, function(val) {
         return val.toUpperCase();
      });

      while(len--) {
         if ( vendors[len] + prop in div.style ) {
            // browser supports box-shadow. Do what you need.
            // Or use a bang (!) to test if the browser doesn't.
            return true;
         }
      }
      return false;
   };
};

if ( supports('background-clip') ) {
    jQuery('#issue-description h1').addClass("beautify-header");
    jQuery('#issue-description h2').addClass("beautify-subheader");
}
/* Author:
    Tyler Breland. January, 2011.
*/
function getDimensions() {
  var winW, winH;
  if (document.body && document.body.offsetWidth) {
    winW = document.body.offsetWidth;
    winH = document.body.offsetHeight;
  }
  if (document.compatMode == 'CSS1Compat' && document.body && document.body.offsetWidth) {
    winW = document.documentElement.offsetWidth;
    winH = document.documentElement.offsetHeight;
  }
  if (window.innerWidth && window.innerHeight) {
    winW = window.innerWidth;
    winH = window.innerHeight;
  }
  return [winW, winH];
}

function setSizes(w, h) {
    var contentWidth = (w - 232) + "px";
    var contentHeight = (h - 34) + "px";
    var sectionHeight = (h - 369) + 43 + "px";
    $("#content").css({'height': contentHeight, 'width': contentWidth});
    $("#navigation section").css('height', sectionHeight);

}

function validateSize() {
    var dimensions = getDimensions();
    if ( dimensions[0] > 1000 ) {
        $('body').css({'width': '100%','overflow-x': 'hidden'});
        setSizes(dimensions[0], dimensions[1]);
    } else if ( dimensions[0] < 481 ) {
        $('body').css({'width': '100%','overflow-x': 'hidden'});
        preventGallery();
    } else if ( dimensions[0] < 1000 && dimensions[0] > 481 ) {
        $('body').css({'width': '1000px','overflow-x': 'scroll'});
        setSizes(1000, dimensions[1]);
    }
}

validateSize();

$(window).resize(function() {
    validateSize();
});

// GALLERY
var interval;
var slideshowSpeed = 1000;
var currentImg = 0;
var animating = false;
var photos = galleryImages();
var previewNumber = photos.length;

function galleryMode() {
    var windowXY = getDimensions();
    var newWidth = windowXY[0] - 58;
    $('#container').css('overflow', 'hidden');
    $('#navigation section, #content').delay(200).animate({
        'opacity': '0'
    }, 500, function() {
        $('#navigation').animate({
            'right': '-174px'
        }, 500);
        $('#content').animate({
            'width': newWidth + "px"
        }, 500);
    });
    // Add the image controls
    $("#navigation").append("<div id='gallery-controls'><div>GALLERY CONTROL</div><div><a href='#' class='image-control control play'></a><a href='#' class='image-control prev'></a><a href='#' class='image-control next'></a></div></div>");
    // Set the BG image to the first image.
    $("#container").css('background-image', "url('"+photos[0][1].src+"')");
    // exit the gallery mode.
    $("nav a, #nav-links-container .image-gallery-link, #nav-links-container .home").click(function(e) {
        e.preventDefault();
        var loc = $(this).attr('href');
        $('#navigation').animate({'right': '0'}, 500);
        $('#content, #navigation section').animate(
        {'opacity': '1'}, 1000, function(event) {
            window.location = loc;
        });
    });
}

function preventGallery() {
    var url = window.location.pathname;
    if ( url.match(/gallery/) ) {
        $('#container').removeClass('gallery');
        window.location = '/';
    }
}
// While there is a gallery class ...
if ($("#container").hasClass('gallery')) {
    $(".image-gallery-link").click(function(e) {
        e.preventDefault();
    });
    galleryMode();
}

// This Changes the state of the play/pause button
$(".image-control").live("click", function(event) {
    var child;
    event.preventDefault();
    // play/pause gallery
    if ( $(this).hasClass('play') ) {
        // Change the background image to "pause"
        $(this).removeClass("play").addClass('pause');
        // Show the next image
        child = navigateImage("next");
        changeImage(child);
        // Start playing the animation
        animating = true;
        interval = setInterval(function() {
            var child = imageIndex("next");
            changeImage(child);
        }, slideshowSpeed );

    } else if ( $(this).hasClass('pause') ) {
        stopAnimating();
    }

    // next/previous image
    if ( $(this).hasClass('next') ) {
        child = navigateImage("next");
        changeImage(child);
    } else if ( $(this).hasClass('prev') ) {
        child = navigateImage("prev");
        changeImage(child);
    }
});

// left/right buttons to toggle images
$('body').keydown(function(event) {
    var child;
    if ( event.keyCode == 37 ) { // left button
        child = navigateImage("prev");
        changeImage(child);
    } else if ( event.keyCode == 39 ) { // right button
        child = navigateImage("next");
        changeImage(child);
    }
});

function stopAnimating() {
    // Change the background image to "play"
    $(".control").removeClass("pause").addClass("play");
    // Clear the interval
    clearInterval(interval);
    animating = false;
}

function galleryImages() {
    var photos = [];
    $("#content img").each(function(key, val) {
        var title = $(this).attr('title');
        var src = $(this).attr('src');
        var image = new Image();
        image.src = src;
        photos[key] = new Array(title, image);
    });
    return photos;
}

$(".toggle-info, #studio-map a, .tabrow a, #page-desctription a").live("click",function(e) {
    e.preventDefault();
});

function navigateImage(direction) {
    // Check if no animation is running. If it is, prevent the action
    if (animating === true) stopAnimating();
    // Check which current image we need to show
    return imageIndex(direction);
}

function imageIndex(direction) {
  var increment;
    if (direction == "next") {
        currentImg++;
        increment = 1;
    } else if (direction == "prev" ) {
        currentImg--;
        increment = 0;
    }
    if (currentImg == photos.length + increment) {
        currentImg = 1;
    }
    var child = ((( currentImg % previewNumber ) + previewNumber ) % previewNumber );
    return child;
}
function changeImage(child) {
    $("#container").css('background-image', "url('"+photos[child][1].src+"')");
}
// END GALLERY

// STUDIOS PAGE
$('a.to-gallery').live("click", function() {
    var dimensions = getDimensions();
    if ( dimensions[0] > 480 ) {
        $(this).closest('form').submit();
        return false;
    }
});

// whaaaaaaaaaaaaaat
var areaHash = [];
areaHash.livea = 1;
areaHash.controla = 2;
areaHash.liveb = 3;
areaHash.controlb = 4;
areaHash.lounge = 5;
areaHash.isob = 6;
areaHash.isoa = 7;

studioMapToggle(2);

$("#studio-map a").live("click",function(e) {
    if ($("#studio-map a").hasClass('active') ) {
        $("#studio-map a").removeClass('active');
    }
    var studio = $(this).attr('rel');
    var room = $(this).attr('class');
    $(this).addClass('active');
    toggleRoomContainer(studio, room);
    var id = $(this).attr("id");
    getIncrement(id);
});
//this shows/hides the room details
function toggleRoomContainer(studio, room) {
    var previous = $(".col2 .active").attr('class');
    var previousClassArray = previous.split(" ");
    var previousElement = $(".col2 ."+previousClassArray[0]+"."+previousClassArray[1]);
    var nextElement = $(".col2 ."+studio+"."+room);
    var content = $(".col2 article");
    toggleContent(previousElement,nextElement, content, 150);
}

function toggleContent(previous, next, content, speed) {
    $(previous).fadeOut(speed, function() {
        $(content).removeClass('active').addClass('hidden');
        $(next).removeClass('hidden').fadeIn(speed, function() {
            $(this).addClass('active');
            //initialize the scrollbars
            $('.nano', this).nanoScroller();
        });
    });
}

function getIncrement(id) {
  var increment;
  for (var i in areaHash) {
    if ( id == i ) increment = areaHash[i];
  }
  studioMapToggle(increment);
}
//this toggles to image map background
function studioMapToggle(increment) {
    $('#studio-map').css('background-position', "0 " + (-381 * increment) + "px");
}
// END IMAGE MAP

// GEAR PAGE
$(".tabrow li > a").live("click", function() {
    var previousItem = $(".tabrow .active").attr("class");
    var previous = "#"+previousItem.split(" ")[0];
    var tab = $(this).closest("li");
    var nextItem = $(tab).attr("class").split(" ")[0];
    var next = "#"+nextItem;
    var content = $(".container.gear");
    $(".tabrow li").removeClass("active");
    $(tab).addClass("active");
    toggleContent(previous, next, content, 0);
    $('.container.active .nano').nanoScroller();
});

// PAGE DESCRIPTIONS

function descriptionToggle(link) {
    $("#page-description .toggle-info").removeClass("active");
    $(link).addClass("active");
    var descriptions = $("#page-description .description");
    var previousName = $("#page-description a.active").attr("class").split(" ")[1];
    var nextName = $(link).attr("class").split(" ")[1];
    var previous = $(descriptions).closest(".description."+previousName);
    var next = $(descriptions).closest(".description."+nextName);
    toggleContent(previous, next, descriptions, 0);
}
$("#page-description a, .bs-toggle").live("click", function() {
    return false;
});

$(".bs-toggle").live("click", function() {
    var page = $(this).attr("rel");
    $(".blackspade article .active").removeClass("active").addClass("hidden");
    $(".blackspade article ." + page).removeClass("hidden").addClass("active");
    $(".blackspade article .nano.active").nanoScroller();
});

// $('.bx-prev, .bx-next').live("click", function() {
//   populateSlideshowDivs();
// })
// function populateSlideshowDivs() {
//   $("#slider1 div").each(function (i, l) {
//     var imgSrc = $('img', l).attr('src');
//     jQuery(l).css('background-image', 'url('+imgSrc+')');
//   });
// }
// populateSlideshowDivs();

$('#cart-container').on("mouseover mouseout", '.minicart-row', function(event) {
    var $closeLink = $('.toggle-item', this);
    if (event.type == 'mouseover') {
      $closeLink.toggleClass('hidden');
    } else {
      $closeLink.toggleClass('hidden');
    }
    event.stopPropagation();
});
function removeLineItem(parentRow, state, boolInput, theLink) {
  if (state == 'remove') {
    $(theLink).html("<span>+</span>Undo remove");
    $('.fields', parentRow).animate({opacity: '0.3'}, 300, function() {
      $('input[type="text"]', parentRow).attr('disabled', true);
      $(boolInput).val("on");
    });
  } else {
    $(theLink).html("<span>X</span>Remove");
    $('.fields', parentRow).animate({opacity: '1'}, 50, function(){
      $('input', parentRow).removeAttr('disabled');
      $(boolInput).val("off");
    });
  }
}
function activateSubmitButton() {
  $("#cart_submit").removeAttr('disabled').addClass("active");
}
$('#cart-container').on("click", ".toggle-item", function() {
  $(this).toggleClass("remove");
  var state = $(this).attr('class').split(" ")[1];
  var parentRow = $(this).parents(".minicart-row");
  var boolInput = $(this).next('.delete-item');
  removeLineItem(parentRow, state, boolInput, this);
  activateSubmitButton();
  return false;
});

$("#cart-container").on("submit", ".edit_cart", function(event) {
 // console.log("update cart submitted");
 ajaxUpdateCart(this.action, jQuery(this).serialize());
 return false;
});
$(".minicart-row input[type='text']").live("change", function() {
  activateSubmitButton();
});
/*$("#cart-container").on("click", ".cart-icon, .hide-cart", function(event) {
  $('.cart-form-container').toggleClass("hidden");
  return false;
});*/
$('.cart-form-container').addClass("hidden");
$("#content .store .col2 form").live('submit', function(event) {
   ajaxUpdateCart(this.action, jQuery(this).serialize());
   return false;
});

function ajaxUpdateCart(action, data) {
  $.post(action, data, function(data) {
    console.log(data);
    $("#cart-container").removeClass('hidden').html(data);
    $('.cart-form-container').addClass("hidden");
  });
}

function scrollContentInsets(content) {
  var insetShadow = $(content).parent("section").prev("section").find(".inset-shadow");
  var scrollPx = $(content).scrollTop();
  // console.log(insetShadow.css('opacity'));
  if ( scrollPx > 21 && insetShadow.css('opacity') == "1" ) {
    return false;
  } else if ( scrollPx > 21 ) {
    insetShadow.css('opacity', '1');
  } else if ( scrollPx < 21 ) {
    var moduloHeight = scrollPx / 20;
    insetShadow.css('opacity', moduloHeight);
    // console.log("fading the overlay");
  }
  // console.log(moduloHeight);
}



// after

$('.head .inset-shadow').css('opacity', '0');
$('.scrollable-content .content').scroll(function() {
  scrollContentInsets(this);
});

if ($('article img').length) {
  $('article img:last-child').load(function() {
    $('article.active .nano').nanoScroller();
  });
} else {
  $('.nano').nanoScroller();
}
