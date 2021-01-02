<template>
  <div class="jumbotron">
    <form v-if="user">
      <h2>{{user.name}}'s Profile</h2>
      <div class="form-group">
        <label>Avatar:</label>
        <br />
        <img
          v-bind:src="'storage/fotos/' + user.photo_url"
          width="150px"
          height="150px"
        />
        <form enctype="multipart/form-data">
          <br />
          <input
            style="display: none"
            type="file"
            accept="image/*"
            @change="fileSelected"
            ref="fileInput"
          />
          <button
            class="btn btn-primary"
            @click.prevent="$refs.fileInput.click()"
          >
            Upload Image
          </button>
          <button class="btn btn-primary" @click.prevent="updateAvatar()">
            Save
          </button>
        </form>
      </div>
      <div class="form-group">
        <label>Name:</label>
        <input type="text" class="form-control" v-model="user.name" />
      </div>
      <div class="form-group">
        <label>Email:</label>
        <input type="text" class="form-control" v-model="user.email" />
      </div>
      <div class="form-group">
        <label>Type:</label>
        <span v-if="user.type === 'C'">Customer</span>
        <span v-else-if="user.type === 'EC'">Employee-Cook</span>
        <span v-else-if="user.type === 'ED'">Employee-Deliveryman</span>
        <span v-else-if="user.type === 'EM'">Employee-Manager</span>
      </div>
      <hr class="navbar-divider" />
      <h4>Change Password</h4>
      <div class="form-group">
        <div>
          <label>Old password:</label>
          <input
            type="password"
            class="form-control"
            v-model="password.old_password"
          />
        </div>
        <div>
          <label>New password:</label>
          <input
            type="password"
            class="form-control"
            v-model="password.new_password"
          />
        </div>
        <div>
          <label>Confirm password:</label>
          <input
            type="password"
            class="form-control"
            v-model="password.repeat_password"
          />
        </div>
        <div>
          <span v-if="isInvalidPassword" class="userBlocked">
            Invalid Password</span
          >
          <span v-show="successPassword" class="successMessege">
            Changed Password</span
          >
        </div>
      </div>
      <hr class="navbar-divider" />
      <div v-if="user.blocked === 1" class="form-group">
        <label>Blocked:</label>
        <span class="userBlocked">User blocked</span>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" @click.prevent="saveUser()">
          Save
        </button>
        <button class="btn btn-secondary" v-on:click.prevent="cancelEdit()">
          Cancel
        </button>
        <button
            type="submit"
            class="btn btn-info"
            v-on:click.prevent="changePassword()"
          >
            Change Password
          </button>
      </div>
    </form>
  </div>
</template>

<script>
import store from "vuex";
export default {
  data() {
    return {
      store,
      selectedFile: null,
      password: {
        old_password: "",
        new_password: "",
        repeat_password: "",
        id: "",
      },
      isInvalidPassword: false,
      successPassword: false,
    };
  },
  computed: {
    user: function () {
      console.log(this.$store.state.user);
      return this.$store.state.user ? this.$store.state.user : null;
    },
  },
  methods: {
    saveUser: function () {
      console.log(this.user);
      axios.put(`/api/users/${this.user.id}`, this.user).then((result) => {
        const user = result.data.data;

        Object.assign(this.user, user);
      });
    },
    cancelEdit() {
      this.$router.push({ path: "/" });
    },
    fileSelected: function (event) {
      this.selectedFile = event.target.files[0];
      console.log(this.selectedFile);
    },
    updateAvatar: function () {
      const fd = new FormData();
      fd.append("photo_url", this.selectedFile);
      console.log(fd);
      axios.post(`/api/users/${this.user.id}`, fd).then((result) => {
        console.log(result);
      });
    },
    changePassword: function () {
      console.log(this.password);
      if (
        this.password.new_password != this.password.repeat_password ||
        this.password.old_password == this.password.new_password
      ) {
        this.isInvalidPassword = true;
        this.successPassword = false;
      } else {
        this.isInvalidPassword = false;
        this.successPassword = true;
        this.password.id = this.user.id;
        axios.post("/api/change_password", this.password).then((response) => {
          console.log(response.data.message);
        });
      }
    },
  },
};
</script>

<style>
.userBlocked {
  margin-right: 1rem;
  color: red;
}
.successMessege {
  margin-right: 1rem;
  color: green;
}
</style>