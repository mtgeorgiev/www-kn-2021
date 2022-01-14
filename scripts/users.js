
class User {
    constructor({id, email, registeredOn}) {
        this.id = id;
        this.email = email;
        this.registeredOn = registeredOn;
    }

    createHTTMLListElement() {
        const element = document.createElement('div');
        const text = document.createTextNode(`The user ${this.email} is registered on ${this.registeredOn}`);
        element.appendChild(text);
        return element;
    }

}

const userListMethods = {
    loadUsers: () => {
        fetch('./endpoints/user.php')
            .then(response => response.json())
            .then(userListMethods.displayUsersList)
    },
    displayUsersList: usersResponse => {
        const usersListContainer = document.getElementById('users-list');
    
        usersResponse.map(userData => new User(userData))
                     .map(user => user.createHTTMLListElement())
                     .forEach(userElement => {
                        usersListContainer.appendChild(userElement);
                     });
    }
}

userListMethods.loadUsers();
