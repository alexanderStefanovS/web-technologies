
function validateUsername(username) {
  return username && username.length >= 3 && username.length <= 10; 
}

function validateName(name) {
  return name && name.length > 0 && name.length <= 50; 
}

function validateEmail(email) {
  const regex = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
  const isCorrect = regex.test(email);
  return email && isCorrect;
}

function validatePassword(password) {
  const regex = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,10}$/);
  const isCorrect = regex.test(password);
  return password && isCorrect;
}

function validateZipcode(zipcode) {
  if (!zipcode) {
    return true;
  }

  const regex = new RegExp(/^[0-9]{5}-[0-9]{4}$/);
  const isCorrect = regex.test(zipcode);
  return isCorrect;
}

function validateInput(id) {
  const errId = id + "-err"; 

  switch (id) {
    case "username": {
      const message = "Потребителското име е задължително и трябва да съдържа от 3 до 10 символа";
      showError(id, errId, validateUsername, message);
      break;
    }
    case "name": {
      const message = "Името е задължително и трябва да съдържа до 50 символа"
      showError(id, errId, validateName, message);
      break;
    }
    case "email": {
      const message = "Имейлът е задължителен и трябва да бъде валиден"
      showError(id, errId, validateEmail, message);
      break;
    }
    case "password": {
      const message = "Паролата е задължителна и трябва да съдържа от 6 до 10 символа с главни и малки букви"
      showError(id, errId, validatePassword, message);
      break;
    }
    case "zipcode": {
      const message = "Пощенският код трябва да е във формат 11111-1111"
      showError(id, errId, validateZipcode, message);
      break;
    }
  }

}

function showError(id, errId, validation, message) {
  const value = document.getElementById(id).value;
  const errElement = document.getElementById(errId);

  if (!validation(value)) {
    errElement.classList.remove("err-hidden");
    errElement.classList.add("err-msg");
    errElement.innerText = message;
  } else {
    errElement.classList.add("err-hidden");
    errElement.classList.remove("err-msg");
  }
}

function isFormValid(username, name, email, password, zipcode) {
  return (validateUsername(username) && validateName(name) && validateEmail(email) 
        && validatePassword(password) && validateZipcode(zipcode));
}

function checkUsername(username) {
  fetch("https://jsonplaceholder.typicode.com/users")
    .then(response => {
      return response.json();
    })
    .then(data => {
      const msgField = document.getElementById('msg');
      if (doExist(username, data)) {
        const message = "Потребителят вече съществува";
        msgField.innerText = message;
        msgField.classList.remove("err-hidden");
        msgField.classList.add("err-msg");
      } else {
        const message = "Потребителят e записан";
        msgField.innerText = message;
        msgField.classList.remove("err-hidden");
        msgField.classList.remove("err-msg");
        msgField.classList.add("reg-completed");
      }
    });
}

function doExist(username, data) {
  const usernames = data.map(user => user.username);
  return usernames.includes(username);
}

document.getElementById("reg-form").onsubmit = () => {

  const username = document.getElementById("username").value;
  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const street = document.getElementById("street").value;
  const city = document.getElementById("city").value;
  const zipcode = document.getElementById("zipcode").value;

  const msgField = document.getElementById('msg');

  if (!isFormValid(username, name, email, password, zipcode)) {
    const message = "Моля, въведете валидни данни";
    msgField.innerText = message;
    msgField.classList.remove("err-hidden");
    msgField.classList.add("err-msg");
    msgField.classList.remove("reg-completed");
    
  } else {
    msgField.classList.add("err-hidden");
    msgField.classList.remove("err-msg");
    msgField.classList.remove("reg-completed");

    const userData = {
      name: name,
      username: username,
      email: email,
      password: password,
      address: { 
        street: street,
        city: city,
        zipcode: zipcode
      },
    };

    checkUsername(userData.username);
  }

  return false;
};