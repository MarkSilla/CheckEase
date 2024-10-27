<template>
  <div id="sidebar" class="d-flex flex-column align-items-center bg-light py-4">
    <img src="/public/images/logo.png" alt="Logo" class="mb-4 logo">

    <div class="nav-icons d-flex flex-column align-items-center justify-content-center flex-grow-1">
      <router-link to="/Home" class="nav-icon mb-3 button">
        <i class="material-icons">apps</i>
      </router-link>
      <router-link to="/attendance" class="nav-icon mb-3 button">
        <i class="material-icons">event</i>
      </router-link>
      <router-link to="/clearance" class="nav-icon mb-3 button">
        <i class="material-symbols-outlined">inventory</i>
      </router-link>
    </div>

    <div class="logout-icon mt-auto" @click="openLogoutConfirmation" role="button" tabindex="0" @keypress.enter="openLogoutConfirmation">
      <i class="material-icons">exit_to_app</i>
    </div>

    <!-- Confirmation Modal -->
    <div v-if="showModal" class="modal" @click.self="closeModal" aria-labelledby="modal-title" aria-modal="true">
      <div class="modal-content">
        <h2 id="modal-title">Confirm Logout</h2>
        <p>Are you sure you want to log out?</p>
        <div class="modal-buttons">
          <button @click="confirmLogout" class="btn btn-confirm">Yes</button>
          <button @click="closeModal" class="btn btn-cancel">No</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Sidebar",
  data() {
    return {
      showModal: false, // State to control the modal visibility
    };
  },
  methods: {
    openLogoutConfirmation() {
      this.showModal = true; // Show the modal
    },
    closeModal() {
      this.showModal = false; // Hide the modal
    },
    confirmLogout() {
      // Clear any authentication data if stored (e.g., localStorage)
      localStorage.removeItem('authToken'); // Assuming an auth token is stored

      // Navigate back to the login page
      this.$router.push('/Login');
      this.closeModal(); // Close the modal after confirming logout
    }
  }
};
</script>

<style scoped>
#sidebar {
  width: 60px;
  background-color: #DBF4F8 !important;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
  border-top-right-radius: 15px;
  border-bottom-right-radius: 15px;
  z-index: 1000;
}

.logo {
  width: 40px;
}

.material-icons {
  font-size: 24px;
  cursor: pointer;
}

.logout-icon {
  margin-bottom: 20px;
  cursor: pointer;
}

.nav-icons {
  flex-grow: 1;
  display: flex;
  justify-content: center;
}

.nav-icon {
  text-decoration: none;
  color: inherit;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  border-radius: 20px;
  transition: background-color 0.3s ease;
}

.nav-icon:hover {
  background-color: #78B7D0;
  color: white;
}

.nav-icons i {
  margin-bottom: 0;
}


.modal {
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.6);
  display: flex;
  justify-content: center;
  align-items: center;
  animation: fadeIn 0.3s; 
}

.modal-content {
  background-color: #fff;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #888;
  border-radius: 8px; 
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  width: 300px;
  text-align: center;
  position: relative;
}


.modal-buttons {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

button {
  margin: 0 10px;
  padding: 10px 15px;
  border: none;
  border-radius: 4px; 
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-confirm {
  background-color: #28a745; 
  color: white;
}

.btn-confirm:hover {
  background-color: #218838; 
}

.btn-cancel {
  background-color: #dc3545;
  color: white;
}

.btn-cancel:hover {
  background-color: #c82333; 
}

/* Animation */
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>
