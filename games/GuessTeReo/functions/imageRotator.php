<script>
    jQuery(document).ready(function ($) {

        var _SlideshowTransitions = [];

        var options = {
            $AutoPlay: false,
            $AutoPlaySteps: 1,
            $AutoPlayInterval: 4000,
            $PauseOnHover: 1,

            $ArrowKeyNavigation: true,
            $SlideDuration: 500,
            $MinDragOffsetToSlide: 20,
            $SlideSpacing: 0,
            $DisplayPieces: 1,
            $ParkingPosition: 0,
            $UISearchMode: 1,
            $PlayOrientation: 1,
            $DragOrientation: 3,

            $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: _SlideshowTransitions,
                $TransitionsOrder: 1,
                $ShowLink: true
            },

            $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $ChanceToShow: 2,
                $AutoCenter: 0,
                $Steps: 1,
                $Lanes: 1,
                $SpacingX: 10,
                $SpacingY: 10,
                $Orientation: 1
            },

            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $ChanceToShow: 2
            }
        };

        //var jssor_slider2 = new $JssorSlider$("slider2_container", options);

        //responsive code begin
        //you can remove responsive code if you don't want the slider scales while window resizes
        function ScaleSlider() {
            var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
            if (parentWidth)
                jssor_slider2.$ScaleWidth(Math.min(parentWidth, 600));
            else
                window.setTimeout(ScaleSlider, 30);
        }

        //ScaleSlider();

        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);

        //responsive code end
    });
</script>
<!-- To move inline styles to css file/block, please specify a class name for each element. -->
<div id="slider2_container" style="position: relative; width: 600px;
        height: 300px; margin-left: auto;
    margin-right: auto;">

    <!-- Loading Screen -->
    <div u="loading" style="position: absolute;">
        <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000; ;width: 100%;height:100%;">
        </div>
        <div style="position: absolute; display: block; background: url(src/img/loading.gif) no-repeat center center;
                width: 100%;height:100%;">
        </div>
    </div>

    <!-- Slides Container -->
    <div u="" style="cursor: move; position: absolute; width: 600px; height: 300px;
            overflow: hidden;">
        <div>
            <a u="image" href="#" style="display: block; width: 600px; height: 300px;
            top: 0px; left: 0px; position: relative;"><img class="currentImage" src="" border="0" style="width: 540px;
             height: 300px; top: 0px; left: 0px; position: absolute;"></a>
        </div>
        <!--
        <div>
            <a u="image" href="#" style="display: block; width: 600px; height: 300px;
            top: 0px; left: 0px; position: relative;"><img src="src/gameImages/img2.jpg" border="0" style="width: 540px;
             height: 300px; top: 0px; left: 0px; position: absolute;"></a>
        </div>

        <!--
        <div>
            <a u="image" href="#" style="display: block; width: 600px; height: 300px;
            top: 0px; left: 0px; position: relative;"><img src="src/gameImages/img3.jpg" border="0" style="width: 540px;
             height: 300px; top: 0px; left: 0px; position: absolute;"></a>
        </div>
        <div>
            <a u="image" href="#" style="display: block; width: 600px; height: 300px;
            top: 0px; left: 0px; position: relative;"><img src="src/gameImages/img4.jpg" border="0" style="width: 540px;
             height: 300px; top: 0px; left: 0px; position: absolute;"></a>
        </div>-->
    </div>

    <style>
        .jssorb01 {
            position: absolute;
        }

        .jssorb01 div, .jssorb01 div:hover, .jssorb01 .av {
            position: absolute;
            /* size of bullet elment */
            width: 12px;
            height: 12px;
            filter: alpha(opacity=70);
            opacity: .7;
            overflow: hidden;
            cursor: pointer;
            border: #000 1px solid;
        }

        .jssorb01 div {
            background-color: gray;
        }

        .jssorb01 div:hover, .jssorb01 .av:hover {
            background-color: #d3d3d3;
        }

        .jssorb01 .av {
            background-color: #fff;
        }

        .jssorb01 .dn, .jssorb01 .dn:hover {
            background-color: #555555;
        }
    </style>

    <!-- bullet navigator container
    <div u="navigator" class="jssorb01" style="bottom: 16px; right: 10px;">
        <!-- bullet navigator item prototype
        <div u="prototype"></div>
    </div>  -->

    <!--#region Arrow Navigator Skin Begin -->
    <style>
        .jssora05l, .jssora05r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 40px;
            height: 40px;
            cursor: pointer;
            background: url(src/img/a17.png) no-repeat;
            overflow: hidden;
        }
        .jssora05l { background-position: -10px -40px; }
        .jssora05r { background-position: -70px -40px; }
        .jssora05l:hover { background-position: -130px -40px; }
        .jssora05r:hover { background-position: -190px -40px; }
        .jssora05l.jssora05ldn { background-position: -250px -40px; }
        .jssora05r.jssora05rdn { background-position: -310px -40px; }
    </style>
    <!-- Arrow Left
        <span u="arrowleft" class="jssora05l" style="top: 123px; left: 8px;">
        </span>
    Arrow Right
        <span u="arrowright" class="jssora05r" style="top: 123px; right: 8px;">
        </span>-->
</div>