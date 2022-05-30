    const form = document.querySelector("#Login");
    const email = document.querySelector("#login-email");
    const passwd = document.querySelector('#login-password');
    const emailError = document.querySelector("#emailError");
    let validRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    


    const checkEmail = () => {
      let valid = false;
      const emailEL = email.value.trim();
      if (!isRequired(emailEL)) {
          showError(email);
      } else if (!isEmailValid(emailEL)) {
          showError(email);
          emailError.innerHTML = "Email format is not correct";
      } else {
          showSuccess(email);
          valid = true;
      }
      return valid;
  };

  const isEmailValid = (email) => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

  const checkPassword = () => {
    let valid = false;

    const password = passwd.value.trim();

    if (!isRequired(password)) {
        showError(passwd);
    } else {
        showSuccess(passwd);
        valid = true;
    }
    return valid;
};

const isRequired = value => value === '' ? false : true;

const showError = (input) => {
  input.classList.add('is-invalid');
};

const showSuccess = (input) => {
  input.classList.remove('is-invalid');
}

    form.addEventListener('submit',function (e){
      let isEmailValid = checkEmail(), isPasswordValid = checkPassword()
      let isFormValid = isEmailValid && isPasswordValid;

      if(isFormValid){

      }else {
        e.preventDefault();
      }
    });