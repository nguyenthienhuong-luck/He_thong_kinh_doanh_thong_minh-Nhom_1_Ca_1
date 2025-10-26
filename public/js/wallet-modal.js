$(document).ready(function () {
  let formElement = $("#formWallet-create");
  formElement.on('submit', function (e) {
    e.preventDefault();

    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();

    const name = $(this).find('#name').val().trim();

    if (!name) {
      $('#name').addClass('is-invalid');
      $("#name").parent().removeClass("mb-3").addClass("mb-0");
      $('#name').parent().after('<div class="invalid-feedback d-block text-lg mb-3" style="margin-left: calc(60px + 1rem);">Vui lòng nhập tên ví</div>');
      return false;
    }

    this.submit();
  });

  // Add focus handler for amount
  formElement.find("#name").on('focus', function () {
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $('#name').parent().removeClass('mb-0').addClass('mb-3');
  });
});