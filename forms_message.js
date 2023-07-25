window.addEventListener('load', function() {
  setTimeout(showForms, 5000);
});

function showForms() {
  var messageBackForm = document.querySelector('form[type="message_back"]');
  var messageForm = document.querySelector('form[type="message"]');
  var contentBlur = document.getElementById('ContentBlur');
  
  messageBackForm.classList.remove('hidden');
  messageForm.classList.remove('hidden');
  
  messageBackForm.style.opacity = '0';
  messageForm.style.opacity = '0';
  contentBlur.classList.add('blur');
  var startTime = null;
  function fadeIn(timestamp) {
    if (!startTime) startTime = timestamp;
    var progress = timestamp - startTime;
    var opacity = Math.min(progress / 500, 1);
    
    messageBackForm.style.opacity = opacity;
    messageForm.style.opacity = opacity;
    
    if (progress < 500) {
      requestAnimationFrame(fadeIn);
    }
  }
  
  requestAnimationFrame(fadeIn);
}

function removeForms() {
  var messageBackForm = document.querySelector('form[type="message_back"]');
  var messageForm = document.querySelector('form[type="message"]');
  var contentBlur = document.getElementById('ContentBlur');
  
  var startTime = null;
  function fadeOut(timestamp) {
    if (!startTime) startTime = timestamp;
    var progress = timestamp - startTime;
    var opacity = Math.max(1 - progress / 500, 0);
    
    messageBackForm.style.opacity = opacity;
    messageForm.style.opacity = opacity;
    
    if (progress < 500) {
      requestAnimationFrame(fadeOut);
    } else {
      messageBackForm.remove();
      messageForm.remove();
      contentBlur.classList.remove('blur');
    }
  }
  
  requestAnimationFrame(fadeOut);
}