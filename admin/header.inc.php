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
document.getElementsByTagName('link')[0].parentNode.appendChild(link);
</script>