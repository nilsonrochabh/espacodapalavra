$(window).load(function(){$("body").css("opacity",1)}),$(document).ready(function(){var t,i,e,a;$(".inline").colorbox({inline:!0,width:"950px"}),$(".inlineartista").colorbox({inline:!0,width:"1000px"}),$(".inlineleitura").colorbox({inline:!0,width:"1000px"}),$("#tabs").tabs(),$("#call-conheca").click(function(){$("#sub-menu").slideToggle()}),$("#call-explore").click(function(){$("#sub-menu-explore").slideToggle()}),$(".applyfilter").click(function(){t=$(this).attr("data-filter"),e=$(".item-category").attr("data-category"),$(".item-category").hide(),$(".item-category").each(function(i){e=$(this).attr("data-category"),t==e&&$(this).fadeIn()})}),$(".checkbox-artistas").click(function(){$(".item-artista").hide(),i=$(this).attr("id"),this.checked?$(".item-artista").each(function(t){a=$(this).attr("data-artista"),i==a&&$(this).fadeIn()}):$(".item-artista").each(function(t){a=$(this).attr("data-artista"),i==a&&$(this).fadeOut()})}),$(".checkbox-leitura").click(function(){$(".item-leitura").hide(),i=$(this).attr("id"),this.checked?$(".item-leitura").each(function(t){a=$(this).attr("data-leitura"),i==a&&$(this).fadeIn()}):$(".item-leitura").each(function(t){a=$(this).attr("data-leitura"),i==a&&$(this).fadeOut()})}),$("#next2").click(function(){$(".steps-item").removeClass("ativo"),$("#stepitem2").addClass("ativo"),$("#formstep1").hide(),$("#formstep2").fadeIn()}),$("#next3").click(function(){$(".steps-item").removeClass("ativo"),$("#stepitem3").addClass("ativo"),$("#formstep2").hide(),$("#formstep3").fadeIn()})});