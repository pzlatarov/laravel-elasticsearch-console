<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 6/4/2017
 * Time: 4:34 PM
 */
?>

<html>
<head>
    <title>Elasticsearch Console</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ext-beautify.js"></script>

</head>
<body>
    <div class="panel panel-default">
        <div class="panel-heading">Elasticsearch Console</div>
        <div class="panel-body">
        <form action="javascript:void(0)" class="form-inline">
            <fieldset>
                <div class="col-md-12">
            <div class="form-group" style="width: 100%;">
                <div class="input-group" style="width: 100%;">
                    <div class="input-group-addon" style="width:68px;">{{config('elasticsearch_console.host')}}</div>
                <input type="text" class="form-control" placeholder="Enter query here" id="query" style="float:left;">
                    <span class="input-group-btn" style="width: 1%;">
                        <input type="submit" value="Run" id="action" class="btn btn-primary">
                    </span>
                </div>

            </div>

                </div>
            </fieldset>
        </form>
            <div class="col-md-12">
                <div id="result" style="height: 85%"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var editor = ace.edit("result");
        var pretty = ace.require("ace/ext/beautify");
        editor.setReadOnly(true);
        editor.setValue('{"Hello!" : "Results will appear here"}');
        editor.getSession().setMode("ace/mode/javascript");

        $(function (){
            $('#action').click(function (){
                var req = $.ajax({
                    type: 'GET',
                    url: '{{route('esConsoleQuery')}}',
                    data: {
                        query: $('#query').val()
                    }
                });

                editor.setValue('{"Loading" : "Hang tight..."}');
                editor.getSession().setMode("ace/mode/javascript");

                req.done(function (response) {

                    if(typeof(response) === 'string' || response instanceof String){
                        editor.setValue(response);
                        editor.getSession().setMode("ace/mode/text");
                    } else{
                        editor.setValue(JSON.stringify(response,null,'\t'));
                        editor.getSession().setMode("ace/mode/javascript");
                        pretty.beautify();
                    }


                });
            });
        });
    </script>
</body>
</html>