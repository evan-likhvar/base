function toggleDashboard(eventTarget) {

    let data = {
        userId: eventTarget.parentNode.parentNode.parentNode.firstElementChild.innerHTML,
    };

    axios.post('/dashboard/toggle-dashboard-access', data)  // + eventTarget.parentNode.parentNode.parentNode.firstElementChild.innerHTML)
        .then(response => {
            while (document.contains(document.getElementById("front-message"))) {
                document.getElementById("front-message").remove();
            }
            try {
                eventTarget.parentNode.nextElementSibling.innerHTML = response.data.resultMessages.result;
            } catch (e) {
                throw new Error('Result data is incorrect:  ' + e.message);
            }

            if (!(response.data.resultMessages.result == 'enabled' || response.data.resultMessages.result == 'disabled')) {
                throw new Error('Result data has incorrect value:  ' + response.data.resultMessages.result);
            }

            if (response.data.resultMessages.result == 'enabled') {
                eventTarget.parentNode.nextElementSibling.className = 'uk-text-primary';
            } else {
                eventTarget.parentNode.nextElementSibling.className = 'uk-text-danger';
            }
            if (response.data.frontMessages) {
                for (key in response.data.frontMessages) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin', response.data.frontMessages[key]);
                }
            }
            if (response.data.errorMessages) {
                for (key in response.data.errorMessages) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin', response.data.errorMessages[key]);
                }
            }
        })
        .catch(function (error) {
            console.log(error.response.data.errors);
            while (document.contains(document.getElementById("front-message"))) {
                document.getElementById("front-message").remove();
            }
            document.getElementById('main-table').insertAdjacentHTML('beforebegin',
                '<div id="front-message" class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' +
                error.message
                + '</p></div>'
            );
            if (error.response.data.errors) {
                console.log(error.response.data.errors.userId);
                for (key in error.response.data.errors) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin',
                        '<div id="front-message" class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' +
                        error.response.data.errors[key]
                        + '</p></div>'
                    );
                }
            }
        });
}

function toggleActiveUser(eventTarget) {

    let data = {
        userId: eventTarget.parentNode.parentNode.parentNode.firstElementChild.innerHTML,
    };

    axios.post('/dashboard/toggle-user-active', data)
        .then(response => {
            while (document.contains(document.getElementById("front-message"))) {
                document.getElementById("front-message").remove();
            }
            try {
                eventTarget.parentNode.nextElementSibling.innerHTML = response.data.resultMessages.result;
            } catch (e) {
                throw new Error('Result data is incorrect:  ' + e.message);
            }

            if (!(response.data.resultMessages.result == 'yes' || response.data.resultMessages.result == 'no')) {
                throw new Error('Result data has incorrect value:  ' + response.data.resultMessages.result);
            }

            if (response.data.resultMessages.result == 'yes') {
                eventTarget.parentNode.nextElementSibling.className = 'uk-text-primary';
            } else {
                eventTarget.parentNode.nextElementSibling.className = 'uk-text-danger';
            }
            if (response.data.frontMessages) {
                for (key in response.data.frontMessages) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin', response.data.frontMessages[key]);
                }
            }
            if (response.data.errorMessages) {
                for (key in response.data.errorMessages) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin', response.data.errorMessages[key]);
                }
            }
        })
        .catch(function (error) {
            console.log(error.response.data.errors);
            while (document.contains(document.getElementById("front-message"))) {
                document.getElementById("front-message").remove();
            }
            document.getElementById('main-table').insertAdjacentHTML('beforebegin',
                '<div id="front-message" class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' +
                error.message
                + '</p></div>'
            );
            if (error.response.data.errors) {
                console.log(error.response.data.errors.userId);
                for (key in error.response.data.errors) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin',
                        '<div id="front-message" class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' +
                        error.response.data.errors[key]
                        + '</p></div>'
                    );
                }
            }
        });
}

function toggleActiveRole(eventTarget) {

    let data = {
        roleId: eventTarget.parentNode.parentNode.parentNode.firstElementChild.innerHTML,
    };

    axios.post('/dashboard/toggle-role-active', data)
        .then(response => {
            while (document.contains(document.getElementById("front-message"))) {
                document.getElementById("front-message").remove();
            }
            try {
                eventTarget.parentNode.nextElementSibling.innerHTML = response.data.resultMessages.result;
            } catch (e) {
                throw new Error('Result data is incorrect:  ' + e.message);
            }

            if (!(response.data.resultMessages.result == 'yes' || response.data.resultMessages.result == 'no')) {
                throw new Error('Result data has incorrect value:  ' + response.data.resultMessages.result);
            }

            if (response.data.resultMessages.result == 'yes') {
                eventTarget.parentNode.nextElementSibling.className = 'uk-text-primary';
            } else {
                eventTarget.parentNode.nextElementSibling.className = 'uk-text-danger';
            }
            if (response.data.frontMessages) {
                for (key in response.data.frontMessages) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin', response.data.frontMessages[key]);
                }
            }
            if (response.data.errorMessages) {
                for (key in response.data.errorMessages) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin', response.data.errorMessages[key]);
                }
            }
        })
        .catch(function (error) {
            console.log(error.response.data.errors);
            while (document.contains(document.getElementById("front-message"))) {
                document.getElementById("front-message").remove();
            }
            document.getElementById('main-table').insertAdjacentHTML('beforebegin',
                '<div id="front-message" class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' +
                error.message
                + '</p></div>'
            );
            if (error.response.data.errors) {
                for (key in error.response.data.errors) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin',
                        '<div id="front-message" class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' +
                        error.response.data.errors[key]
                        + '</p></div>'
                    );
                }
            }
        });
}

function toggleActiveLanguage(eventTarget) {

    let data = {
        languageId: eventTarget.parentNode.parentNode.parentNode.firstElementChild.innerHTML,
    };

    axios.post('/dashboard/toggle-language-active', data)
        .then(response => {
            while (document.contains(document.getElementById("front-message"))) {
                document.getElementById("front-message").remove();
            }
            try {
                eventTarget.parentNode.nextElementSibling.innerHTML = response.data.resultMessages.result;
            } catch (e) {
                throw new Error('Result data is incorrect:  ' + e.message);
            }

            if (!(response.data.resultMessages.result == 'yes' || response.data.resultMessages.result == 'no')) {
                throw new Error('Result data has incorrect value:  ' + response.data.resultMessages.result);
            }

            if (response.data.resultMessages.result == 'yes') {
                eventTarget.parentNode.nextElementSibling.className = 'uk-text-primary';
            } else {
                eventTarget.parentNode.nextElementSibling.className = 'uk-text-danger';
            }
            if (response.data.frontMessages) {
                for (key in response.data.frontMessages) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin', response.data.frontMessages[key]);
                }
            }
            if (response.data.errorMessages) {
                for (key in response.data.errorMessages) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin', response.data.errorMessages[key]);
                }
            }
        })
        .catch(function (error) {
            console.log(error.response.data.errors);
            while (document.contains(document.getElementById("front-message"))) {
                document.getElementById("front-message").remove();
            }
            document.getElementById('main-table').insertAdjacentHTML('beforebegin',
                '<div id="front-message" class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' +
                error.message
                + '</p></div>'
            );
            if (error.response.data.errors) {
                for (key in error.response.data.errors) {
                    document.getElementById('main-table').insertAdjacentHTML('beforebegin',
                        '<div id="front-message" class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' +
                        error.response.data.errors[key]
                        + '</p></div>'
                    );
                }
            }
        });
}