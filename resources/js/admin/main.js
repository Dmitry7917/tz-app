import flatpickr from "flatpickr";
import {Russian} from "flatpickr/dist/l10n/ru";
import Inputmask from "inputmask";

// $('#ckeditor').ckeditor();

Inputmask("+7 (999) 999 99-99").mask('.js-phone-mask');

if (document.querySelector('.flatpickr')) {
    flatpickr(document.querySelectorAll('.flatpickr'), {
        "locale": Russian,
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
}
