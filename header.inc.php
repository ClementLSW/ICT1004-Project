<title>ParkNow</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
<!-- External JS-->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script> var loc = window.location.pathname;
    var script = document.createElement('script');
    var dir = loc.split('/');
    script.setAttribute('src', '/' + dir[1] + '/' + "resources/js/lib/userhome.js");
    document.getElementsByTagName('script')[0].parentNode.appendChild(script);
</script>
<script> var loc = window.location.pathname;
    var script = document.createElement('script');
    var dir = loc.split('/');
    script.setAttribute('src', '/' + dir[1] + '/' + "resources/js/lib/navigation.js");
    document.getElementsByTagName('script')[0].parentNode.appendChild(script);
</script>
<script> var loc = window.location.pathname;
    var script = document.createElement('script');
    var dir = loc.split('/');
    script.setAttribute('src', '/' + dir[1] + '/' + "resources/js/lib/mapview.js");
    document.getElementsByTagName('script')[0].parentNode.appendChild(script);
</script>

<!-- External Style Sheet -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"></link>
<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha384-rCA2D+D9QXuP2TomtQwd+uP50EHjpafN+wruul0sXZzX/Da7Txn4tB9aLMZV4DZm" crossorigin="anonymous">


<!-- Select 2  -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<!-- <script src="/resources/js/select2.min.js"></script>
<link href="/resources/css/select2.min.css" rel="stylesheet" /> -->

<!-- Own Style Sheet -->
<script> var loc = window.location.pathname;
    var link = document.createElement('link');
    var dir = loc.split('/');
    link.setAttribute('rel', 'stylesheet');
    link.setAttribute('href', '/' + dir[1] + '/' + "resources/css/main.css");
    document.getElementsByTagName('link')[0].parentNode.appendChild(link);
</script>

<script> var loc = window.location.pathname;
    var link = document.createElement('link');
    var dir = loc.split('/');
    link.setAttribute('rel', 'stylesheet');
    link.setAttribute('href', '/' + dir[1] + '/' + "resources/css/login.css");
    document.getElementsByTagName('link')[0].parentNode.appendChild(link);
</script>

<script> var loc = window.location.pathname;
    var link = document.createElement('link');
    var dir = loc.split('/');
    link.setAttribute('rel', 'stylesheet');
    link.setAttribute('href', '/' + dir[1] + '/' + "resources/css/mapview.css");
    document.getElementsByTagName('link')[0].parentNode.appendChild(link);
</script>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">