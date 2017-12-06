<!DOCTYPE html>
<html lang="en">

@include('includes.header')
@include('includes.navbar')
<body>

{{--<script src="/libs/scenejs/lib/require.js"></script>


<script src="/libs/scenejs/core/scenejs.js"></script>--}}
<script src="/libs/scenejs/api/latest/scenejs.js"></script>

<div id="home" class="jumbotron bg" style="margin-top:100px; height: 600px; ">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <!--Card-->
                <div class="card" style="margin-top:100px; height: 300px;">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="/img/logo.png" class="d-inline-block align-top" style="height: 150px; margin-top: 75px; margin-left: 20px">
                        </div>
                        <div class="col-md-9">
                            <!--Card content-->
                            <div class="card-body" style="padding-top: 95px; padding-left: 100px">
                                <!--Text-->
                                <p class="card-text">Completing the bridge among 3D modelers and customers</p>
                                <a href="/register" type="button" class="btn btn-outline-elegant waves-effect btn-sm">Register Today</a>
                            </div>
                        </div>
                    </div>

                </div>
                <!--/.Card-->
            </div>
            <div class="col-md-5">
                <!--Card-->
                <div class="card" style="margin-top: 50px; height: 400px; background: transparent;">
                    <!--Card content-->
                    <div class="card-body" style="margin-top: 100px; padding-left: 50px; background: transparent;">
                        <div class="container">
                            <canvas style="width: 100%; height: 100%; margin: 0; padding: 0;" id="intro-3d"></canvas>
                        </div>
                    </div>
                </div>
                <!--/.Card-->
            </div>
        </div>
    </div>
</div>

<!--Content-->
<div class="container" id="features">
    <div class="row my-5">
        <!--First columnn-->
        <div class="col-lg-4">
            <!--Card-->
            <div class="card card-dark wow fadeIn" data-wow-delay="0.4s">

                <!--Card image-->
                <i class="fa fa-upload fa-5x" aria-hidden="true"></i>
                {{--<img class="img-fluid" src="/img/features/up-down.jpg" alt="Card image cap">--}}

                <!--Card content-->
                <div class="card-body">
                    <!--Title-->
                    <h4 class="card-title">Upload, Download or Purchase 3D models</h4>
                    <!--Text-->
                    <p class="card-text">This is the market place to upload, download or purchase 3D models.</p>
                    {{--<a href="#" class="btn right btn-info">Read more</a>--}}
                </div>

            </div>
            <!--/.Card-->
        </div>
        <!--First columnn-->

        <!--Second columnn-->
        <div class="col-lg-4">
            <!--Card-->
            <div class="card card-dark wow fadeIn" data-wow-delay="0.2s">

                <!--Card image-->
                <i class="fa fa-user fa-5x" aria-hidden="true"></i>
                {{--<img class="img-fluid" src="/img/features/customer.jpg" alt="Card image cap">--}}

                <!--Card content-->
                <div class="card-body">
                    <!--Title-->
                    <h4 class="card-title">Customer or a 3D Model Designer</h4>
                    <!--Text-->
                    <p class="card-text">You can register as a Customer or a 3D Model Designer.</p>
                    {{--<a href="#" class="btn btn-info">Read more</a>--}}
                </div>

            </div>

            <!--/.Card-->

        </div>
        <!--Second columnn-->

        <!--Third columnn-->
        <div class="col-lg-4 mb-4">
            <!--Card-->
            <div class="card card-dark wow fadeIn" data-wow-delay="0.6s">

                <!--Card image-->
                <i class="fa fa-line-chart fa-5x" aria-hidden="true"></i>
                {{--<img class="img-fluid" src="/img/features/rate.jpg" alt="Card image cap">--}}

                <!--Card content-->
                <div class="card-body">
                    <!--Title-->
                    <h4 class="card-title">Rate and Annotate on 3D models</h4>
                    <!--Text-->
                    <p class="card-text">You can rate the 3D models and also comment on them.</p>
                    {{--<a href="#" class="btn btn-info">Read more</a>--}}
                </div>

            </div>
            <!--/.Card-->
        </div>
        <!--Third columnn-->
    </div>
    <div class="row my-5">
        <!--First columnn-->
        <div class="col-lg-4">
            <!--Card-->
            <div class="card card-dark wow fadeIn" data-wow-delay="0.2s">

                <!--Card image-->
                <i class="fa fa-exclamation-triangle fa-5x"  aria-hidden="true"></i>
                {{--<img class="img-fluid" src="/img/features/notifications.jpeg" alt="Card image cap">--}}

                <!--Card content-->
                <div class="card-body">
                    <!--Title-->
                    <h4 class="card-title">Notifications</h4>
                    <!--Text-->
                    <p class="card-text">You can receive notifications about new tasks and bidding for them.</p>
                    {{--<a href="#" class="btn btn-info">Read more</a>--}}
                </div>

            </div>
            <!--/.Card-->
        </div>
        <!--First columnn-->

        <!--Second columnn-->
        <div class="col-lg-4">
            <!--Card-->
            <div class="card card-dark wow fadeIn" data-wow-delay="0.6s">

                <!--Card image-->
                <i class="fa fa-pencil fa-5x" aria-hidden="true"></i>
                {{--<img class="img-fluid" src="/img/features/sketch.jpg" alt="Card image cap">--}}

                <!--Card content-->
                <div class="card-body">
                    <!--Title-->
                    <h4 class="card-title">Sketches</h4>
                    <!--Text-->
                    <p class="card-text">You can have an interactive discussions using sketching tool.</p>
                    {{--<a href="#" class="btn btn-info">Read more</a>--}}
                </div>

            </div>

            <!--/.Card-->

        </div>
        <!--Second columnn-->

        <!--Third columnn-->
        <div class="col-lg-4 mb-4">
            <!--Card-->
            <div class="card card-dark wow fadeIn" data-wow-delay="0.4s">

                <!--Card image-->
                <i class="fa fa-object-group fa-5x"  aria-hidden="true"></i>
                {{--<img class="img-fluid" src="/img/features/play.jpg" alt="Card image cap">--}}

                <!--Card content-->
                <div class="card-body">
                    <!--Title-->
                    <h4 class="card-title">Play with 3D models</h4>
                    <!--Text-->
                    <p class="card-text">You can search, view 3D models and rotate them in 360o view.</p>
                    {{--<a href="#" class="btn btn-info">Read more</a>--}}
                </div>

            </div>
            <!--/.Card-->
        </div>
        <!--Third columnn-->
    </div>
