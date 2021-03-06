function setMaxDate() {
  let today = new Date();
  let dd = today.getDate();
  let mm = today.getMonth() + 1;
  const yyyy = today.getFullYear();

  if (dd < 10) {
    dd = "0" + dd;
  }
  if (mm < 10) {
    mm = "0" + mm;
  }

  today = yyyy + "-" + mm + "-" + dd;
  document.getElementById("birthdate").setAttribute("max", today);
}

function getZodiacSign(day, month) {
  var zodiacSigns = {
    capricorn: "Козирог",
    aquarius: "Водолей",
    pisces: "Риби",
    aries: "Овен",
    taurus: "Телец",
    gemini: "Близнаци",
    cancer: "Рак",
    leo: "Лъв",
    virgo: "Дева",
    libra: "Везни",
    scorpio: "Скорпион",
    sagittarius: "Стрелец"
  };

  if ((month == 1 && day <= 21) || (month == 12 && day >= 22)) {
    return zodiacSigns.capricorn;
  } else if ((month == 1 && day >= 22) || (month == 2 && day <= 21)) {
    return zodiacSigns.aquarius;
  } else if ((month == 2 && day >= 22) || (month == 3 && day <= 21)) {
    return zodiacSigns.pisces;
  } else if ((month == 3 && day >= 22) || (month == 4 && day <= 21)) {
    return zodiacSigns.aries;
  } else if ((month == 4 && day >= 22) || (month == 5 && day <= 21)) {
    return zodiacSigns.taurus;
  } else if ((month == 5 && day >= 22) || (month == 6 && day <= 21)) {
    return zodiacSigns.gemini;
  } else if ((month == 6 && day >= 22) || (month == 7 && day <= 21)) {
    return zodiacSigns.cancer;
  } else if ((month == 7 && day >= 22) || (month == 8 && day <= 21)) {
    return zodiacSigns.leo;
  } else if ((month == 8 && day >= 22) || (month == 9 && day <= 21)) {
    return zodiacSigns.virgo;
  } else if ((month == 9 && day >= 22) || (month == 10 && day <= 21)) {
    return zodiacSigns.libra;
  } else if ((month == 10 && day >= 22) || (month == 11 && day <= 21)) {
    return zodiacSigns.scorpio;
  } else if ((month == 11 && day >= 22) || (month == 12 && day <= 21)) {
    return zodiacSigns.sagittarius;
  }
}

function getDate(date) {
  return new Date(date);
}

setMaxDate();

max = document.getElementById("birthdate").getAttribute("max");

document.getElementById("birthdate").onchange = () => {
  const birthdate = document.getElementById("birthdate").value;

  if (birthdate === "") {
    document.getElementById("zodiac-sign").value = "";
    return;
  }

  const date = getDate(birthdate);
  const day = date.getDate();
  const month = date.getMonth() + 1;

  const zodiacSign = getZodiacSign(day, month);

  document.getElementById("zodiac-sign").value = zodiacSign;
};

document.getElementById("info-form").onsubmit = () => {
  const firstName = document.getElementById("first-name").value;
  const lastName = document.getElementById("last-name").value;
  const courseYear = document.getElementById("course-year").value;
  const speciality = document.getElementById("specialty").value;
  const fn = document.getElementById("fn").value;
  const groupNumber = document.getElementById("group-number").value;
  const birthdate = document.getElementById("birthdate").value;
  const zodiacSign = document.getElementById("zodiac-sign").value;
  const link = document.getElementById("link").value;
  const motivation = document.getElementById("motivation").value;
  const image = document.getElementById("img");

  const file = image.files[0];

  console.log(file);

  userData = {
    firstName: firstName,
    lastName: lastName,
    courseYear: courseYear,
    speciality: speciality,
    fn: fn,
    groupNumber: groupNumber,
    birthdate: birthdate,
    zodiacSign: zodiacSign,
    link: link,
    motivation: motivation
  };

  const data = new FormData();

  data.append("userData", JSON.stringify(userData));
  data.append("image", file);

  init = {
    method: "POST",
    body: data
  };

  console.log(init.body);

  const message = document.getElementById("msg");

  fetch("http://localhost:80/homework_2/backend/info_manager.php", init)
    .then(response => {
      console.log(response);
      
      if (!response.ok) {
        response.json().then(error => {
          message.className = "error-message";
          message.innerText = error.message;
        });
      } else {
         response.json().then(data => {
          if (data.success) {
            message.className = "info-message";
          } else {
            message.className = "error-message";
          }
          message.innerText = data.message;
        });
      }
    })

  return false;
};
