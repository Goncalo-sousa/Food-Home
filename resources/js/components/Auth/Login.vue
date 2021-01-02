<template>
  <div>
    <div class="jumbotron">
      <h2>Login</h2>
      <div class="form-group">
        <label for="inputEmail">Email</label>
        <input
          type="email"
          class="form-control"
          v-model="credentials.email"
          name="email"
          id="inputEmail"
          placeholder="Email address"
        />
        <small class="text text-danger" v-if="errors.has('blocked')">
          Error: The User is blocked.
        </small>
        <small class="text text-danger" v-if="errors.has('email')">
          Error: Email not found.
        </small>
      </div>
      <div class="form-group">
        <label for="inputPassword">Password</label>
        <input
          type="password"
          class="form-control"
          v-model="credentials.password"
          name="password"
          id="inputPassword"
        />
        <small class="text text-danger" v-if="errors.has('password')">
          Error: Invalid password.
        </small>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" v-on:click.prevent="login">Login</button>
      </div>
    </div>
  </div>
</template>

<script>
import errors from "../../utils/errors.js";
export default {
  data: function () {
    return {
      credentials: {
        email: "",
        password: "",
      },
      errors: new errors(),
    };
  },
  methods: {
    login() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/login", this.credentials)
          .then((response) => {
            console.log("User has logged in");
            console.dir(response.data);
            this.$store.dispatch("LogIn", response.data);
            this.$router.push({ path: "/" }).catch(() => {});
          })
          .catch((error) => {
            if (error.response.status === 422) {
              this.errors.record(error.response.data.errors, "");
            }
            console.log("Invalid Authentication");
          });
      });
    },
  },
};
</script>

<style></style>
