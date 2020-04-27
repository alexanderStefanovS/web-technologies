
document.getElementById('reg-form').onsubmit = () => { 
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const passwd = document.getElementById('passwd').value;
    const passwdRep = document.getElementById('passwd-rep').value;

    const registration = {
        name: name,
        email: email,
        passwd: passwd,
        passwdRep: passwdRep
    }
    const request = JSON.stringify(registration);
    console.log(request);

    console.log(registration);

    const http = new XMLHttpRequest();
    http.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // var myObj = JSON.parse(this.responseText);
        document.getElementById("reg").innerHTML =this.responseText;
      }
    };
    http.open("GET", "registration.php?registration=" + request, true);
    http.send();

    return false;
};