var socket = io.connect('http://153.104.170.183:4114');
var mmoroomless = true;
socket.on('move', function (data) {
  if($('#mmom'+data.id).length == 0) {
    $(document.body).append('<div id="mmom'+data.id+'">Player '+((new Date).getTime()%1000)+'</div>');
  }
  $('#mmom'+data.id).css({left:data.x-40,top:data.y});
});
socket.on('leave', function (data) {
  $('#mmom'+data).remove();
});
function mmom(e) {
  var data = {
    path     : window.location.pathname,
    x        : e.clientX+$(window).scrollLeft(),
    y        : e.clientY+$(window).scrollTop(),
    roomless : mmoroomless
  };
  socket.emit('move', data);
  mmoroomless = false;
}
$(document).ready(function(){
  document.addEventListener('mousemove', mmom, false);
  $(document.body).append('<div class="aprilfoolsbanner" title="April Fools">As part of our ongoing pursuit of excellence, we\'ve enabled multiplayer features in our library today. Enjoy!').css('margin-top', 50);
});