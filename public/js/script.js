// アコーディオン
$(function () {
  $('.menu').click(function () {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $('#links').addClass('active');
    } else {
      $('#links').removeClass('active');
    }
  });
  $('#links li a').click(function () {
    $('.menu').removeClass('active');
    $('#link').removeClass('active');
  });
});

// アコーディオンの矢印回転
$(function () {
  $('.menu').click(function () {
    $('.arrow').toggleClass('selected');
  });
});

// モーダルウィンドウ
$(function () {
  // 編集ボタンをクリックしたら
  $('.edit_button').each(function () {
    $(this).on('click', function () {

      // bodyの一番下に<div>を追加
      $('body').append('<div id="modal-bg"></div>');
      modalResize();

      //モーダルウィンドウを表示
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      console.log(modal);
      $(modal).fadeIn('slow');

      //画面のどこかをクリックしたらモーダルを閉じる
      $('#modal-bg').click(function () {
        $('#modal-bg, .tweet_modal').fadeOut('slow', function () {
          //挿入した<div id="modal-bg"></div>を削除
          $('#modal-bg').remove();
        });
      });

      return false;

    });

    //modalを画面中央に配置
    $(window).resize(modalResize);
    function modalResize() {

      var w = $(window).width();
      var h = $(window).height();

      var cw = $('.tweet_modal').outerWidth();
      var ch = $('.tweet_modal').outerHeight();

      //取得した値をcssに追加する
      $('.tweet_modal').css({
        "left": ((w - cw) / 2) + "px",
        "top": ((h - ch) / 3) + "px"
      });
    }

  });
});
