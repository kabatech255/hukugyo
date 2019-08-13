  $(function(){

    // iPad以下で開いたときはメニューバーを閉じている
    if($(window).width() < 769){
      $('#header_menu').hide();
    }

    // ページタイトルが15文字を超えていたら、font-sizeを24pxにする
    var $titles = $('.page-title');
    $titles.each(function(){
      if($(this).text().length > 15){
        $(this).css('font-size', '24px');
      }
    });

    // 選択されているメニューバーにselectedクラスをつける
    var current_href = location.href;
    var $menus = $('.menu-item');
    $menus.each(function(){
      var a = $(this).children('a');
      if($(a).attr('href') === current_href){
        $(this).children('a').addClass('selected');
      }
    });

    // ログイン画面(login)、投稿画面(create), マイページ(mypage)はサイドバー非表示
    var pathname = $(location).attr('pathname');
    switch(pathname){
      case '/login':
      case '/jobs/create':
      case '/mypage':
        $('aside').addClass('hidden');
    }

    var pathname = $(location).attr('pathname');
    if( pathname.match('^jobs/[1-9]*[0-9]$') === null ){
      //  job一覧のとき、仕事の内容は10文字 + '(more...)'
        // var $setElem = $('.job-description');
        // $setElem.each(function(){
        //   if($(this).text().length > 10){
        //     var text = $(this).text().substr(0, 10) + '...(more)';
        //     $(this).text(text);
        //   }
        // });

      //  仕事のタイトルは10文字 + '...'
        var $setTitle = $('.job-title');
        $setTitle.each(function(){
          var count = $(this).text().length;
          if( count > 10){
            var text = $(this).text().substr(0, 10) + '...';
            $(this).text(text);
          }
        });
    }

    // スクロールで該当位置に来たらふわっと表示させる
    $(window).scroll(function (){

        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        $(".huwa").each(function(){
          var imgPos = $(this).offset().top;
          if (scroll > imgPos - windowHeight + windowHeight/5){
              $(this).css('opacity','1' );
          } else {
              $(this).css('opacity','0' );
          }
        });

      });


    // jobのdeleteボタン
    var $cmds = $('.del');
    $cmds.each(function(e){
      $(this).click(function(e){
        e.preventDefault();
        var num = $(this).data('id');
        if(confirm('削除してよろしいですか？')){
          $('#del_' + num).submit();
        }else{
          return false;
        }
      });
    });

    // iPadを横向きにしたときメニューバーをボタンから出す
    $('.header-menu-child').hide();
    $(window).on('load resize', function() {

      if($(window).width() > 768){
        $('#header_menu').show();
      }else{
        $('#header_menu').hide();
      }

    });

    // 三本ラインをタップするとメニューバーがexpandする
    $('#open_menu').click(function(){
      $('#header_menu').slideToggle();
    });

    // メニューバーの中にメニューが入れ子になっていた場合のクリックイベント
    $('.header-menu-parent').click(function(){

      var toggler = $(this).children()[0];
      var toggler = $(toggler).children()[0];
      $(toggler).toggleClass('open');
      var child = $(this).children()[1];
      $(child).slideToggle();
      var siblings = $(this).siblings();
      // console.log($(siblings));

      for(var i = 0; i < $(siblings).length; i++){
        var sibling = $(siblings)[i];
        if($(sibling).hasClass('header-menu-parent')){
          var a = $(sibling).children()[1];
          $(a).slideUp();
          var b = $(sibling).children()[0];
          var b = $(b).children()[0];
          $(b).removeClass('open');
        }
      }

    });

    // 新規登録ボタンを押すと、登録用フォームが上から降りてくる
    $('.new-register').click(function(e){
      e.preventDefault();
      $('#mask').removeClass('hidden');
      $('#modal').addClass('down');
    });
    $('#close_form').click(function(){
      $('#mask').addClass('hidden');
      $('#modal').removeClass('down');
    });

    // コメントするボタンを押すと、投稿用フォームが上から降りてくる
    $('.new-comment').click(function(e){
      e.preventDefault();
      $('#mask').removeClass('hidden');
      $('#modal_comment').addClass('down');
    });

    $('#close_form_comment').click(function(){
      $('#mask').addClass('hidden');
      $('#modal_comment').removeClass('down');
    });

    // コメント投稿フォーム内のレビュー
    var $stars = $('.fa-star');
    $stars.each(function(){
      var score = $(this).data('point');
      $(this).click(function(){
        $('input[name="score"]').val(score);
        for(var i = 5; i > score; i--){
          var num = i - 1;
          $('.fa-star').eq(num).removeClass('active');
        }
        for(var i = 0; i < score; i++){
          var num = i;
          $('.fa-star').eq(num).addClass('active');
        }
      });
    });

    $('[data-toggle="tooltip"]').tooltip();


  });
