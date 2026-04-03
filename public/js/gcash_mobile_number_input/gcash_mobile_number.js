document.addEventListener('DOMContentLoaded', function () {
    initPHMobileFields('[data-phone-field]');
});

function initPHMobileFields(selector) {
    var fields = document.querySelectorAll(selector);

    fields.forEach(function (field) {
        setupPHMobileField(field);
    });
}

function setupPHMobileField(field) {
    var input = field.querySelector('[data-phone-input]');
    var mask = field.querySelector('[data-phone-mask]');
    var message = field.querySelector('[data-phone-message]');
    var fullInput = field.querySelector('[data-phone-full]');

    if (!input || !mask || !message || !fullInput) {
        return;
    }

    function normalize(value) {
        if (!value) {
            return '';
        }

        value = value.replace(/\D/g, '');

        if (value.indexOf('639') === 0) {
            value = value.substring(2);
        } else if (value.indexOf('63') === 0) {
            value = value.substring(2);
        } else if (value.indexOf('09') === 0) {
            value = value.substring(1);
        } else if (value.indexOf('0') === 0) {
            value = value.substring(1);
        }

        return value.substring(0, 10);
    }

    function format(value) {
        var a = value.substring(0, 3);
        var b = value.substring(3, 6);
        var c = value.substring(6, 10);

        var result = a;
        if (b) result += ' ' + b;
        if (c) result += ' ' + c;

        return result;
    }

    function isValid(value) {
        return /^9\d{9}$/.test(value);
    }

    function setMessage(text, color) {
        message.textContent = text;
        message.style.display = text ? 'block' : 'none';
        message.style.color = color || '#6b7280';
    }

    function updateMask(formatted) {
        var guide = '123 456 7890';
        var remaining = guide.substring(formatted.length);
        mask.textContent = remaining;
        mask.style.left = formatted.length > 0 ? (formatted.length * 10) + 'px' : '0';
    }

    function update() {
        var normalized = normalize(input.value);
        var formatted = format(normalized);

        input.value = formatted;
        fullInput.value = normalized ? '+63' + normalized : '';

        if (formatted.length === 0) {
            mask.textContent = '123 456 7890';
            mask.style.left = '0';
        } else {
            updateMask(formatted);
        }

        if (normalized.length === 0) {
            setMessage('', '#6b7280');
        } else if (normalized.length <= 3) {
            setMessage('Nice start — keep going', '#6b7280');
        } else if (normalized.length <= 6) {
            setMessage('Looking good', '#6b7280');
        } else if (normalized.length <= 9) {
            setMessage('Almost done', '#6b7280');
        } else if (isValid(normalized)) {
            setMessage('Perfect', '#16a34a');
        } else {
            setMessage('Please check your number', '#dc2626');
        }

        var pos = input.value.length;
        input.setSelectionRange(pos, pos);
    }

    input.addEventListener('input', update);
    input.addEventListener('focus', update);
    input.addEventListener('blur', update);

    update();
}