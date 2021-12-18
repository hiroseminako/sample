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

// 矢印回転
$(function () {
  $('.menu').click(function () {
    $('.arrow').toggleClass('selected');
  });
});

// モーダルウィンドウ
$(function () {
  //テキストリンクをクリックしたら
  $('.edit_button').click(function () {
    //body内の最後に<div id="modal-bg"></div>を挿入
    $('body').append('<div id="modal-bg"></div>');

    //画面中央を計算する関数を実行
    modalResize();

    //モーダルウィンドウを表示
    $('#modal-bg, .tweet_modal').fadeIn('slow');

    //画面のどこかをクリックしたらモーダルを閉じる
    $('#modal-bg').click(function () {
      $('#modal-bg, .tweet_modal').fadeOut('slow', function () {
        //挿入した<div id="modal-bg"></div>を削除
        $('#modal-bg').remove();
      });

    });

    //画面の左上からmodal-mainの横幅・高さを引き、その値を2で割ると画面中央の位置が計算できます
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
