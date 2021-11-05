const loadUserData = event => {
    fetch("./userData.json")
        .then(response => response.json())
        .then(users => users.forEach(user => displayUserData(user)));
}

const displayUserData = userData => {
    const userDataElement = document.createElement('div');
    userDataElement.innerText = `Име: ${userData.name}, възраст ${userData.age}, любим спорт ${userData.favouriteSport}`;
    document.getElementById('userData').appendChild(userDataElement);
}

document.getElementById("userInfo")
        .addEventListener("click", loadUserData);