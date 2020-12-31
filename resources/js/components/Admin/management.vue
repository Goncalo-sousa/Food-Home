<template>
  <div>
    <manage-users v-bind:users="users" />

    <edit-user
      v-if="editingUser"
      :user="currentUser"
      @cancel-edit="cancelEdit"
      @save-user="saveUser"
    />
  </div>
</template>

<script>
import manageUsers from "./manageUsers.vue";
export default {
  components: { manageUsers},
  data: function () {
    return {
      users: [],
      editingUser: false,
      currentUser: {},
    };
  },
  methods: {
    editUser: function (user) {
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