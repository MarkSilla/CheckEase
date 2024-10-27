<template>
  <div id="app" class="container">
    <div class="background-container">
      <div class="square" v-for="n in 26" :key="n" :class="'square-' + n"></div>
    </div>

    <div class="row mt-5">
      <!-- Information Section -->
      <div class="col-md-6 col-lg-5 d-flex flex-column justify-content-center align-items-center text-center" style="margin-left: -150px;">
        <div class="mb-5">
          <div class="logo-container mb-4">
            <img src="/public/images/checkEaseLogo.png" alt="Check Ease Logo" style="width: 415px; height: 125px;" class="mt-n5 mh-125px mw-425px">
          </div>

          <h1>What is Check Ease?</h1>
          <p>
            A web application that simplifies the process of managing and viewing attendance and clearance records.
            It allows students to easily track their attendance and clearance status, while faculty can update these records.
          </p>
          <p class="text-secondary">
            <a href="#" class="text-decoration-none">About the developers?</a>
          </p>
        </div>
      </div>

      <!-- Signup Form Section -->
      <div class="col-md-6 col-lg-7 d-flex justify-content-center align-items-center" style="margin-left: 450px;  margin-top: -500px;">
        <div class="box-container col-12 mb-5">
          <h1 class="text-start mt-4"><b>Sign up</b></h1>
          <p class="text-start text-secondary">
            Already have an account? <a href="Login" class="text-decoration-none">Log in!</a>
          </p>

          <form @submit.prevent="submitForm" class="align-items-center w-100">
            <div class="row">
              <div class="col-md-6 mb-2">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" id="first_name" v-model="firstname" class="form-control" required>
              </div>

              <div class="col-md-6 mb-2">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" id="last_name" v-model="lastname" class="form-control" required>
              </div>
            </div>

            <div class="row mb-2"> 
              <div class="col-md-6 text-start">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" v-model="email" @blur="validateEmail" class="form-control" required>
                <span class="text-danger">{{ emailError }}</span>
              </div>

              <div class="col-md-6 text-start"> 
                <label for="contact" class="form-label">Contact Number</label>
                <input type="text" id="contact_number" v-model="contact" @blur="validateContact" class="form-control" required>
                <span class="text-danger">{{ contactError }}</span>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-2 text-start">
                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="date" id="date_of_birth" v-model="dob" class="form-control" required>
              </div>
              
              <div class="col-md-6 mb-2 text-start"> 
                <label for="gender" class="form-label">Gender:</label>
                <select id="gender" v-model="gender" class="form-select" required>
                  <option value="" disabled selected>Select your gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>

            <div class="mb-2 text-start">
              <label for="username" class="form-label">Username</label>
              <input type="text" id="username" v-model="username" @blur="validateUsername" class="form-control" required>
              <span class="text-danger">{{ usernameError }}</span>
            </div>

            <div class="mb-2 text-start">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" v-model="password" class="form-control" required>
            </div>

            <div class="mb-2 text-start">
              <label for="confirm-password" class="form-label">Confirm Password</label>
              <input type="password" id="confirm-password" v-model="confirmPassword" class="form-control" required>
            </div>

            <div class="mb-3 text-start">
              <label for="role" class="form-label">Role</label>
              <select id="role" v-model="role" class="form-select" required>
                <option value="" disabled selected>Select your role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'SignUp',
  data() {
    return {
      firstname: '',
      lastname: '',
      username: '',
      email: '',
      emailError: '',
      usernameError: '', 
      dob: '',
      gender: '',
      contact: '',
      contactError: '',
      password: '',
      confirmPassword: '',
      role: ''
    };
  },
  methods: {
    async submitForm() {
      this.validateEmail();
      this.validateContact();
      await this.validateUsername();

      if (this.emailError || this.contactError || this.usernameError) {
        alert('Please fix the errors before submitting.');
        return;
      }

      if (this.password !== this.confirmPassword) {
        alert("Passwords do not match.");
        return;
      }

      try {
        // Sending a POST request to the signup PHP script
        const response = await axios.post('http://localhost/vue-login-backend/signup.php', {
          firstname: this.firstname,
          lastname: this.lastname,
          username: this.username,
          email: this.email,
          dob: this.dob,
          gender: this.gender,
          contact: this.contact,
          password: this.password,
          role: this.role
        });

        const result = response.data;

        if (result.success) {
          alert(result.message);
          // Redirect to the respective dashboard based on role
          if (this.role === 'Student') {
            this.$router.push('/StdntHomeView'); 
          } else if (this.role === 'Teacher') {
            this.$router.push('/HomeView'); 
          }
        } else {
          alert(result.message); 
        }
      } catch (error) {
        console.error('Error:', error.response || error.message);
        alert('An error occurred. Please try again.'); 
      }
    },

    validateEmail() {
      // Basic email validation regex
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!this.email) {
        this.emailError = ''; 
      } else if (!regex.test(this.email)) {
        this.emailError = 'Please enter a valid email address.';
      } else {
        this.emailError = ''; 
      }
    },
    
    validateContact() {
      const regex = /^(\+?\d{1,4}[\s-]?)?(\(?\d{3}\)?[\s-]?|\d{3}[\s-]?)(\d{3}[\s-]?\d{4}|\d{4})$/; 
      if (!this.contact) {
        this.contactError = '';
      } else if (!regex.test(this.contact)) {
        this.contactError = 'Please enter a valid contact number.';
      } else {
        this.contactError = ''; 
      }
    },
    
    async validateUsername() {
     
      this.usernameError = '';
      
     
      if (this.username) {
        try {
          const response = await axios.post('http://localhost/vue-login-backend/validate_username.php', {
            username: this.username
          });

          const result = response.data;

          if (!result.available) {
            this.usernameError = 'Username is already taken.';
          }
        } catch (error) {
          console.error('Error validating username:', error);
        }
      }
    }
  }
};
</script>

