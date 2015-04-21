
var AudioWidget = function (o) {
    this.container    = $(o.container);
    this.audioElement = this.container.find("audio")[0];
    this.controls     = this.container.find(".controls");
    this.progress     = this.container.find(".media-progress");
    this.progressBar  = this.container.find(".progress-bar");

    this.setControls = {

        playPauseButton: function (state) {
            this.controls.find(".play-pause span").addClass("hidden");

            if (state) this.controls.find(".play-pause .pause").removeClass("hidden");
            if (!state) this.controls.find(".play-pause .play").removeClass("hidden");
        }
    };

    this.formatSeconds = function (seconds) {
        return (seconds < 10) ? "0" + seconds : seconds;
    };

    this.updateElapsedTime = function (currentTime) {

        var currentTime = (typeof currentTime != "undefined") ? currentTime : this.audioElement.currentTime,
            elapsedMinutes  = Math.floor(currentTime / 60),
            elapsedSeconds  = Math.floor(currentTime - elapsedMinutes * 60),
            elapsedTime     = elapsedMinutes + '.' + this.formatSeconds(elapsedSeconds);

        this.controls.find('.elapsed').html(elapsedTime);

    };

    this.updateDuration = function () {

        var durationMinutes = Math.floor(this.audioElement.duration / 60),
            durationSeconds = Math.floor(this.audioElement.duration % 60),
            duration        = durationMinutes + '.' + this.formatSeconds(durationSeconds);

        this.controls.find('.duration').html(duration);
    };

    this.updateProgress = function (percent) {

        var progress = (typeof percent != 'undefined') ?
                        percent :
                        (this.audioElement.currentTime / this.audioElement.duration) * 100;

        this.progressBar
            .attr('aria-valuenow', progress)
            .css('width', progress + '%');
    };

    this.updateHandle = function (percent) {

        var progress = (typeof percent != 'undefined') ?
                        percent :
                        (this.audioElement.currentTime / this.audioElement.duration) * 100;

        this.progress
            .find(".handle")
            .css('left', progress + '%');
    };

    this.getFileType = function () {
        return (Modernizr.audio.mp3) ? ".mp3" : ".ogg";
    };

    this.getFilePath = function () {

        return o.filePath;
    };

    this.getFileName = function ($track) {
        return (Modernizr.audio.mp3) ? $track.attr('data-mp3') : $track.attr('data-mp3');
    };

    this.setAudioFile = function ($track, autoplay) {

        // var fileType = this.getFileType(),
        //     filePath = this.getFilePath(),
        //     track    = filePath + filename + fileType;

        this.audioElement.src = this.getFileName($track);

        if (autoplay) this.playPause.call(this, true);
    };

    this.playPause = function (state) {

        this.setControls.playPauseButton.call(this, state);

        if (state)  this.audioElement.play();
        if (!state) this.audioElement.pause();
    };

    this.changeTrack = function (dir) { // takes a boolean

        function moveTrack (to) {

            var $currentTrack = this.container.find('.track.active'),
                $tracks       = this.container.find('.track'),
                autoplay      = (this.audioElement.ended) ? true : !this.audioElement.paused;

            if (to === "previous") {
                var toTrackIndex = ($currentTrack.index() === 0) ? $tracks.length - 1 : $currentTrack.index() - 1;
            }

            if (to === "next") {
                var toTrackIndex = ($currentTrack.index() + 1) % $tracks.length;
            }

            var $toTrack = $($tracks[toTrackIndex]);

            $tracks.removeClass("active");
            $toTrack.addClass("active");

            this.setAudioFile.call(this, $toTrack, autoplay);
        }

        // previous
        if (!dir) {

            // determine whether the user wants to go to the previous track
            // or just to the beginning of the song.
            // we accomplish this by checking the currentTime of the track:
            // if it is less than a set amount, we go to the previous track,
            // else, we just reset the transport head to the beggining.
            if (this.audioElement.currentTime < 2) {
                moveTrack.call(this, "previous");
            } else {
                this.audioElement.currentTime = 0;
            }
        }

        // next
        if (dir) moveTrack.call(this, "next");
    };

    this.stop = function () {

        this.playPause.call(this, false);
        this.audioElement.currentTime = 0;
    };

    this.playlist = function () {

        var self = this,
            firstTrack = this.container.find('.track:first-child');

        // set the src of the audio element to the first track.
        // if we don't do this, the browser cannot dispatch the 'timeupdate'
        // event.
        this.setAudioFile.call(this, firstTrack);

        this.container.find('.track').on('click', function () {

            var $this = $(this);

            self.setAudioFile.call(self, $this);
            self.playPause.call(self, true);

            $this.parent().find('.track').removeClass("active");
            $this.addClass("active");

        });

        this.controls.find(".play-pause").on('click', function () {
            var $tracks = self.container.find(".track");
            if (!$tracks.hasClass("active")) {
                $($tracks[0]).addClass("active");
            }

            self.playPause.call(self, self.audioElement.paused);
        });

        this.controls.find(".previous").on('click', function () {
            self.changeTrack.call(self, false);
        });

        this.controls.find(".next").on('click', function () {
            self.changeTrack.call(self, true);
        });

        this.controls.find(".stop").on('click', function () {
            self.stop.call(self);
        });

        this.reattachTimeupdateListener = function () {

            $(self.audioElement).on("timeupdate", function () {
                self.updateElapsedTime();
                // self.updateProgress();
                // 8self.updateHandle();
            });
        };

        $(self.audioElement).on({
            timeupdate    : function () {
                self.updateElapsedTime();
                // self.updateProgress();
                // 8self.updateHandle();
            },
            loadedmetadata: function () {
                self.updateDuration();
                // self.updateProgress();
            },
            ended         : function () {
                self.changeTrack.call(self, true);
            }
        });


        this.getScrubLocation = function (scrubDistance) {
            return scrubDistance / self.progress.find(".scrub-holder").width();
        };

        this.getScrubPercentage = function (scrubLocation) {
            return scrubLocation * 100;
        };

        this.getCurrentTimeFromScrub = function (scrubLocation) {
            return scrubLocation * self.audioElement.duration;
        };

        if (o.progressSlider) {

            this.progress
                .find(".scrub-holder")
                .on("click", function (e) {
                    var $this = $(this),
                        scrubDistance = e.pageX - $this.offset().left,
                        scrubLocation = self.getScrubLocation(scrubDistance),
                        percent       = self.getScrubPercentage(scrubLocation),
                        currentTime   = self.getCurrentTimeFromScrub(scrubLocation);

                    self.updateProgress.call(self, percent);
                    self.updateHandle.call(self, percent);
                    self.updateElapsedTime.call(self, currentTime);
                    self.audioElement.currentTime = currentTime;

                    return false;
                });

            this.progress
                .find(".handle")
                .draggable({
                    axis: "x",
                    containment: "parent",
                    drag: function (e, ui) {

                        var scrubLocation = self.getScrubLocation(ui.position.left),
                            percent       = self.getScrubPercentage(scrubLocation),
                            currentTime   = self.getCurrentTimeFromScrub(scrubLocation);


                        self.updateProgress.call(self, percent);
                        self.updateElapsedTime.call(self, currentTime);
                    },
                    start: function (e, ui) {
                        $(self.audioElement).off('timeupdate');
                    },
                    stop: function (e, ui) {

                        var scrubLocation             = self.getScrubLocation(ui.position.left);
                        self.audioElement.currentTime = self.getCurrentTimeFromScrub(scrubLocation);
                        self.reattachTimeupdateListener();
                    }
                });

        }
    };
};