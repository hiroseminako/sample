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
  $('.edit_button').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      console.log(modal);
      $(modal).fadeIn();
      return false;
    });
  });
  $('#container').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
