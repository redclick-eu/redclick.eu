import {validate, validateAll, serialize, reset} from '../util/form'
import 'whatwg-fetch'

export default {
    init() {

        const script_recaptcha = document.createElement('script');
        script_recaptcha.src = 'https://www.google.com/recaptcha/api.js?onload=recaptcha_onload&render=explicit';
        document.head.appendChild(script_recaptcha);

        window.recaptcha_onload = function () {
            Array.from(document.getElementsByClassName('g-recaptcha')).forEach(function (_r) {
                window.grecaptcha.render(_r, {
                    'sitekey': '6LcFh7AUAAAAAHZr62yo5ptkHQgSo3o_pL2kV4_y',
                    'callback': function (token) {
                        _r.setAttribute('data-token', token);
                        console.log(_r.closest('.js-form-contacts'));
                        _r.closest('.js-form-contacts').dispatchEvent(new Event('submit'));
                    },
                });
                _r.setAttribute('disabled', 'disabled');
            });
        };

        const _forms = document.querySelectorAll('form[data-ajax]');
        _forms.forEach(_form => {
            _form.setAttribute('novalidate', '');
            _form.querySelectorAll('input,textarea,select').forEach(_el => {
                _el.addEventListener('input', function () {
                    console.log(this);
                    validate(this);
                    validateAll(_form, false);
                });
            });

            let sending = false;
            const _backdrop = _form.querySelector('.js-backdrop');
            _form.addEventListener('submit', function (e) {
                e.preventDefault();

                console.log(serialize(_form));

                if (sending || !validateAll(_form)) {
                    return;
                }

                sending = true;
                _form.classList.add('is-loading');

                fetch(_form.getAttribute('data-ajax'), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: serialize(_form),
                })
                    .then(r => r.json())
                    .catch(err => {
                        _form.classList.remove('is-loading');
                        sending = false;
                        console.log(err);
                    })
                    .then((json) => {
                        console.log(json);
                        _form.classList.remove('is-loading');
                        sending = false;

                        if (json.success) {
                            reset(_form);
                            _backdrop.classList.add('is-active');
                            setTimeout(() => _backdrop.classList.remove('is-active'), 3000);
                        } else if (json.error) {
                            _form.querySelectorAll('[name="' + json.error.join('"],[name="') + '"]').forEach(el => el.classList.add('is-error'))
                        }
                    })
            });
        })
    },
};