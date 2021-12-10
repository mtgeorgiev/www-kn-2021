const loadUsers = () => {
    fetch('./endpoints/user.php')
        .then(response => response.json())
        .then(displayUsersList);
}

const displayUsersList = users => {
    const usersListContainer = document.getElementById('users-list');

    users.map(user => {
            const element = document.createElement('div');
            const text = document.createTextNode(`The user ${user.email} is registered on ${user.registeredOn}`);
            element.appendChild(text);
            return element;
        })
        .forEach(userElement => {
            usersListContainer.appendChild(userElement);
        });
}

loadUsers();