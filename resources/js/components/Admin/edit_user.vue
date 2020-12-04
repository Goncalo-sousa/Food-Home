<template>
  <div class="jumbotron">
    <h2>Edit User</h2>

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
export default {
  props: ["user", "departments"],
  data: function () {
    return {
      user: undefined,
      departments: [],
    };
  },
  methods: {
    saveUser() {
      // this.$emit("save-user", this.user);
      // this.$router.push({path: `/users`, params:{'save-user': this.user}});
    },
    cancelEdit() {
      // this.$emit("cancel-edit");
      this.$router.push({ path: "/users" });
    },
  },
  async created() {
    const userID = this.$route.params.id;
    this.user = (await axios.get(`/api/users/${userID}`)).data.data;
  },
};
</script>

<style>
</style>