function authPage() {
    return {
      isLogin: true,
      vezeteknev: '',
      keresztnev: '',
      felhasznalonev: '',
      email: '',
      password: '',
      confirmPassword: '',
      szuletesiEv: '',
      orszagId: '',
      handleSubmit() {
        alert(this.isLogin ?
          'Frontend: bejelentkezés elküldve' :
          'Frontend: regisztráció elküldve');
      }
    }
}