$(document).ready(function() {

  $(".firm-toggle .firm").click(function() {
    $(".firm-toggle li").removeClass("active");
    $(".right section").removeClass("active");
    $(this).addClass("active");
    $(".right .firm").addClass("active");
  });
  $(".firm-toggle .staff span").click(function() {
    $(".firm-toggle li").removeClass("active");
    $("#staff span").removeClass("active");
    $(".right section").removeClass("active");
    $(".firm-toggle .staff").addClass("active");
    $(".right .staff").addClass("active");
  });

  $("#staff .patty").click(function() {
    $("#staff span").removeClass("active");
    $(".right section").removeClass("active");
    $(this).addClass("active");
    $(".right .patty").addClass("active");
  });
  $("#staff .teresa").click(function() {
    $("#staff span").removeClass("active");
    $(".right section").removeClass("active");
    $(this).addClass("active");
    $(".right .teresa").addClass("active");
  });
  $("#staff .mandi").click(function() {
    $("#staff span").removeClass("active");
    $(".right section").removeClass("active");
    $(this).addClass("active");
    $(".right .mandi").addClass("active");
  });
  $("#staff .tessica").click(function() {
    $("#staff span").removeClass("active");
    $(".right section").removeClass("active");
    $(this).addClass("active");
    $(".right .tessica").addClass("active");
  });
  $("#staff .lexie").click(function() {
    $("#staff span").removeClass("active");
    $(".right section").removeClass("active");
    $(this).addClass("active");
    $(".right .lexie").addClass("active");
  });
  $("#staff .susan").click(function() {
    $("#staff span").removeClass("active");
    $(".right section").removeClass("active");
    $(this).addClass("active");
    $(".right .susan").addClass("active");
  });
  $("#staff .jessica").click(function() {
    $("#staff span").removeClass("active");
    $(".right section").removeClass("active");
    $(this).addClass("active");
    $(".right .jessica").addClass("active");
  });

  $(".firm-toggle .history").click(function() {
    $(".firm-toggle li").removeClass("active");
    $(".right section").removeClass("active");
    $(this).addClass("active");
    $(".right .history").addClass("active");
  });
  $(".firm-toggle .credo").click(function() {
    $(".firm-toggle li").removeClass("active");
    $(".right section").removeClass("active");
    $(this).addClass("active");
    $(".right .credo").addClass("active");
  });
  $(".firm-toggle .community").click(function() {
    $(".firm-toggle li").removeClass("active");
    $(".right section").removeClass("active");
    $(this).addClass("active");
    $(".right .community").addClass("active");
  });

});