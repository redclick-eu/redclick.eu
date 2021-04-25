import { validateAll, serialize, reset } from '../util/helpersForm';
import { parseJsonVars } from '../util/helpers';

export default () => {
    const forms = document.querySelectorAll('form[data-action]');

    if (forms.length) {
        const scriptRecaptcha = document.createElement('script');
        scriptRecaptcha.src = 'https://www.google.com/recaptcha/api.js?onload=recaptcha_onload&render=explicit';
        document.head.appendChild(scriptRecaptcha);

        window.recaptcha_onload = () => {
            Array.from(document.querySelectorAll('form[data-action] .g-recaptcha')).forEach((_r) => {
                window.grecaptcha.render(_r, {
                    sitekey: '6LcFh7AUAAAAAHZr62yo5ptkHQgSo3o_pL2kV4_y',
                    callback(token) {
                        _r.setAttribute('data-token', token);
                        console.log('recaptcha callback');
                        _r.closest('form').dispatchEvent(new Event('submit', { bubbles: true }));
                    },
                    'expired-callback': () => {
                        console.log('expired-callback');
                    },
                    'error-callback': () => {
                        console.log('error-callback');
                    },
                });
            });
        };
    }

    forms.forEach((_form) => {
        const backdrop = _form.querySelector('.js-backdrop');

        const settings = parseJsonVars(_form.getAttribute('data-settings'), {
            reset: true,
            method: 'POST',
            headers: {},
        });

        let sending = false;

        _form.addEventListener('submit', (e) => {
            e.preventDefault();

            if (sending || !validateAll(_form)) {
                window.grecaptcha.reset();
                validateAll(_form);
                return;
            }

            sending = true;
            _form.classList.add('loading');

            fetch(_form.getAttribute('data-action'), {
                method: settings.method,
                headers: settings.headers,
                body: JSON.stringify(serialize(_form)),
            })
                .then((r) => {
                    if (r.status >= 500) {
                        return r.text();
                    }
                    return r.json();
                })
                .then((json) => {
                    if (typeof json !== 'object') {
                        throw Error(json);
                    }

                    _form.classList.remove('loading');

                    if (settings.reset && json.status) {
                        reset(_form);
                    }

                    _form.dispatchEvent(new CustomEvent('form_submitted', { detail: json }));

                    if (json.message && backdrop) {
                        _form.classList.add('message');
                        backdrop.innerText = json.message;

                        setTimeout(() => {
                            _form.classList.remove('message');
                            backdrop.innerText = '';
                        }, 5000);
                    }

                    sending = false;
                    window.grecaptcha.reset();
                })
                .catch((err) => {
                    _form.classList.remove('loading');
                    sending = false;

                    if (backdrop) {
                        _form.classList.add('message');
                        backdrop.innerText = 'Проблема с интернетом или сервером, попробуйте позже';

                        setTimeout(() => {
                            _form.classList.remove('message');
                            backdrop.innerText = '';
                        }, 3500);
                    }

                    console.log(err);
                });
        });
    });
};
