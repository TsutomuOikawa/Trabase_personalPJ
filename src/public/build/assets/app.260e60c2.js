import{s as p}from"./editor.7642d3de.js";const v=new RegExp("^/$|^/mypage/?$|^/pref/[1-9]+[0-9/]*$");let w=location.pathname;function k(){v.test(w)&&new Splide(".splide",{type:"loop",drag:"free",focus:"center",perPage:8,gap:10,arrows:!1,pagination:!1,breakpoints:{960:{perPage:6},420:{perPage:4}},autoScroll:{speed:.5,rewind:!0,pauseOnHover:!1}}).mount(window.splide.Extensions)}$(function(){k(),p(),$(".js-menu-trigger").on("click",function(){$(this).toggleClass("js-active"),$(".js-slide-menu").toggleClass("js-active")}),$(".js-form-trigger").on("click",function(){$(this).children().toggleClass("fa-magnifying-glass").toggleClass("fa-chevron-up"),$(".header_form").toggleClass("js-active")});let o=$(".js-header-change-target").height(),u=$(".js-hide-title");$(window).on("scroll",function(){let e=$(this);$(".js-change-header").toggleClass("js-transparent",e.scrollTop()<o/1.6),$(".js-change-header_form").toggleClass("js-nonactive",e.scrollTop()<o/1.6),u.toggleClass("js-nonactive",e.scrollTop()>o/3)});let c=$(".js-show-flashMsg");$(".js-get-flashMsg").text()&&(c.toggleClass("js-active"),setTimeout(function(){c.toggleClass("js-active")},4e3));let r=$(".js-move-position"),f=3,g=$(".carousel_item:first-child").innerWidth(),j=g*f;r.css("width",j+"px"),$(".js-switch-carousel").on("click",function(){let e=$(this),t=e.index();r.animate({left:"-"+g*t+"px"},800),$(".js-switch-carousel.js-active").removeClass("js-active"),e.addClass("js-active")});let s=$(".js-modal"),i=$("body");$(".js-show-modal").on("click",function(){setTimeout(function(){s.show(),i.css("overflow-y","hidden")},500)}),$(".js-get-wish").on("click",function(){let e=$(this).prev("table"),t=e.find(".js-get-spot").text(),l=e.find(".js-get-thing").text();s.find("[name=spot]").attr("value",t),s.find("[name=thing]").attr("value",l)}),$(".js-hide-modal").on("click",function(){i.css("overflow-y","auto"),s.hide(),s.find("input").each(function(){$(this).attr("value","")})}),$(".js-get-tab").on("click",function(){let e=$(this),t=e.index();$(".js-get-tab.js-selected").removeClass("js-selected"),$(".js-show-contents.js-active").removeClass("js-active"),e.addClass("js-selected"),$(".js-show-contents").eq(t).addClass("js-active")}),$(".js-add-thumbnail").on("click",function(){let e=$(this);e.hide(),e.prev("img").hide(),e.next().show()}),$(".js-switch-toggle-list").on("click",function(){let e=$(this);e.next(".js-toggle-list").toggleClass("js-active"),e.children().toggleClass("fa-square-plus").toggleClass("fa-square-minus")}),$(".js-change-back").hover(function(){let e=$(this).children("img").attr("src");$(".js-change-back-target").css("background-image","url("+e+")")}),$(".js-favorite").on("click",function(){let e=$(this),t=e.data("note_id"),l="/notes/favorite/"+t;$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"POST",url:l,data:{note_id:t}}).done(function(C){e.toggleClass("fa-regular fa-solid js-active")}).fail(function(){})});let a=$(".js-change-num"),n=new URLSearchParams(location.search);a.on("change",function(){let e=a.children(":selected").val();n.delete("page"),n.set("num",e),window.location="/notes?"+n.toString()});let h=n.get("sort");h==="bookmarks"?$(".js-set-link:eq(1)").css("text-decoration","underline"):h==="comments"?$(".js-set-link:eq(2)").css("text-decoration","underline"):$(".js-set-link:eq(0)").css("text-decoration","underline");let m=a.children(":selected").val();$(".js-set-link").each(function(){let e=$(this),t=e.attr("href");e.attr("href",t+"&num="+m)});let d=$(".js-message-to-recruiter");sessionStorage.getItem("check")||(d.show(),i.css("overflow-y","hidden"),sessionStorage.setItem("check","true")),$(".js-hide-message").on("click",function(){i.css("overflow-y","auto"),d.hide()})});