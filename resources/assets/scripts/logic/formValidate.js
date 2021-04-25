import { validate, validateAll } from '../util/helpersForm';

export default () => {
    const forms = Array.from(document.querySelectorAll('.js-form-validate'));

    forms.forEach((form) => {
        form.setAttribute('novalidate', '');

        // setTimeout - hack to win a captcha that removes disable attribute
        // fix use recaptcha v3
        setTimeout(() => {
            validateAll(form, false);
        }, 1000);

        form.addEventListener('input', ({ target }) => {
            if (['INPUT', 'TEXTAREA', 'SELECT'].includes(target.tagName)) {
                validate(target);
                validateAll(form, false);
            }
        });
    });
};
