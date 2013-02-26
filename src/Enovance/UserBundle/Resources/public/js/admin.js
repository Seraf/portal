$(document).ready(function() {

  $('.a-switch label').click(function() {
    if(!$(this).hasClass('a-active')) {
      $(this).parent().find('label.a-active').removeClass('a-active');
      $(this).addClass('a-active');
    }
    if($(this).hasClass('a-on')) 
      $(this).parent().find('input').val(1).attr('checked', 'checked');
    else 
      $(this).parent().find('input').val(0).removeAttr('checked');
  });
  
  $('.generate-password-btn a').click(function() {
    var generated_password = generatePassword();
    $(this).parent().find('.generate-password-value').html(generated_password);
    
    $(this).hide();
    
    var password_div = $(this).parent().parent();
    password_div.find('input[type=password]').val(generated_password);
    var password_confirm_div = password_div.next();
    password_confirm_div.find('input[type=password]').val(generated_password);
  });
  
  function generatePassword() {
    var iteration = 0;
    var password = '';
    var randomNumber;
    var length = 8;
    while(iteration < length){
      randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
      if ((randomNumber >=33) && (randomNumber <=47)) {
        continue;
      }
      if ((randomNumber >=58) && (randomNumber <=64)) {
        continue;
      }
      if ((randomNumber >=91) && (randomNumber <=96)) {
        continue;
      }
      if ((randomNumber >=123) && (randomNumber <=126)) {
        continue;
      }
      iteration++;
      password += String.fromCharCode(randomNumber);
    }
    return password;
  }
});
