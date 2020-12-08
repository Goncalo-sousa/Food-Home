 <template id="registerTemplate">
  <form @submit.prevent="onSubmit" ref="form" action="" class="register-form">
    <h2>Register</h2>
    <div class="form-group">
      <label for="firstname">Name</label>
      <input
        required
        type="text"
        v-model.trim="user.name"
        id="name"
        placeholder="Name"
      />
      <small v-if="errors.has('name')">
        Error: Name does not match the criteria.
      </small>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input
        required
        type="email"
        v-model.trim="user.email"
        id="email"
        placeholder="Email Address"
      />
      <small v-if="errors.has('email')">
        Error: Email does not match the criteria or it's already in use.
      </small>
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input
        required
        v-model.trim="user.phone"
        id="phone"
        placeholder="Phone Number"
      />
      <small v-if="errors.has('phone')">
        Error: Phone does not match the criteria.
      </small>
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input
        required
        v-model.trim="user.address"
        id="address"
        placeholder="Address"
      />
      <small v-if="errors.has('address')">
        Error: Address does not match the criteria.
      </small>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input
        required
        type="password"
        v-model="user.password"
        placeholder="Password"
        id="password"
      />
      <small v-if="errors.has('password')">
        Error: Password does not match the criteria.
      </small>
    </div>
    <div class="form-group">
      <label for="password_confirmation">Password Verification</label>
      <input
        required
        type="password"
        v-model="user.password_confirmation"
        placeholder="Password Confirmation"
        id="password_confirmation"
      />
      <small v-if="errors.has('password')">
        Error: Password Corfirmation does not the password.
      </small>
    </div>
    <input type="submit" :disabled="!isFormValid" value="Register" />
  </form>
</template>
 
<script>
import axios from "axios";
import errors from "../../utils/errors.js";

export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      errors: new errors(),
    };
  },
  methods: {
    onSubmit: function () {
      axios
        .post("http://localhost/api/register", this.user)
        .then((response) => {
          this.$router.push({ name: "login" });
        })
        .catch((errors) => {
          if (errors.response.status === 422) {
            this.errors.record(errors.response.data.errors, "");
          }
        });
    },
  },
  computed: {
    isFormValid: function () {
      if (this.user.password == this.user.password_confirmation) {
        return true;
      }
      return false;
    },
  },
};
</script>

<style>
</style>