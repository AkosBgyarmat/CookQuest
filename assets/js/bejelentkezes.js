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

tailwind.config = {
    theme: {
      extend: {
        colors: {
          bg: '#95A792',
          primary: '#596C68',
          secondary: '#E3D9CA',
          dark: '#403F48'
        }
      }
    }
  }