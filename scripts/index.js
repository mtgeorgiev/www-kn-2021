
const loginStatusMethods = {
  checkLoginStatus: () => {

    fetch('./endpoints/session.php')
      .then(response => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error();
        }
      })
    .then(loginStatusMethods.handleLoginStatusResponse)
    .catch(() => {
      console.log('login status check failed');
    });
  },

  handleLoginStatusResponse: loginStatusResponse => {

    if (loginStatusResponse.loginStatus) {
      // logged
      document.querySelectorAll('.logged')
        .forEach(element => element.style="display: block");
    } else {
      // not logged
      document.querySelectorAll('.not-logged')
        .forEach(element => element.style="display: block");
    }
  
  }
};

const logout = () => {

    fetch('./endpoints/session.php', {
      method: 'DELETE'
    })
    .then(() => {
        document.body.appendChild(document.createTextNode('Успешно излизане от системата'));
        window.setTimeout(() => document.location.reload(), 2000);
    })
    .catch(() => console.log('error'));
  
}

const loadSiteName = () => {

  fetch('./endpoints/siteInfo.php?key=name')
    .then(response => response.json())
    .then(displaySiteName);
}

const displaySiteName = ({value}) => {
  document.title = value;
}

document.getElementById('logout-button').addEventListener('click', logout);

loginStatusMethods.checkLoginStatus();

loadSiteName();
