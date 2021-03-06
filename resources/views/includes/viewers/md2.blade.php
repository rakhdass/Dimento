<script src="/libs/threejs/js/three.js"></script>
<script src="/libs/threejs/js/controls/OrbitControls.js"></script>

<script src="/libs/threejs/js/loaders/MD2Loader.js"></script>

<script src="/libs/threejs/js/MD2Character.js"></script>

<script src="/libs/threejs/js/Detector.js"></script>

<script src="/libs/threejs/js/libs/stats.min.js"></script>

<script src="/libs/threejs/js/libs/dat.gui.min.js"></script>

@include('includes.viewers.container')

<script>
    if ( ! Detector.webgl ) Detector.addGetWebGLMessage();
    var SCREEN_WIDTH = window.innerWidth;
    var SCREEN_HEIGHT = window.innerHeight;
    var container, camera, scene, renderer;
    var character;
    var gui, playbackConfig = {
        speed: 1.0,
        wireframe: false
    };
    var controls;
    var clock = new THREE.Clock();
    var stats;
    init();
    animate();
    function init() {
        container = document.createElement( 'div' );
        document.body.appendChild( container );
        // CAMERA
        camera = new THREE.PerspectiveCamera( 40, window.innerWidth / window.innerHeight, 1, 1000 );
        camera.position.set( 0, 150, 400 );
        // SCENE
        scene = new THREE.Scene();
        scene.background = new THREE.Color( 0x050505 );
        scene.fog = new THREE.Fog( 0x050505, 400, 1000 );
        // LIGHTS
        scene.add( new THREE.AmbientLight( 0x222222 ) );
        var light = new THREE.SpotLight( 0xffffff, 5, 1000 );
        light.position.set( 200, 250, 500 );
        light.angle = 0.5;
        light.penumbra = 0.5;
        light.castShadow = true;
        light.shadow.mapSize.width = 1024;
        light.shadow.mapSize.height = 1024;
        // scene.add( new THREE.CameraHelper( light.shadow.camera ) );
        scene.add( light );
        var light = new THREE.SpotLight( 0xffffff, 5, 1000 );
        light.position.set( -100, 350, 350 );
        light.angle = 0.5;
        light.penumbra = 0.5;
        light.castShadow = true;
        light.shadow.mapSize.width = 1024;
        light.shadow.mapSize.height = 1024;
        // scene.add( new THREE.CameraHelper( light.shadow.camera ) );
        scene.add( light );
        //  GROUND
        var gt = new THREE.TextureLoader().load( "textures/terrain/grasslight-big.jpg" );
        var gg = new THREE.PlaneBufferGeometry( 2000, 2000 );
        var gm = new THREE.MeshPhongMaterial( { color: 0xffffff, map: gt } );
        var ground = new THREE.Mesh( gg, gm );
        ground.rotation.x = - Math.PI / 2;
        ground.material.map.repeat.set( 8, 8 );
        ground.material.map.wrapS = ground.material.map.wrapT = THREE.RepeatWrapping;
        ground.receiveShadow = true;
        scene.add( ground );
        // RENDERER
        renderer = new THREE.WebGLRenderer( { antialias: true } );
        renderer.setPixelRatio( window.devicePixelRatio );
        renderer.setSize( SCREEN_WIDTH, SCREEN_HEIGHT );
        container.appendChild( renderer.domElement );
        //
        renderer.gammaInput = true;
        renderer.gammaOutput = true;
        renderer.shadowMap.enabled = true;
        // STATS
        stats = new Stats();
        container.appendChild( stats.dom );
        // EVENTS
        window.addEventListener( 'resize', onWindowResize, false );
        // CONTROLS
        controls = new THREE.OrbitControls( camera, renderer.domElement );
        controls.target.set( 0, 50, 0 );
        controls.update();
        // GUI
        gui = new dat.GUI();
        gui.add( playbackConfig, 'speed', 0, 2 ).onChange( function() {
            character.setPlaybackRate( playbackConfig.speed );
        } );
        gui.add( playbackConfig, 'wireframe', false ).onChange( function() {
            character.setWireframe( playbackConfig.wireframe );
        } );
        // CHARACTER
        var config = {
            baseUrl: "models/md2/ratamahatta/",
            body: "ratamahatta.md2",
            skins: [ "ratamahatta.png", "ctf_b.png", "ctf_r.png", "dead.png", "gearwhore.png" ],
            weapons:  [  [ "weapon.md2", "weapon.png" ],
                [ "w_bfg.md2", "w_bfg.png" ],
                [ "w_blaster.md2", "w_blaster.png" ],
                [ "w_chaingun.md2", "w_chaingun.png" ],
                [ "w_glauncher.md2", "w_glauncher.png" ],
                [ "w_hyperblaster.md2", "w_hyperblaster.png" ],
                [ "w_machinegun.md2", "w_machinegun.png" ],
                [ "w_railgun.md2", "w_railgun.png" ],
                [ "w_rlauncher.md2", "w_rlauncher.png" ],
                [ "w_shotgun.md2", "w_shotgun.png" ],
                [ "w_sshotgun.md2", "w_sshotgun.png" ]
            ]
        };
        character = new THREE.MD2Character();
        character.scale = 3;
        character.onLoadComplete = function() {
            setupSkinsGUI( character );
            setupWeaponsGUI( character );
            setupGUIAnimations( character );
            character.setAnimation( character.meshBody.geometry.animations[0].name )
        };
        character.loadParts( config );
        scene.add( character.root );
    }
    // EVENT HANDLERS
    function onWindowResize( event ) {
        SCREEN_WIDTH = window.innerWidth;
        SCREEN_HEIGHT = window.innerHeight;
        renderer.setSize( SCREEN_WIDTH, SCREEN_HEIGHT );
        camera.aspect = SCREEN_WIDTH/ SCREEN_HEIGHT;
        camera.updateProjectionMatrix();
    }
    // GUI
    function labelize( text ) {
        var parts = text.split( "." );
        if ( parts.length > 1 ) {
            parts.length -= 1;
            return parts.join( "." );
        }
        return text;
    }
    //
    function setupWeaponsGUI( character ) {
        var folder = gui.addFolder( "Weapons" );
        var generateCallback = function( index ) {
            return function () { character.setWeapon( index ); };
        };
        var guiItems = [];
        for ( var i = 0; i < character.weapons.length; i ++ ) {
            var name = character.weapons[ i ].name;
            playbackConfig[ name ] = generateCallback( i );
            guiItems[ i ] = folder.add( playbackConfig, name ).name( labelize( name ) );
        }
    }
    //
    function setupSkinsGUI( character ) {
        var folder = gui.addFolder( "Skins" );
        var generateCallback = function( index ) {
            return function () { character.setSkin( index ); };
        };
        var guiItems = [];
        for ( var i = 0; i < character.skinsBody.length; i ++ ) {
            var name = character.skinsBody[ i ].name;
            playbackConfig[ name ] = generateCallback( i );
            guiItems[ i ] = folder.add( playbackConfig, name ).name( labelize( name ) );
        }
    }
    //
    function setupGUIAnimations( character ) {
        var folder = gui.addFolder( "Animations" );
        var generateCallback = function( animationClip ) {
            return function () { character.setAnimation( animationClip.name ); };
        };
        var i = 0, guiItems = [];
        var animations = character.meshBody.geometry.animations;
        for ( var i = 0; i < animations.length; i ++ ) {
            var clip = animations[i];
            playbackConfig[ clip.name ] = generateCallback( clip );
            guiItems[ i ] = folder.add( playbackConfig, clip.name, clip.name );
            i ++;
        }
    }
    //
    function animate() {
        requestAnimationFrame( animate );
        render();
        stats.update();
    }
    function render() {
        var delta = clock.getDelta();
        character.update( delta );
        renderer.render( scene, camera );
    }
