<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Language" content="en">
        <title>Test S2 IT</title>       
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="bower_components/toastr/toastr.js" type="text/javascript"></script>
        <link href="bower_components/toastr/toastr.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="img/cropped-LOGOS2IT-32x32.png" sizes="32x32" />
        <script src="js/dropzone.js" type="text/javascript"></script>
    </head>
    <body style='background-color: #191919; color: white' >
        <div class="container">
            <div style='padding-top: 35px;' class="text-center">
                <h2>Import XML File</h2>           
            </div>
            <section style="padding-top: 110px;">
                <box>
                    <div class="col-sm-12 text-center">
                        <p>Select or drag and drop the file</p>
                        <form  action="/uploadfile" method="POST" enctype="multipart/form-data" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <input type="file" name="file" required="true" style='padding: 40px; border-width: 3px; border-style: dashed; border-color: #00b3ff; max-width: 100%; border-radius: 20px;'><br>
                            <!--<input class="dropzone" type="file" name="file" required="true" id="my-awesome-dropzone" style='padding-right: 80px;'>-->
                            <input class="btn btn-primary" type="submit" value="Process File" style="margin-top: 30px;">      
                        </form>
                    </div>
                </box>
            </section> 
        </div>            
        @if(session('sucesso'))
            @foreach(session('sucesso') as $sucesso)
            <script>
                toastr.success("{{ $sucesso }}");
            </script>
            @endforeach
        @endif
        @if(session('erro'))
            <script>
                toastr.error("{{ session('erro') }}");
            </script>
        @endif
    </body>
</html>
