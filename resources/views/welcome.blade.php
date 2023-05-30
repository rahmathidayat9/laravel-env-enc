<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Encrypt Decrypt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-header"><b>Encrypt</b></div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="key" class="form-label">.ENV key:</label>
                    <input type="text" class="form-control" id="key" name="key" placeholder="ex : DB_HOST">
                </div>
                <div class="mb-3">
                    <label for="encrypt" class="form-label">Input Text:</label> <span style="cursor: pointer;" id="encrypt-btn" class="pl-4 badge rounded-pill text-bg-primary">Encrypt</span>
                    <input type="text" class="form-control" id="encrypt" name="encrypt" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="result" class="form-label">Encrypt Result</label> <span style="cursor: pointer;" id="copy" class="pl-4 badge rounded-pill text-bg-primary">Copy</span>
                    <textarea class="form-control" id="result" name="result" rows="3"></textarea>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-primary text-light"><b>Decrypt</b></div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="paste-encrypt" class="form-label">Encrypt Result</label> <span style="cursor: pointer;" id="paste" class="pl-4 badge rounded-pill text-bg-primary">Click To Paste</span>
                    <textarea class="form-control" id="paste-encrypt" name="paste-encrypt" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="decrypt" class="form-label">Decrypt Text:</label> <span style="cursor: pointer;" id="decbutton" class="pl-4 badge rounded-pill text-bg-primary">Click To Decrypt</span>
                <input type="text" class="form-control" id="decrypt" name="decrypt" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#encrypt-btn").on("click", function(){
                $.ajax({
                    type: "POST",
                    url: "{{ route('encrypt.store') }}",
                    data: {
                        key: $("#key").val(),
                        encrypt: $("#encrypt").val(),
                    },
                    dataType: "JSON",
                    success: function (response) {
                        $("#result").val(response)
                    }
                });
            })

            $('#copy').on('click', function() {
                var copyText = $('#result');
                copyText.select();
                document.execCommand('copy');
                alert('Teks telah disalin: ' + copyText.val());
            });

            $('#paste').on('click', function() {
                var pasteText = $('#result');
                pasteText.select();
                document.execCommand('paste');

                let paste = $("#paste-encrypt").val(pasteText.val())
            });

            $("#decbutton").on("click", function() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('decrypt.store') }}",
                    data: {
                        input: $("#paste-encrypt").val()
                    },
                    dataType: "JSON",
                    success: function (response) {
                        $("#decrypt").val(response)
                    }
                });
            })
        });
    </script>
  </body>
</html>
