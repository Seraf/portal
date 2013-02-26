$(document).ready(function() {
  $('input.a-search').keyup(function() {
    var searched_value = $(this).val();
    var searched_value_reg_exp = new RegExp(searched_value,"i");
    if(searched_value) {
      $('.a-searchable ul li').each(function() {
        var li_value = $(this).find('a.a-title span.list-title').html();
        var match = searched_value_reg_exp.test(li_value);
        if(match) {
          $(this).show();
        }
        else {
          $(this).hide();
        }
      });
    }
    else {
      $('.a-searchable ul li').show();
    }
  });
});
