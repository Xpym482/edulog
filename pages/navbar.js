$(document).ready(function() {
  let hamburger = $(".wrapper-menu");
  let navigation = $("aside");

  hamburger.click(function() {
    if (navigation.is(":hidden")) {
      navigation.show();
    } else {
      navigation.hide();
    }
  });
});
