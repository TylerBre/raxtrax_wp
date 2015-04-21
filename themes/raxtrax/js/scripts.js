var JohnSplithoffSite = (function () {
    var App = function (o) {
        var self = this;

        this.$window   = $(window);
        this.$sections = $(".section");
        this.$spacers  = $(".spacer");
        this.$carousel = $(".carousel");
        this.$captions = $(".caption");
        this.$images   = $("#images");

        setSectionHeights();

        this.$window.resize(setSectionHeights);

        this.$carousel
            .carousel({
                interval: o.carouselSpeed,
                pause: ""
            })
            .on("slide.bs.carousel", function() {
                var $oldTracker = $(".tracker"),
                    $newTracker = $oldTracker.clone(true);

                $oldTracker.before($newTracker);
                $newTracker.addClass("animating");
                $oldTracker.remove();

                nextCaption();
            });

        $(".pin-top").each(function() {
            var $this = $(this);

            $this.affix({
                offset: {
                    top: $this.offset().top
                }
            });
        });

        $(".pin-to-header").each(function () {
            var $this = $(this);

            $(this).affix({
                offset: {
                    top: $this.offset().top - $("#header").height() - 4
                }
            });
        });

        $(".pin-to-nav").each(function () {
            var $this = $(this);

            if ($this.hasClass("showsimg")) {
                var $bio = $("#bio .container");

                additionalSpace = numberFromPX($bio.css('padding-top')) + numberFromPX($bio.css("padding-bottom"));
            } else {
                additionalSpace = 0;
            }

            $(this).affix({
                offset: {
                    top: $this.offset().top - $(".nav-menu").height() - $(".aux-menu").height() - 4 - additionalSpace
                }
            });
        });

        $(".scroll-top").on("click", function (e) {
            e.preventDefault();
            self.$window.scrollTop(0);
        });

        $("#jsNavMenu a").each(function () {
            var $this = $(this);

            if (isMediaLink($this.attr("href"))) $this.attr("target", "_blank");
        });


        function isMediaLink (href) {
            var isHashLink = new RegExp(/^(\/#)/);
            var containsDomain = new RegExp(/(johnsplithoff.)/);

            return !(href == "/" || isHashLink.test(href) || containsDomain.test(href));
        }

        function numberFromPX (str) {
            return parseInt(str.split("px")[0], 10);
        }

        function getHeight () {
            return self.$window.height();
        }

        function setSectionHeights () {
            var height = getHeight(),
                sectionHeight = (height < o.carouselMaxHeight) ? height : o.carouselMaxHeight;

            // self.$sections.css('min-height', sectionHeight);
            self.$spacers.css('height', sectionHeight);
        }

        function nextCaption () {
            var $activeCaption = self.$captions.filter(".active"),
                nextIndex      = ($activeCaption.index() + 1) % self.$captions.length,
                $nextCaption   = self.$captions.eq(nextIndex);

            $([$activeCaption, $nextCaption]).toggleClass("active");
        }
    };

    return App;
}(jQuery));

$(function () {
    var JSSite = new JohnSplithoffSite({
        carouselMaxHeight: 1080,
        carouselSpeed: 8000
    });

    var AW = new AudioWidget({
        container: "#player-playlist",
        filePath: "/wp-content/themes/jsplithoff/audio/",
        progressSlider: false
    });

    AW.playlist.call(AW);

});