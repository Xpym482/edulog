$(document).ready(function() {
  let hamburger = $(".wrapper-menu");
  let navigation = $("aside");

  hamburger.click(function() {
    navigation.show();
  });
});
