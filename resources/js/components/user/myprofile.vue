<template>
  <div>
    <h2>My Profile</h2>
    <form v-if="user">
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
        <span>{{ user.type }}</span>
      </div>
      <div class="form-group">
        <label>Blocked:</label>
        <span>{{ user.blocked }}</span>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" @click.prevent="saveUser()">
          Save
        </button>
        <button class="btn btn-secondary" v-on:click.prevent="cancelEdit()">
          Cancel
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
      this.$router.push({ path: "/management" });
    },
  },
};
</script>

<style>
</style>