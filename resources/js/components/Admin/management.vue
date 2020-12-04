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
    };
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