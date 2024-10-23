function loadHelpIconsForForm(formId) {
    const cacheKey = 'helpIcons_' + formId;
    const cacheExpirationKey = cacheKey + '_expiration';
    const cachedData = localStorage.getItem(cacheKey);
    const cacheExpiration = localStorage.getItem(cacheExpirationKey);
    const now = Date.now();

    if (cachedData && cacheExpiration && now < parseInt(cacheExpiration, 10)) {
        const helpData = JSON.parse(cachedData);
        appendHelpIcons(helpData);
    } else {
        fetch('/api/help-icons/' + formId)
            .then(response => response.json())
            .then(data => {
                localStorage.setItem(cacheKey, JSON.stringify(data));
                localStorage.setItem(cacheExpirationKey, now + (60 * 60 * 1000));
                appendHelpIcons(data);
            });
    }
}

function appendHelpIcons(data) {
    data.forEach(function (help) {
        let field = document.getElementById(help.form_field_id);
        if (field) {
            let helpIcon = document.createElement('span');
            helpIcon.classList.add('help-icon');
            helpIcon.setAttribute('title', help.form_help_text);
            helpIcon.innerHTML = help.icon.code_svg;
            field.parentNode.insertBefore(helpIcon, field.nextSibling);
        }
    });
}