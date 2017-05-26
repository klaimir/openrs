<script>
    window.addEventListener('load',function(){
      if(document.getElementById('map_canvas')){
        google.load("maps", "3",{
          callback:function(){
             new google.maps.Map(document.getElementById('map_canvas'), {
                center: new google.maps.LatLng(0,0),
                zoom: 3
              });
          }
        });     
      }
    },false);
</script>
      
<style type="text/css">
#map_canvas{
        height:100%;
        margin:0;
        padding:0;
        width:100%;
      }
</style>
<script src="https://www.google.com/jsapi?.js"></script>
<div id="map_canvas"></div>