<template>
  <div id="app" class="container">
    <div class="background-container">
      <div class="square" v-for="n in 26" :key="n" :class="'square-' + n"></div>
    </div>

    <div class="row mt-5">
      <!-- Information Section -->
      <div class="col-md-6 col-lg-5 d-flex flex-column justify-content-center align-items-center text-center"
        style="margin-left: -100px;">
        <div class="mb-5">
          <div class="logo-container mb-4">
            <img src="/public/images/checkEaseLogo.png" alt="logo here" style="width: 415px; height: 125px;"
              class="mt-n5 mh-125px mw-425px">
          </div>
          <h1>What is Check Ease?</h1>
          <p>
            A web application that simplifies the process of managing and viewing attendance and clearance records.
            It allows students to easily track their attendance and clearance status, while faculty and/or student
            organizations can update these records.
          </p>
          <p class="text-secondary">
            <a href="#" class="text-decoration-none">About the developers?</a>
          </p>
        </div>
      </div>

      <!-- Signup Form Section -->
      <div class="col-md-6 col-lg-7 d-flex justify-content-center align-items-center"
        style="margin-left: 450px;  margin-top: -500px;">

        <div class="box-container col-12 mb-5">
          <h1 class="text-start mt-4"><b>Sign up</b></h1>
          <p class="text-start text-secondary">
            Already have an account? <a href="index-login.html" class="text-decoration-none">Click here to Log in!</a>
          </p>

          <form @submit.prevent="submitForm" class="align-items-center w-100">
            <div class="row">
              <div class="col-md-6 mb-2">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" id="firstname" v-model="firstname" class="form-control" required>
              </div>

              <div class="col-md-6 mb-2">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" id="lastname" v-model="lastname" class="form-control" required>
              </div>
            </div>

            <div class="mb-2 text-start">
              <label for="username" class="form-label">Username</label>
              <input type="text" id="username" v-model="username" class="form-control" required>
            </div>

            <div class="mb-2 text-start">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" v-model="email" class="form-control" required>
            </div>

            <div class="mb-2 text-start">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" v-model="password" class="form-control" required>
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
      password: '',
      role: ''
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post('http://localhost/vue-login-backend/signup.php', {
          firstname: this.firstname,
          lastname: this.lastname,
          username: this.username,
          email: this.email,
          password: this.password,
          role: this.role
        });

        const result = response.data;

        if (result.success) {
          alert(result.message); // Display success message
          this.$router.push('/'); // Redirect to login page after successful signup
        } else {
          alert(result.message); // Display error message from server
        }
      } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
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
}

.square {
  position: absolute;
  width: 50px;
  height: 50px;
  background-color: #645394;
  opacity: 0.8;
  border-radius: 10%;
}

/* Adjust squares for aesthetic background */
.square-1 {
  top: 10vh;
  left: 20vw;
}

.square-2 {
  top: 30vh;
  left: 40vw;
}

.square-3 {
  top: 50vh;
  left: 60vw;
}

.square-4 {
  top: 70vh;
  left: 80vw;
}

.square-5 {
  top: 20vh;
  left: 70vw;
}

.square-6 {
  top: 40vh;
  left: 90vw;
}

.square-7 {
  top: 60vh;
  left: 10vw;
}

.square-8 {
  top: 80vh;
  left: 30vw;
}
</style>
