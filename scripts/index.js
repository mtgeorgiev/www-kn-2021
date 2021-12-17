
const checkLoginStatus = () => {

  fetch('./endpoints/session.php')
    .then(response => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error();
      }
    })
  .then(handleLoginStatusResponse)
  .catch(console.log('login status check failed'));
};

const handleLoginStatusResponse = loginStatusResponse => {

  if (loginStatusResponse.loginStatus) {
    // logged
    document.querySelectorAll('.logged')
      .forEach(element => element.style="display: block");
  } else {
    // not logged
    document.querySelectorAll('.not-logged')
      .forEach(element => element.style="display: block");
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

document.getElementById('logout-button').addEventListener('click', logout);

checkLoginStatus();