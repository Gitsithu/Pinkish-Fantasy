<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $logo = DB::table('ui_config')->where([['status',1],['indexname','Logo']])->value('img_url');
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Pinkish Fantasy</title>
    <link rel="icon" type="image/x-icon" href="{{$logo}}"/>    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="/backend/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/backend/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/backend/assets/css/pages/error/style-maintanence.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

</head>
<body class="maintanence text-center">
    
    <div class="container-fluid maintanence-content">
        <div class="">
            <div class="maintanence-hero-img">
                <img alt="logo" src="{{$logo}}">
            </div>
            <h1 class="error-title" style="color:red!important;">Unauthorized</h1>
            <p class="error-text" style="color:red!important;">You don't have permission to access this page!</p>
            
            <a href="/admin" class="btn btn-info mt-4">Home</a>
        </div>
    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/backend/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="/backend/bootstrap/js/popper.min.js"></script>
    <script src="/backend/bootstrap/js/bootstrap.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>
</html>