</div>
<!--/.Content-->



<script>

    //------------------------------------------------------------------------------------------------------------------
    // A SceneJS minimal boilerplate to get you started
    //
    // Some resources you might need:
    //
    // Getting started: http://xeolabs.com/articles/scenejs-quick-start/
    // Examples:        http://scenejs.org/examples/index.html
    // Tutorials:       http://xeolabs.com
    //
    // Right, off you go - make something wicked!
    //------------------------------------------------------------------------------------------------------------------


    // Point SceneJS to the bundled plugins
    SceneJS.setConfigs({
        pluginPath:"/libs/scenejs/api/latest/plugins"
    });


    // Define scene
    var scene = SceneJS.createScene({
        // Link to our canvas element
        canvasId:"intro-3d",
        transparent: true,
        nodes:[
            {
                type: "cameras/orbit",
                yaw: -40,
                pitch: -20,
                zoom: 200,
                zoomSensitivity: 20.0,


                nodes: [

                    // Move the raptor a bit to centre it
                    {
                        type: "translate", y: -30, z: -20,
                        nodes: [
                            {
                                type: "texture",
                                src: "/libs/scenejs/models/obj/raptor.jpg",

                                nodes: [

                                    // Import Wavefront .OBJ mesh
                                    {
                                        type: "import/obj",
                                        src: "/libs/scenejs/models/obj/raptor.obj"
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        ]
    });


    // On each frame, spin the teapot a little bit
    scene.getNode("myRotate",
        function (myRotate) {

            var angle = 0;

            scene.on("tick",
                function () {
                    myRotate.setAngle(angle += 0.5);
                });
        });

</script>


@include('includes.footer')