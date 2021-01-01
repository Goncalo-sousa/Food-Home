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
        <label>Type:</label>
        <select class="form-control" v-model="user.type">
          <option disabled value="">Please select one</option>
          <option value="C">Customer</option>
          <option value="EC">Employee-Cook</option>
          <option value="ED">Employee-Deliveryman</option>
          <option value="EM">Employee-Manager</option>
        </select>
      </div>
      <div class="form-group">
        <label>Blocked:</label>
        <select class="form-control" v-model="user.blocked">
          <option disabled value="">Please select one</option>
          <option>0</option>
          <option>1</option>
        </select>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" @click.prevent="saveUser()">Save</button>
        <button class="btn btn-secondary" v-on:click.prevent="cancelEdit()">
          Cancel
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  //props: ["user"],
  data() {
    return {
      user: undefined,
    };
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
      // this.$emit("cancel-edit");
      this.$router.push({ path: "/management" });
    },
  },
  async created() {
    const userID = this.$route.params.id;
    this.user = (await axios.get(`/api/users/${userID}`)).data.data;
  },
};
</script>

<style></style>
