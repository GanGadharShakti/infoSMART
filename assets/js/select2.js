(function($) {
  'use strict';

  if ($(".js-example-basic-single").length) {
    $(".js-example-basic-single").select2();
  }
  if ($(".js-example-basic-multiple").length) {
    $(".js-example-basic-multiple").select2();
  }
})(jQuery);

  $(document).ready(function () {
    $('#sortBy').select2();
    $('#lastRemark').select2();
    $('#moveCity').select2();
    $('#city').select2();
    $('#homeSize').select2();
    $('#timeSlot').select2();
    $('#source').select2();
    $('#lead_assign').select2();
    $('#pay_source').select2();
    $('#responsibility').select2();
    $('#description').select2();
    $('#home-size').select2();
    $('#moving_time').select2();
    $('#upload_source').select2();
    $('#upload_move_type').select2();
    $('#upload_city').select2();
    $('#upload_state').select2();
    $('#service_lift').select2();
    $('#spancoStatus').select2();
  });