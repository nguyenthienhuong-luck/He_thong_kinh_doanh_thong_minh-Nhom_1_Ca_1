const MODAL_CONFIG = {
  SELECTORS: {
    FORM: '#formTransaction',
    AMOUNT: '#amount',
    CATEGORY: '#category_id',
    DATE: "#date",
    SAVE_BTN: '#saveBtn',
  },
  MESSAGES: {
    CATEGORY_REQUIRED: 'Vui lòng chọn nhóm.',
    INVALID_AMOUNT: 'Số tiền phải lớn hơn 0.',
    FUTURE_DATE: 'Ngày không được lớn hơn ngày hiện tại.',
    INVALID_DATE: 'Ngày không hợp lệ.'
  }
};

class TransactionFormValidator {
  static clearValidationErrors() {
    const form = $(MODAL_CONFIG.SELECTORS.FORM);
    // Remove all validation states and messages
    form.find('.is-invalid').removeClass('is-invalid');
    form.find('.invalid-feedback').remove();
    form.find('.mb-0').removeClass('mb-0').addClass('mb-3');
  }

  static showError(element, message) {
    const parent = element.parent();
    if (element.attr('id') === 'category_id') {
      element.next().addClass('is-invalid');
      parent.after(`<div class="invalid-feedback d-block text-lg mb-3" style="margin-left: calc(80px + 1rem); margin-top: -16px;">${message}</div>`);
    } else {
      element.addClass('is-invalid');
      parent.after(`<div class="invalid-feedback d-block text-lg mb-3" style="margin-left: calc(80px + 1rem);">${message}</div>`);
    }
    parent.removeClass("mb-3").addClass("mb-0");
  }

  static validate() {
    this.clearValidationErrors();

    const form = $(MODAL_CONFIG.SELECTORS.FORM);
    const amount = form.find(MODAL_CONFIG.SELECTORS.AMOUNT).val();
    const categoryId = form.find(MODAL_CONFIG.SELECTORS.CATEGORY).val();
    const dateValue = form.find(MODAL_CONFIG.SELECTORS.DATE).val();

    let isValid = true;

    // Validate amount
    if (!amount || Number(amount) <= 0) {
      this.showError(form.find(MODAL_CONFIG.SELECTORS.AMOUNT), MODAL_CONFIG.MESSAGES.INVALID_AMOUNT);
      isValid = false;
    }

    // Validate category
    if (!categoryId || categoryId === 'default') {
      this.showError(form.find(MODAL_CONFIG.SELECTORS.CATEGORY), MODAL_CONFIG.MESSAGES.CATEGORY_REQUIRED);
      isValid = false;
    }

    // Validate date
    if (!dateValue) {
      this.showError(form.find(MODAL_CONFIG.SELECTORS.DATE), MODAL_CONFIG.MESSAGES.INVALID_DATE);
      isValid = false;
    } else if (!this.isValidDate(dateValue)) {
      this.showError(form.find(MODAL_CONFIG.SELECTORS.DATE), MODAL_CONFIG.MESSAGES.FUTURE_DATE);
      isValid = false;
    }

    return isValid;
  }

  static isValidDate(dateValue) {
    const inputDate = new Date(dateValue);

    // Check if date is valid
    if (isNaN(inputDate.getTime())) {
      return false;
    }

    const today = new Date();

    // Reset time parts for both dates to compare only dates
    inputDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);

    // Compare timestamps
    return inputDate.getTime() <= today.getTime();
  }
}

$(document).ready(function () {
  // Category selection handling
  $('.category-item').click(function () {
    $('.category-item').removeClass('active');
    $(this).addClass('active');

    const categoryId = $(this).data('category-id');
    const categoryName = $(this).data('category-name');

    $('#category_id').val(categoryId);
    $('#selectedCategoryText').text(categoryName);

    $('#selectCategory').modal('hide');
  });

  // When opening category modal
  $('#selectCategory').on('show.bs.modal', function () {
    const selectedCategoryId = $('#category_id').val();
    $('.category-item').removeClass('active');
    if (selectedCategoryId && selectedCategoryId !== 'default') {
      $(`.category-item[data-category-id="${selectedCategoryId}"]`).addClass('active');
    }
  });

  // Set up event handlers
  $(MODAL_CONFIG.SELECTORS.SAVE_BTN).click(function () {
    if (TransactionFormValidator.validate()) {
      $(MODAL_CONFIG.SELECTORS.FORM).submit();
    }
  });
});