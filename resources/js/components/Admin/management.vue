<template>
  <div>
    <manage-users v-bind:users="users" />

    <edit-user
      v-if="editingUser"
      :user="currentUser"
      :departments="departments"
      @cancel-edit="cancelEdit"
      @save-user="saveUser"
    />
  </div>
</template>

<script>
import manageUsers from "./manageUsers.vue";
export default {
  components: { manageUsers },
  data: function () {
    return {
      title: "list users",
      users: [],
      editingUser: false,
      currentUser: {},
    };
  },
  methods:{
    editUser: function (user) {
      console.log(user.name);
      this.currentUser = Object.assign({}, user);
      this.editingUser = true;
    },
  },
  mounted() {
    axios.get("api/users").then((response) => {
      this.users = response.data.data;
    });
  },
};
</script>

<style>
</style>