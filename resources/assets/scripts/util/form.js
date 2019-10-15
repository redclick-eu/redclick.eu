export function validate(el, useClass = true) {
    const type = el.getAttribute('data-val-type');
    if(type === null) {
        return true
    }

    const value = el.value;
    const cls = 'is-error';
    const setClass = () => {
        if (useClass) el.classList.add(cls)
    };

    if (useClass)
        el.classList.remove(cls);

    if (parseInt(type)) {
        if (value.length < type) {
            setClass();
            return false;
        }
    } else {
        switch (type) {
            case 'empty':
                if (!value) {
                    setClass();
                    return false;
                }
                break;
            case 'email':
                if (!value || !value.match(/^[-._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/i)) {
                    setClass();
                    return false;
                }
                break;

            case 'phone':
                if (!value || !value.match(/^((8|\+)[- ]?)?(\(?\d{3}\)?[- ]?)?[\d\- ]{7,10}$/i)) {
                    setClass();
                    return false;
                }
                break;

            case 'select':
                if (!value || value === 'disabled') {
                    setClass();
                    return false;
                }
                break;

            case 'bool':
                if (!el.checked) {
                    setClass();
                    return false;
                }
                break;

            default:
                console.warn(el);
        }
    }
    return true;
}

export function validateAll(form, useClass) {
    let r = true;
    Array.from(form.querySelectorAll('input,textarea,select')).forEach(function (_v) {
        r = validate(_v, useClass) && r;
    });
    if (r) {
        form.querySelector('[type="submit"]').removeAttribute('disabled');
    } else {
        form.querySelector('[type="submit"]').setAttribute('disabled', 'disabled');
    }
    return r;
}

/*!
 * Serialize all form data into a query string
 * (c) 2018 Chris Ferdinandi, MIT License, https://gomakethings.com
 * @param  {Node}   form The form to serialize
 * @return {String}      The serialized form data
 */
export function serialize(form) {
    let serialized = {};
    const elements =  Array.from(form.querySelectorAll('input,textarea,select'));

    elements.forEach(function (field) {
        // Don't serialize fields without a name, submits, buttons, file and reset inputs, and disabled fields
        if (!field.name || field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button') return true;
        
        // If a multi-select, get all selections
        if (field.type === 'select-multiple') {
            for (let n = 0; n < field.options.length; n++) {
                if (!field.options[n].selected) continue;
                serialized[field.name] = field.options[n].value;
            }
        }

        // Convert field data to a query string
        else if ((field.type !== 'checkbox' && field.type !== 'radio') || field.checked) {
            serialized[field.name] = field.value;
        }
    });

    return JSON.stringify(serialized);
}

export function reset(_form) {
    _form.reset();
    _form.querySelector('[type="submit"]').setAttribute('disabled', 'disabled');
}