</script>



{{--<script>
    if ( ! Detector.webgl ) Detector.addGetWebGLMessage();
    var camera, scene, renderer;
    init();
    function init() {

        var container = document.getElementById('object-view-div');

        renderer = new THREE.WebGLRenderer( { antialias: true } );
        renderer.setPixelRatio( window.devicePixelRatio );

        var div_w = $('#object-view-div').innerWidth();
        var div_h = $('#viewer-col-parent').innerHeight();

        renderer.setSize(div_w, div_h);

//        renderer.setSize( window.innerWidth, window.innerHeight );
//        document.body.appendChild( renderer.domElement );
        container.appendChild( renderer.domElement );

        scene = new THREE.Scene();
        scene.background = new THREE.Color( 0x333333 );
        scene.add( new THREE.AmbientLight( 0xffffff, 0.2 ) );
        camera = new THREE.PerspectiveCamera( 35, window.innerWidth / window.innerHeight, 1, 500 );
        // Z is up for objects intended to be 3D printed.
        camera.up.set( 0, 0, 1 );
        camera.position.set( - 80, - 90, 150 );
        scene.add( camera );
        var controls = new THREE.OrbitControls( camera, renderer.domElement );
        controls.addEventListener( 'change', render );
        controls.minDistance = 50;
        controls.maxDistance = 300;
        controls.enablePan = false;
        controls.target.set( 80, 65, 20 );
        controls.update();
        var pointLight = new THREE.PointLight( 0xffffff, 0.8 );
        camera.add( pointLight );
        var loader = new THREE.ThreeMFLoader();
        loader.load( '{{ $object->object_location }}', function ( object ) {
            scene.add( object );
            render();
        } );
        window.addEventListener( 'resize', onWindowResize, false );
    }
    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();

        var div_w = $('#object-view-div').innerWidth();
        var div_h = $('#viewer-col-parent').innerHeight();

        renderer.setSize(div_w, div_h);

//        renderer.setSize( window.innerWidth, window.innerHeight );
        render();
    }
    function render() {
        renderer.render( scene, camera );
    }
</script>--}}