<style scoped>
body {
  font-family: 'Outfit', sans-serif;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.box-container {
  background-color: white;
  border-radius: 8px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  padding: 20px;
  width: 600px; 
}

.background-container {
  position: fixed; 
  z-index: -1; 
  top: 0;
  left: 0;
  width: 100%; 
  height: 100%; 
}

.square {
  position: absolute;
  background-color: rgba(0, 123, 255, 0.1);
  opacity: 0.5;
  border-radius: 10%;
}

.square-1 { width: 100px; height: 100px; top: 10%; left: 10%; }
.square-2 { width: 150px; height: 150px; top: 20%; left: 60%; }
.square-3 { width: 120px; height: 120px; top: 70%; left: 30%; }
.square-4 { width: 130px; height: 130px; top: 40%; left: 80%; }
.square-5 { width: 140px; height: 140px; top: 30%; left: 20%; }
.square-6 { width: 110px; height: 110px; top: 60%; left: 40%; }
.square-7 { width: 160px; height: 160px; top: 50%; left: 50%; }
.square-8 { width: 90px; height: 90px; top: 20%; left: 80%; }
.square-9 { width: 150px; height: 150px; top: 80%; left: 10%; }
.square-10 { width: 130px; height: 130px; top: 10%; left: 50%; }
.square-11 { width: 170px; height: 170px; top: 70%; left: 20%; }
.square-12 { width: 120px; height: 120px; top: 90%; left: 60%; }
.square-13 { width: 140px; height: 140px; top: 30%; left: 90%; }
.square-14 { width: 100px; height: 100px; top: 20%; left: 10%; }
.square-15 { width: 160px; height: 160px; top: 40%; left: 30%; }
.square-16 { width: 110px; height: 110px; top: 60%; left: 50%; }
.square-17 { width: 150px; height: 150px; top: 50%; left: 80%; }
.square-18 { width: 120px; height: 120px; top: 10%; left: 30%; }
.square-19 { width: 130px; height: 130px; top: 80%; left: 40%; }
.square-20 { width: 140px; height: 140px; top: 10%; left: 60%; }
.square-21 { width: 90px; height: 90px; top: 20%; left: 70%; }
.square-22 { width: 150px; height: 150px; top: 30%; left: 20%; }
.square-23 { width: 130px; height: 130px; top: 50%; left: 10%; }
.square-24 { width: 170px; height: 170px; top: 70%; left: 30%; }
.square-25 { width: 120px; height: 120px; top: 90%; left: 50%; }
.square-26 { width: 140px; height: 140px; top: 20%; left: 80%; }
</style>