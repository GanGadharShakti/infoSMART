$(document).ready(function () {
  let emailValid = true;
  let phoneValid = true;

  // ✅ Email check
  $('input[name="email"]').on("change", function () {
    const email = $(this).val().trim();
    const $input = $(this);
    const $errorSpan = $("#email-error");

    if (email !== "") {
      $.post(
        "<?= base_url('register/checkUnique') ?>",
        { type: "email", value: email },
        function (response) {
          if (response.status === "error") {
            emailValid = false;
            $input.addClass("is-invalid");
            $errorSpan.text(response.message);
          } else {
            emailValid = true;
            $input.removeClass("is-invalid");
            $errorSpan.text(""); // clear previous error
          }
        },
        "json"
      );
    } else {
      $input.removeClass("is-invalid");
      $errorSpan.text("");
    }
  });

  // ✅ Phone check
  $('input[name="phone_number"]').on("change", function () {
    const phone = $(this).val().trim();
    const $input = $(this);
    const $errorSpan = $("#phone-error");

    if (phone !== "") {
      $.post(
        "<?= base_url('register/checkUnique') ?>",
        { type: "phone", value: phone },
        function (response) {
          if (response.status === "error") {
            phoneValid = false;
            $input.addClass("is-invalid");
            $errorSpan.text(response.message);
          } else {
            phoneValid = true;
            $input.removeClass("is-invalid");
            $errorSpan.text(""); // clear previous error
          }
        },
        "json"
      );
    } else {
      $input.removeClass("is-invalid");
      $errorSpan.text("");
    }
  });
});
