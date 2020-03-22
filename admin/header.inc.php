<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" type="text/css">                    
<!-- <link rel="stylesheet" href="main.css" type="text/css"> -->
<script> var loc = window.location.pathname;
var link = document.createElement('link');
var dir = loc.split('/'); 
link.setAttribute('rel' , 'stylesheet');
link.setAttribute('href','/' + dir[1] + '/' + "admin/main.css" );
console.log(dir[1]);
document.getElementsByTagName('link')[0].parentNode.appendChild(link);
</script>
<script> var loc = window.location.pathname;
var script = document.createElement('script');
var dir = loc.split('/'); 
script.setAttribute('src','/' + dir[1] + '/' + "resources/js/lib/navigation.js" );
document.getElementsByTagName('script')[0].parentNode.appendChild(script);
</script>
<script> var loc = window.location.pathname;
var link = document.createElement('link');
var dir = loc.split('/'); 
link.setAttribute('rel' , 'stylesheet');
link.setAttribute('href','/' + dir[1] + '/' + "resources/css/main.css" );
console.log(dir[1]);
document.getElementsByTagName('link')[0].parentNode.appendChild(link);
</script>